<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Tips;
use Illuminate\Support\Facades\Auth;
use Mockery\Exception;


class TipsController extends Controller
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
            'title' => 'required|max:10',
            'content' => 'required',
            'user_id' => 'required'
        ]);


        Tips::create([
            'title' => $field['title'],
            'content' => $field['content'],
            'user_id' => $field['user_id']
        ]);

        return response([
            'success' => 'tip added successfully',
        ], 200);

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
    public function update(Request $request, Tips $tips)
    {

        if (Auth::user()->id != $tips->user_id){
            return response([
                'message' => 'You dont own the post'
            ],403);
        }

        $tips->update($request->post());

        return response([
            $tips
        ], 200);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tips $tips)
    {

        try {

            if (Auth::user()->id != $tips->user_id){
                return response([
                    'message' => 'You dont own the post'
                ],403);
            }
            $tips->delete();
            return response(['message' => 'Tip deleted succuessfuly']);
        } catch (Exception $e) {
            return response(['message' => $e], 500);
        }
    }

}
