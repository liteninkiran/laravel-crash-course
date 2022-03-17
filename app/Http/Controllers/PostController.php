<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function __construct() {
        $this->middleware(['auth'])->only(['store', 'destroy']);
    }

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

    public function show(Post $post) {
        return view('posts.show', compact('post'));
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
    /**
     * Remove the specified resource from storage.
     *
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        // Delete the post
        $post->delete();

        // Re-direct
        return back();
    }
}
