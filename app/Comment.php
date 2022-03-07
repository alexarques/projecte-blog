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
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    // public function comments(){
    //     return $this->belongsTo(Comments::class);
    // }
    
}