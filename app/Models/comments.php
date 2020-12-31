<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models;

//comment class intence refer to the comment table in database
class comments extends Model
{
    use HasFactory;
    //protect comments table in db
    protected $guarded = [];
    // user who was commented
    public function author(){
        return $this->belongsTo('App\Models\User','from_user');
    }
    //return post of any post
    public function post(){
        return $this->belongsTo('App\Models\posts','on_post');
    }
}
