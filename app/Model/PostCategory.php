<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    protected $fillable = ['parent_id', 'name', 'description', 'image'];  //database fields to be worked 

    public function post()
	{
	    return $this->hasMany('App\Model\Post', 'post_category_id', 'id');
	}
}
