<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ReviewController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('name')->get();
        $reviews = Review::with('product')
            ->latest()
            ->paginate(5);

        return view('admin.reviews.index', compact(
            'reviews',
            'products'
        ));
    }

    public function create()
    {
        $products = Product::all();

        return view('admin.reviews.create', compact('products'));
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:product,id',
            'name'       => 'required|max:100',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'required',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Upload foto
        if ($request->hasFile('photo')) {

            $validated['photo'] = $request
                ->file('photo')
                ->store('reviews', 'public');
        }

        Review::create($validated);

        return redirect('/admin/review')
            ->with('success', 'Review berhasil ditambahkan.');
    }
    public function edit(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }
    public function update(Request $request, Review $review)
    {
        $validated = $request->validate([
            'product_id' => 'required|exists:product,id',
            'name'       => 'required|max:100',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'required',
            'photo'      => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('photo')) {

            // Hapus foto lama
            if ($review->photo && Storage::disk('public')->exists($review->photo)) {
                Storage::disk('public')->delete($review->photo);
            }

            $validated['photo'] = $request
                ->file('photo')
                ->store('reviews', 'public');
        }

        $review->update($validated);

        return redirect('/admin/review')
            ->with('success', 'Review berhasil diperbarui.');
    }
    public function delete(Review $review)
    {

        if ($review->photo && Storage::disk('public')->exists($review->photo)) {
            Storage::disk('public')->delete($review->photo);
        }

        $review->delete(); 

        return redirect('/admin/review')->with('success', 'Berhasil menghapus data');
    }
}
