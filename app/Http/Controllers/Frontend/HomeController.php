<?php

declare(strict_types=1);

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        // 1. Haal de featured posts op (max 4)
        $featuredPosts = Post::query()
            ->with(['user', 'categories', 'media'])
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(4)
            ->get();

        if ($featuredPosts->count() < 4) {
            $shortage = 4 - $featuredPosts->count();
            $recentPosts = Post::query()
                ->with(['user', 'categories', 'media'])
                ->where('is_published', true)
                ->whereNotNull('published_at')
                ->whereNotIn('id', $featuredPosts->pluck('id'))
                ->latest('published_at')
                ->take($shortage)
                ->get();

            $featuredPosts = $featuredPosts->merge($recentPosts);
        }
        $latestPosts = Post::query()
            ->with(['user', 'categories', 'media'])
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->take(8)
            ->get();
        $categoryPosts = Post::query()->with(['user', 'categories', 'media'])
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->skip(4)
            ->take(10)
            ->get();
        $videoPosts = Post::query()
            ->with(['user', 'categories', 'media'])
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->skip(8)
            ->take(8)
            ->get();
        $editorialPosts = Post::query()
            ->with(['user', 'categories', 'media'])
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->skip(16)
            ->take(4)
            ->get();
        $categories = Category::query()
            ->withCount([
                'posts' => function ($query) {
                    $query->where('is_published', true)
                        ->whereNotNull('published_at');
                },
            ])
            ->having('posts_count', '>', 0)
            ->orderByDesc('posts_count')
            ->take(6)
            ->get();

        return view('frontend.home', [
            'featuredPosts' => $featuredPosts,
            'latestPosts' => $latestPosts,
            'categoryPosts' => $categoryPosts,
            'videoPosts' => $videoPosts,
            'editorialPosts' => $editorialPosts,
            'categories' => $categories,
        ]);
    }
}
