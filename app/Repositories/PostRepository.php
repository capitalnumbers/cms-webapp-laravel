<?php

namespace App\Repositories;

use App\Model\Post;
use App\Model\PostCategory;

class PostRepository implements Main
{
	private $model;

	/**@----------- Constructor --------------*/
	public function __construct(Post $model){

		$this->model = $model;
	}

	/**@---------- Get All Posts ------------*/
	public function getAll(){

		return $this->model->with('post_category')->get();
	}

	/**@--------- Get Post By Id -----------*/
	public function getById($id){

		return $this->model->find($id);
	}

	/**@------------ Create New Post ------------*/
	public function create(array $attributes){

		return $this->model->create($attributes);
	}

	/**@------------ Update Post Data------------*/
	public function update($id, array $attributes){

		return $this->model->find($id)->update($attributes);
	}

	/**@------------ Delete Post --------------*/
	public function delete($id){
		
		return $this->model->find($id)->delete();
	}

	/**@---------- Category dropdown ---------*/
	public function list_category(){

		return PostCategory::pluck('name', 'id')->all();
	}
}