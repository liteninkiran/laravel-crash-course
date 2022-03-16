<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostLikeController extends Controller
{
    public function __construct() {
        $this->middleware(['auth']);
    }

    /**
     * Display the specified resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param Post $post
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Post $post) {

        if($post->likedBy(auth()->user())) {
            return response(null, 409);
        }

        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);

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
        $user = auth()->user();
        // Check user is deleting their own like
        if (!$post->likedBy($user)) {
            return redirect('/posts')->with('error', 'Unauthorised Access');
        }

        // Delete the post
        $user->likes()->where('post_id', $post->id)->delete();

        // Re-direct
        return back();
    }
}
