<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $q = $request->query('q');

        $posts = Post::query()
            ->with(['user', 'categories', 'media'])
            ->where('is_published', true)
            ->whereNotNull('published_at')
            ->when($q, function ($query, $q) {
                return $query->search($q);
            })
            ->latest('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('frontend.posts.index', [
            'posts' => $posts,
        ]);
    }

    public function show(Post $post)
    {
        return 'Hier komt later de detailpagina voor: ' . $post->title . ' (Opdracht 6)';
    }
}
