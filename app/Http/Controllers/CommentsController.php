<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Post_Comment;
use Illuminate\Http\Request;

class CommentsController extends Controller
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
        $field = $request->validate([
            'user_id' => 'required',
            'post_id' => 'required',
            'content' => 'required'
        ]);



        $post = Post::find($field['post_id']);

        $comment = new Post_Comment();
        $comment->user_id = $field['user_id'];
        $comment->content = $field['content'];
        $post->post_comment()->save($comment);

        return response([
            'sucess' => 'Commented'
        ],201);


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
