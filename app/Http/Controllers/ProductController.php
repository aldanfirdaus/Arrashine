<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use App\Models\Review;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
class ProductController extends Controller
{
    public function index(Request $request)
    {

        $query = Product::query();

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%$search%")
                    ->orWhere('top_notes', 'like', "%$search%")
                    ->orWhere('middle_notes', 'like', "%$search%")
                    ->orWhere('base_notes', 'like', "%$search%");

            });

        }

        // Filter Gender
        if ($request->filled('gender')) {

            $query->where('gender', $request->gender);

        }

        $products = $query
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',

            'top_notes' => 'required',
            'middle_notes' => 'required',
            'base_notes' => 'required',

            'gender' => 'required|in:Man,Women,Unisex',

            'price' => 'required|numeric',

            // Gambar utama
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',

            // Link marketplace
            'shopee_link' => 'nullable|url',
            'tokopedia_link' => 'nullable|url',
            'tiktokshop_link' => 'nullable|url',

            // Gambar galeri
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // =========================
        // GAMBAR UTAMA
        // =========================

        if ($request->hasFile('image')) {

            $validated['image'] = $request
                ->file('image')
                ->store('products', 'public');
        }

        // =========================
        // HAPUS images DARI validated
        // =========================

        $galleryImages = $request->file('images');


        unset($validated['images']);

        // SIMPAN PRODUK
        $product = Product::create($validated);

        // =========================
        // SIMPAN GAMBAR GALERI
        // =========================

        if ($galleryImages) {

            foreach ($galleryImages as $image) {

                $imagePath = $image->store(
                    'products/gallery',
                    'public'
                );

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imagePath,
                ]);
            }
        }

        return redirect('/admin/product')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit($id)
    {

        $product = Product::with('images')->findOrFail($id);
        return view('admin.products.edit', [
            'product' => $product,
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'top_notes' => 'required',
            'middle_notes' => 'required',
            'base_notes' => 'required',
            'gender' => 'required|in:Man,Women,Unisex',
            'price' => 'required|numeric',

            // Gambar utama
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

            // Gambar galeri baru
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',

            'shopee_link' => 'nullable|url',
            'tokopedia_link' => 'nullable|url',
            'tiktokshop_link' => 'nullable|url',
        ]);

        // UPDATE GAMBAR UTAMA
        if ($request->hasFile('image')) {

            // Hapus gambar lama
            // Hapus foto lama
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            $validated['image'] = $request
                ->file('image')
                ->store('products', 'public');

        }

        // =====================================
        // JANGAN MASUKKAN images KE PRODUCT
        // =====================================

        $galleryImages = $request->file('images');

        unset($validated['images']);

        // UPDATE DATA PRODUK
        $product->update($validated);

        // =====================================
        // TAMBAHKAN GAMBAR GALERI BARU
        // =====================================

        if ($galleryImages) {

            foreach ($galleryImages as $image) {

                $imagePath = $image->store(
                    'products/gallery',
                    'public'
                );

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imagePath,
                ]);
            }
        }

        return redirect('/admin/product')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    public function delete($id)
    {
        $product = Product::with('images')->findOrFail($id);

        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // =====================================
        // HAPUS SEMUA GAMBAR GALERI
        // =====================================

        foreach ($product->images as $image) {

            if (
                $image->image &&
                Storage::disk('public')->exists($image->image)
            ) {
                Storage::disk('public')->delete($image->image);
            }

            $image->delete();
        }

        // HAPUS PRODUK
        $product->delete();

        return redirect('/admin/product')->with('success', 'Berhasil menghapus data');
    }

    public function indexProductPage(Request $request)
    {
        $query = Product::query();

        // Search
        if ($request->filled('search')) {

            $search = $request->search;

            $query->where(function ($q) use ($search) {

                $q->where('name', 'like', "%$search%")
                    ->orWhere('top_notes', 'like', "%$search%")
                    ->orWhere('middle_notes', 'like', "%$search%")
                    ->orWhere('base_notes', 'like', "%$search%");

            });

        }

        // Filter Gender
        if ($request->filled('gender')) {

            $query->where('gender', $request->gender);

        }

        $products = $query
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('pages.product', compact('products'));
    }

    public function show($id)
    {
        $product = Product::with('images')->findOrFail($id);

        $admin = User::first();

        $reviews = Review::where('product_id', $product->id)->get();

        return view('pages.productShow', compact('product', 'admin', 'reviews'));
    }

    public function deleteGalleryImage($id)
    {
        $image = ProductImage::findOrFail($id);

        // Hapus file dari storage
        if (Storage::disk('public')->exists($image->image)) {

            Storage::disk('public')->delete($image->image);

        }

        // Hapus data database
        $image->delete();

        return response()->json([
            'success' => true
        ]);
    }
}
