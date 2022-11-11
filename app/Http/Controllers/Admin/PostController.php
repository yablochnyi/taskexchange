<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\Post\PostEditResource;
use App\Http\Resources\Admin\Post\PostResource;
use App\Models\Post\Category;
use App\Models\Post\Post;
//use Illuminate\Http\Request;
use App\Models\Post\PostCategory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        $postsResource = PostResource::collection(Post::all());
        return Inertia::render('Admin/Posts/ListView', compact('postsResource'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Inertia\Response
     */
    public function create()
    {
        $categories = Category::all();

        return Inertia::render('Admin/Posts/CreateView', compact('categories'));
    }


    public function store(): \Illuminate\Http\RedirectResponse
    {

        $image = Request::file('image')->store('topics', 'public');
        $user_id = Auth::id();
        $post = Post::create([
            'title' => Request::input('title'),
            'short' => Request::input('short'),
            'text' => Request::input('text'),
            'main_image' => $image,
            'user_id' => $user_id,
            'status' => 1
        ]);
        PostCategory::create([
            'category_id' => Request::input('category'),
            'post_id' => $post->id
        ]);

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Inertia\Response
     */
    public function edit($id)
    {
        $post = new PostEditResource(Post::find($id));
        return Inertia::render('Admin/Posts/EditView', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, Post $post)
    {
        dd($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        Post::where('id', $id)->delete();

        return redirect()->route('posts.index');
    }
}
