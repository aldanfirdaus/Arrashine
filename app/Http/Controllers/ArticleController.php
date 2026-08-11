<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('title', 'like', "%$search%")
                    ->orWhere('body', 'like', "%$search%");

            });

        }
        $articles = $query->latest()->paginate(10)->withQueryString();
        return view('admin.articles.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.articles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'body' => 'required',
        ]);

        // Set nilai default null jika tidak ada file image
        $imagePath = null;

        // Upload gambar utama/cover artikel (jika ada)
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('articles', 'public');
        }

        // Simpan ke database
        Article::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'image' => $imagePath,
            'body' => $validated['body'],
        ]);

        return redirect('admin/article')
            ->with('success', 'Artikel berhasil ditambahkan.');
    }

    public function edit($id)
    {

        $article = Article::findOrFail($id);
        return view('admin.articles.edit', [
            'article' => $article,
        ]);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'body' => 'required',
        ]);

        /*
        |-----------------------------------------
        | 1. Update Cover
        |-----------------------------------------
        */

        if ($request->hasFile('image')) {

            // hapus cover lama
            if ($article->image) {

                $oldCover = public_path('storage/' . $article->image);

                if (File::exists($oldCover)) {
                    File::delete($oldCover);
                }
            }

            // upload cover baru
            $validated['image'] = $request
                ->file('image')
                ->store('articles', 'public');

        }

        /*
        |-----------------------------------------
        | 2. Hapus gambar body yang sudah dihapus
        |-----------------------------------------
        */

        // 1. Ekstrak semua src gambar dari body artikel menggunakan Regex
        preg_match_all('/<img[^>]+src="([^">]+)"/i', $article->body, $oldImages);

        preg_match_all('/<img[^>]+src="([^">]+)"/i', $validated['body'], $newImages);

        $oldImages = $oldImages[1] ?? [];
        $newImages = $newImages[1] ?? [];

        $deletedImages = array_diff($oldImages, $newImages);

        foreach ($deletedImages as $imageUrl) {

            $relativePath = str_replace(asset('storage') . '/', '', $imageUrl);

            $imagePath = public_path('storage/' . $relativePath);

            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        /*
        |-----------------------------------------
        | 3. Update Data
        |-----------------------------------------
        */
        $article->update($validated);

        return redirect('/admin/article')
            ->with('success', 'Artikel berhasil diperbarui.');
    }

    public function delete($id)
    {
        $article = Article::findOrFail($id);

        /*
        |----------------------------------------------------------
        | 1. Hapus gambar cover
        |----------------------------------------------------------
        */
        if ($article->image) {

            $coverPath = public_path('storage/' . $article->image);

            if (File::exists($coverPath)) {
                File::delete($coverPath);
            }
        }

        /*
        |----------------------------------------------------------
        | 2. Cari semua gambar di dalam body
        |----------------------------------------------------------
        */
        preg_match_all('/<img[^>]+src="([^">]+)"/i', $article->body, $matches);

        if (!empty($matches[1])) {

            foreach ($matches[1] as $imageUrl) {

                /*
                 * Contoh:
                 * http://localhost/storage/articles/content/a.jpg
                 * menjadi:
                 * articles/content/a.jpg
                 */

                $relativePath = str_replace(asset('storage') . '/', '', $imageUrl);

                $imagePath = public_path('storage/' . $relativePath);

                if (File::exists($imagePath)) {
                    File::delete($imagePath);
                }
            }
        }

        /*
        |----------------------------------------------------------
        | 3. Hapus artikel
        |----------------------------------------------------------
        */
        $article->delete();

        return redirect('/admin/article')
            ->with('success', 'Berhasil menghapus data');
    }

    public function deleteImage(Request $request)
    {
        $imageUrl = $request->input('src');

        if ($imageUrl) {
            // Ambil path relatif file (misal: articles/namafile.jpg)
            $path = parse_url($imageUrl, PHP_URL_PATH);
            $relativePath = str_replace('storage/', '', $path);

            // Hapus file dari disk public
            if (Storage::disk('public')->exists($relativePath)) {
                Storage::disk('public')->delete($relativePath);
                return response()->json(['message' => 'Gambar berhasil dihapus dari storage.']);
            }
        }

        return response()->json(['message' => 'Gambar tidak ditemukan.'], 404);
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('upload') && $request->file('upload')->isValid()) {

            // Simpan gambar ke storage/app/public/articles
            $path = $request->file('upload')->store('articles', 'public');

            // Kembalikan URL publik gambar
            return response()->json([
                'url' => asset('storage/' . $path)
            ]);
        }

        return response()->json(['error' => 'Gagal mengunggah gambar.'], 400);
    }

    public function indexArticlePage(Request $request)
    {
        $articles = Article::latest()->paginate(5);

        $latestArticles = Article::latest()
            ->take(5)
            ->get();

        $mostVisited = Article::orderByDesc('views')
            ->take(5)
            ->get();

        return view('pages.article', compact(
            'articles',
            'latestArticles',
            'mostVisited'
        ));
    }

    public function showArticle($slug)
    {
        $article = Article::where('slug', $slug)->firstOrFail();

        $latestArticles = Article::latest()
            ->take(5)
            ->get();

        $mostVisited = Article::orderByDesc('views')
            ->take(5)
            ->get();

        // Menambah jumlah kunjungan
        $article->increment('views');

        return view('pages.articleShow', compact(
            'article',
            'latestArticles',
            'mostVisited'
        ));
    }
}
