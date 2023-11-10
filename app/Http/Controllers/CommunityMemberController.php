<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Community_Member;
use Exception;
use Illuminate\Support\Facades\Auth;

class CommunityMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $user = Auth::user();
        $community = Post::with('community_m')->where('user_id',$user->id)->get();
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
            'user_id' => 'required',
            'community_id' => 'required'
        ]);

        try{
            Community_Member::create([
                'user_id' => $field['user_id'],
                'community_id' => $field['community_id']
            ]);
        }catch(Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }


        return response([
            'succuess' => 'Joined'
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

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Community_Member $community_Member)
    {

    }
}
