<?php

namespace App\Http\Controllers;

use App\Http\Resources\PostsResource;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : AnonymousResourceCollection
    {

        $posts = Post::with(['user','Post_Comment.user','Post_Likes'])->withCount(['Post_Likes','Post_Comment'])->get();
        return PostsResource::collection($posts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Post::create($request->all());
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
    public function update(Request $request, Post $post)
    {

        if (Auth::user()->id != $post->user_id){
            return response([
                'message' => 'You dont own the post'
            ],403);
        }

        $post->update($request->post());

        return response([
           'message'=>'Post updated'
        ],201);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Post $post)
    {
        try {
            if (Auth::user()->id != $post->user_id){
                return response([
                    'message' => 'You dont own the post'
                ],403);
            }
            return response(['message'=>'Post deleted succuessfuly']);
        }catch (Exception $e){
            return response(['message' => $e],500 );
        }
    }
}
