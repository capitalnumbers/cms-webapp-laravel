<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['post_category_id', 'title', 'slug', 'type', 'description', 'image'];  

    public function post_category()
	{
	    return $this->belongsTo('App\Model\PostCategory', 'post_category_id', 'id');
	}
}
