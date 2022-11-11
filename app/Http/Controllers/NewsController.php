<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostFullResource;
use App\Http\Resources\PostResource;
use App\Models\Post\Post;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NewsController extends Controller
{
    public function index()
    {
        $postResource = PostResource::collection(Post::all());
        return Inertia::render('Posts/ListView', compact('postResource'));
    }

    public function show(Post $post)
    {
        $postResource = new PostFullResource($post);
        return Inertia::render('Posts/FullView', compact('postResource'));
    }
}
