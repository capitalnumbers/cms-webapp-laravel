<?php

namespace App\Repositories;

use App\Model\Banner;

class BannerRepository implements Main
{
	private $model;

	/**@----------- Constructor --------------*/
	public function __construct(Banner $model){

		$this->model = $model;
	}

	/**@---------- Get All Banners ------------*/
	public function getAll(){

		return $this->model->get();
	}

	/**@--------- Get Banner By Id -----------*/
	public function getById($id){

		return $this->model->find($id);
	}

	/**@------------ Create New Banner ------------*/
	public function create(array $attributes){

		return $this->model->create($attributes);
	}

	/**@------------ Update Banner Data------------*/
	public function update($id, array $attributes){

		return $this->model->find($id)->update($attributes);
	}

	/**@------------ Delete Banner --------------*/
	public function delete($id){
		
		return $this->model->find($id)->delete();
	}
}