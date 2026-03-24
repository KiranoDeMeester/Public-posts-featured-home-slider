<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Category $category)
    {
        // We halen de posts op die aan deze categorie gekoppeld zijn
        $posts = $category->posts()
            ->with(['user', 'media', 'categories']) // Eager loading voor snelheid
            ->where('is_published', true)           // EXAMEN EIS: Enkel gepubliceerd
            ->whereNotNull('published_at')          // Extra check op datum
            ->latest('published_at')                // Nieuwste bovenaan
            ->paginate(9);                          // Paginatie zoals op het hoofoverzicht

        return view('frontend.categories.show', [
            'category' => $category,
            'posts' => $posts
        ]);
    }
}
