<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use View, Input, Session;
use Auth;

class PostsController extends Controller
{
    
    public function __construct(Request $request, PostRepository $post){

    	$this->post=$post;
    	$this->request = $request;
    }

    /**@---------- All Posts -------------*/
    public function index(){

    	$posts=$this->post->getAll();

    	return view('posts/index')->with('posts', $posts);
    }

    /**@---------- Create new post -------------*/
    public function create(){

    	return view('posts/create');
    }

    /**@---------- Edit Post -------------*/
    public function edit($id=''){

    	$post=$this->post->getById($id);

    	return view('posts/edit')->with('post', $post);
    }

    /**@---------- Save Post ----------------*/
    public function save(){
    	$validation=$this->validation($this->request);
        if($validation['status']==1){
            $this->request->merge(['active' => 'Yes']);
        	if($this->request->id){
        		$post= $this->post->update($this->request->id, $this->request->all());
		        Session::flash('success', 'Post Updated');
        		return redirect(url('administrator/posts'));
        	}else{
        		$this->post->create($this->request->all());
        		Session::flash('success', 'Post created');
        		return redirect(url('administrator/posts'));
        	}
        	
        }else{

            Session::flash('error', $validation['message']);
            if($this->request->id){

            	return redirect(url('administrator/post/edit/'.$this->request->id)); 
        	}else{

        		return redirect(url('administrator/post/create')); 
        	}
        }
    }

    /**@----------  change Active Inactive status -----------*/
    public function change_status(){
    	
    	if(isset($this->request->id)){

    		$active=($this->request->active)?$this->request->active:'No';
    		$this->post->update($this->request->id, ['active'=>$active]);
    		$return=1;
    	}else{

    		$return=0;
    	}
    	
    	return $return;
    }

    /**@----------------  Delete Post -------------*/
    public function delete(){
    	if(isset($this->request->id)){

    		$branch=$this->post->delete($this->request->id);
    	
    		$return=1;
    	}
    }

    /**@----------------- Validation --------------*/
    private function validation($data){

    	$status=1; //initiate status success
        $message='';

        if(!isset($data->name) || $data->name=='' ){
            $message .=" *Please enter Country name";
            $status=-1; //error status
        }
        
        if(isset($data->name) && $data->name!='' && !preg_match('/^[a-zA-Z ]*$/', $data->name)){
            $message .=" *Please enter valid Country name";
            $status=-1; //error status
        }

        return ['status'=>$status, 'message'=>$message];
    }
}
