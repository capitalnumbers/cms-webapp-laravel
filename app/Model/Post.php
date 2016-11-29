<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['post_category_id', 'title', 'slug', 'type', 'description', 'image'];  //database fields to be worked
}
