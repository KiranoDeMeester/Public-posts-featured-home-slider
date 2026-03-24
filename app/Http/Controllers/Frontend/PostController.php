<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        return 'Hier komt later de publieke posts index (Opdracht 4)';
    }

    public function show(Post $post)
    {
        return 'Hier komt later de detailpagina voor: ' . $post->title . ' (Opdracht 6)';
    }
}
