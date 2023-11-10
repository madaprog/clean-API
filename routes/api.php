<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\CommunityMemberController;
use App\Http\Controllers\LikesController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TipsController;
use App\Models\Community_Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

//User
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'user_login']);


//PostsResource

//Community

//Notes(Tips)


//Profile




Route::group(['middleware' => ['auth:sanctum']], function(){

    //TIPS
    Route::post('/tips/create', [TipsController::class, 'store']);

    //POST
    Route::put('/post/update/{post}' , [PostController::class, 'update']);
    Route::put('/post/delete/{post}' , [PostController::class, 'destroy']);
    Route::get('/post/get_posts', [PostController::class, 'index']);
    Route::post('/post/like/create', [LikesController::class, 'store']);
    Route::post('/post/comment/create', [CommentsController::class, 'store']);
    Route::post('/post/create', [PostController::class, 'store']);

    //COMMUNITY
    Route::post('/community/member/join', [CommunityMemberController::class, 'store']);
    Route::post('/community/create', [CommunityController::class, 'store']);
    Route::get('/community/getCommunity', [CommunityController::class, 'index']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
