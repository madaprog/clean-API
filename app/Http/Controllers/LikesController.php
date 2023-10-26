<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Post_Likes;

class LikesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $fields = $request->validate([
            'post_id' => 'Required',
            'user_id' => 'Required'
       ]);

       $post = Post::find($fields['post_id']);

       if($post->post_likes()->where('user_id', $fields['user_id'])->exists()){
            return response([
                'Error' => 'Already liked this post'
            ], 401);
       }

       $like = new Post_Likes();
       $like->user_id = $fields['user_id'];
       $post->post_likes()->save($like);

       return response([
        'Success' => 'Post liked'
       ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
