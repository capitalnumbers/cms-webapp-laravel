<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\BannerRepository;
use View, Input, Session;
use Auth;

class BannersController extends Controller
{
    
    public function __construct(Request $request, BannerRepository $banner){

    	$this->banner=$banner;
    	$this->request = $request;
    }

    /**@---------- All Banners -------------*/
    public function index(){

    	$banners=$this->banner->getAll();

    	return view('banners/index')->with('banners', $banners);
    }

    /**@---------- Create new Banner -------------*/
    public function create(){

    	return view('banners/create');
    }

    /**@---------- Edit Banner -------------*/
    public function edit($id=''){

    	$banner=$this->banner->getById($id);

    	return view('banners/edit')->with('banner', $banner);
    }

    /**@---------- Save Banner ----------------*/
    public function save(){
    	$validation=$this->validation($this->request);
        if($validation['status']==1){
        	if ($this->request->hasFile('images')) {
	            if ($this->request->file('images')->isValid()) {
	                $extension=$this->request->file('images')->getClientOriginalExtension(); 
	                $fileName = time().rand(11111,99999).'.'.$extension;
	                public_path().DS.'images'.DS.'bannerImages';
	                $this->request->file('images')->move(public_path().DS.'images'.DS.'bannerImages', $fileName);
	                $this->request->merge(['image' => $fileName]);
	            }
	        }
        	if($this->request->id){
        		if ($this->request->hasFile('images')){
        			if($this->request->prev_image)@unlink(public_path().DS.'images'.DS.'bannerImages'.DS.$this->request->prev_image);
        		}
        		$banner= $this->banner->update($this->request->id, $this->request->all());
		        Session::flash('success', 'Post Updated');
        		return redirect(url('administrator/banners'));
        	}else{
        		$this->request->merge(['active' => 'Yes']);
        		$this->banner->create($this->request->all());
        		Session::flash('success', 'Post created');
        		return redirect(url('administrator/banners'));
        	}
        	
        }else{

            Session::flash('error', $validation['message']);
            if($this->request->id){

            	return redirect(url('administrator/banner/edit/'.$this->request->id)); 
        	}else{

        		return redirect(url('administrator/banner/create')); 
        	}
        }
    }

    /**@----------  change Active Inactive status -----------*/
    public function change_status(){
    	
    	if(isset($this->request->id)){

    		$active=($this->request->active)?$this->request->active:'No';
    		$this->banner->update($this->request->id, ['active'=>$active]);
    		$return=1;
    	}else{

    		$return=0;
    	}
    	
    	return $return;
    }

    /**@----------------  Delete Banner -------------*/
    public function delete(){
    	if(isset($this->request->id)){

    		$branch=$this->banner->delete($this->request->id);
    	
    		$return=1;
    	}
    }

    /**@----------------- Validation --------------*/
    private function validation($data){

    	$status=1; //initiate status success
        $message='';

        if(!isset($data->title) || $data->title=='' ){
            $message .=" *Please enter banner title";
            $status=-1; //error status
        }
        if(isset($data->title) && $data->title!='' && !preg_match('/^[a-zA-Z ]*$/', $data->title)){
            $message .=" *Please enter valid banner title";
            $status=-1; //error status
        }
        if(isset($data->description) && $data->description!='' && preg_match('/\<script(.*?)?\>/', html_entity_decode($data->description))){
        	$message .=" *Script not allowed in description";
            $status=-1; //error status
        }
     
        return ['status'=>$status, 'message'=>$message];
    }
}
