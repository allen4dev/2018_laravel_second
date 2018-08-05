<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Post;

class PostController extends Controller
{
    public function show(Post $post)
    {
        return response()->json($post);
    }

    public function store()
    {
        $post = Post::forceCreate(request()->only('title'));
        return response()->json($post);
    }
}
