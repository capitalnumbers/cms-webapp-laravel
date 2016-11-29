<?php

namespace App\Repositories;

use App\Model\PostCategory;

class PostCategoryRepository implements Main
{
	private $model;

	/**@----------- Constructor --------------*/
	public function __construct(PostCategory $model){

		$this->model = $model;
	}

	/**@---------- Get All Category ------------*/
	public function getAll($array=false){

		if($array)
			return $this->model->get()->toArray();
		else
			return $this->model->get();
	}

	/**@--------- Get category By Id -----------*/
	public function getById($id){

		return $this->model->find($id);
	}

	/**@------------ Create New Category ------------*/
	public function create(array $attributes){

		return $this->model->create($attributes);
	}

	/**@------------ Update Category Data------------*/
	public function update($id, array $attributes){

		return $this->model->find($id)->update($attributes);
	}

	/**@------------ Delete Category --------------*/
	public function delete($id){
		
		return $this->model->find($id)->delete();
	}
}