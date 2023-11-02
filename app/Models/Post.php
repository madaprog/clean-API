<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'description',
        'mode'
    ];


    //relationships
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function post_likes(){
        return $this->hasMany(Post_Likes::class);
    }

    public function post_comment(){
        return $this->hasMany(Post_Comment::class);
    }
}
