<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use App\Tag;
use App\Role;

class Comment extends Model
{
    protected $fillable=['id','comment','user_id','post_id'];
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}