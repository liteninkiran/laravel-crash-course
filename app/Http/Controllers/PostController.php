<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $posts = Post::query()
            ->with(['user', 'likes'])
            ->orderBy('created_at', 'desc')
            ->paginate(env('PAGINATE_LIMIT'));
        return view('posts.index', compact('posts'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate inputs
        $this->validate($request, [
            'body' => 'required',
        ]);

        $post = auth()->user()->posts()->create([
            'body' => $request->body,
        ]);

        // Re-direct
        return back();
    }
}
