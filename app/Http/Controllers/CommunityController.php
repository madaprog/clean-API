<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Community;
use Exception;

class CommunityController extends Controller
{


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $community = Community::where('user_id', Auth::user()->id)->get();

        return response([
            'data' => $community
        ],200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $field = $request->validate([
            'name' => 'required|max:20',
            'privacy' => 'required',
            'user_id' => 'required',
            'description' => 'required|max:255',
        ]);


        Community::create([
           'name' => $field['name'],
           'privacy' => $field['privacy'],
           'user_id' => $field['user_id'],
           'description' =>  $field['description']
        ]);




        return response([
            'success' => 'community_created'
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
