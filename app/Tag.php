<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;


class Tag extends Model
{
   protected $fillable=['tag'];
   function posts(){
      return $this->hasMany(Post::class);
   }

}
