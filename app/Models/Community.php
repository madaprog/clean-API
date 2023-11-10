<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;

    protected $fillable = ['name','privacy','user_id','description'];

    public function community_member(){
        return $this->hasMany(Community_Member::class);
    }
}
