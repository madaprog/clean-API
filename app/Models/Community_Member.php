<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community_Member extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'community_id'];

    public function community(){
        return $this->belongsTo(Community::class);
    }
}
