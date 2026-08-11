<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Article;
use App\Models\Review;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function productFirst()
    {
        $products = Product::where('gender', 'Man')->latest()
        ->take(10)->get();

        $articles = Article::latest()
                    ->take(3)->get();

        $reviews = Review::latest()->take(10)->get();
        return view('index', [
            'products' => $products,
            'articles' => $articles,
            'reviews' => $reviews,
        ]);
    }

    public function filterProduct(Request $request)
    {
        $gender = $request->gender;

        $products = Product::where('gender', $gender)->latest()
        ->take(10)->get();

        return response()->json($products);
    }

}
