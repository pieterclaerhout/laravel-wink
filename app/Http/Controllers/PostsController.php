<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Wink\WinkPost;

class PostsController extends Controller
{
    public function index()
    {
        $posts = WinkPost::with('tags')
            ->live()
            ->orderBy('publish_date', 'DESC')
            ->paginate(10);

        return view('posts.index', [
            'posts' => $posts,
        ]);
    }

    public function single($slug)
    {
        $post = WinkPost::live()->whereSlug($slug)->firstOrFail();
        return view('posts.single', compact('post'));
    }
}
