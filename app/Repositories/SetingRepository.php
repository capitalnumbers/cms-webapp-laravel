<?php

namespace App\Repositories;

use App\User;

class UserRepository implements Main
{
	private $model;

	/**@----------- Constructor --------------*/
	public function __construct(User $model){

		$this->model = $model;
	}

	/**@---------- Get All Users ------------*/
	public function getAll(){

		return $this->model->get();
	}

	/**@--------- Get User By Id -----------*/
	public function getById($id){

		return $this->model->find($id);
	}

	/**@------------ Create New User ------------*/
	public function create(array $attributes){

		return $this->model->create($attributes);
	}

	/**@------------ Update User Data------------*/
	public function update($id, array $attributes){

		return $this->model->find($id)->update($attributes);
	}

	/**@------------ Delete User --------------*/
	public function delete($id){
		
		return $this->model->find($id)->delete();
	}
}