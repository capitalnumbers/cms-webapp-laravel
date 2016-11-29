<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\PostCategoryRepository;
use View, Input, Session;
use Auth;

class PostCategoriesController extends Controller
{
    
    public function __construct(Request $request, PostCategoryRepository $postCategory){
    	$this->postCategory=$postCategory;
    	$this->request = $request;
    }

    /**@---------- Post Categories-------------*/ 
    public function index(){
        
    	$categories=$this->postCategory->getAll('true');
        $categories=json_decode(json_encode($this->tree($categories)));
        
    	return view('post_categories/index')->with('categories', $categories);
    }

    /**@---------- Business Category new Categorie -------------*/
    public function create(){
        $categories=$this->postCategory->getAll('true');
        $categories=$this->drop_down($categories);
        $categories[0]='Null'; 
        ksort($categories);
                
    	return view('post_categories/create')->with('categories',$categories);
    }

    /**@---------- Edit Business Category -------------*/
    public function edit($id=''){

        $category=$this->postCategory->getById($id);
    	$categories=$this->postCategory->getAll('true');
        $categories=$this->drop_down($categories);
        $categories[0]='Null'; 
        ksort($categories);

    	return view('post_categories/edit')->with('categories', $categories)->with('category',$category);
    }

    /**@---------- Save  Business Category ----------------*/
    public function save(){
    	$validation=$this->validation($this->request);
        if($validation['status']==1){
        	if($this->request->id){
        		$category= $this->postCategory->update($this->request->id, $this->request->all());
		        Session::flash('success', ' Category Updated');
        		return redirect(url('administrator/post-categories'));
        	}else{
        		$this->postCategory->create($this->request->all());
        		Session::flash('success', ' Category created');
        		return redirect(url('administrator/post-categories'));
        	}
        	
        }else{

            Session::flash('error', $validation['message']);
            if($this->request->id){

            	return redirect(url('administrator/post-category/edit'.$this->request->id)); 
        	}else{

        		return redirect(url('administrator/post-category/create')); 
        	}
        }
    }

    /**@----------  change Active Inactive status -----------*/
    public function change_status(){
    	
    	if(isset($this->request->id)){
    		$active=($this->request->active)?$this->request->active:'No';
    		$this->postCategory->update($this->request->id, ['active'=>$active]);
    		$return=1;
    	}else{

    		$return=0;
    	}
    	
    	return $return;
    }

    /**@----------------  Delete  Post Category -------------*/
    public function delete(){
    	if(isset($this->request->id)){

    		$this->postCategory->delete($this->request->id);
    	
    		$return=1;
    	}
    }

    /**@----------------- Validation --------------*/
    private function validation($data){

    	$status=1; //initiate status success
        $message='';

        if(!isset($data->name) || $data->name=='' ){
            $message .=" *Please enter Category name";
            $status=-1; //error status
        }

        return ['status'=>$status, 'message'=>$message];
    }

    /**@-------------------  Get prent child as tree  ------------*/
   private function tree($data){
        $itemsByReference = array();
        foreach($data as $key => &$item) { 
			$itemsByReference[$item['id']] = &$item;
			$itemsByReference[$item['id']]['children'] = array();
			$itemsByReference[$item['id']]['data'] = new \stdClass();
        }
        foreach($data as $key => &$item)
         	if(isset($item['parent_id']) && $item['parent_id'] && isset($itemsByReference[$item['parent_id']]))
            $itemsByReference [$item['parent_id']]['children'][] = &$item;
        foreach($data as $key => &$item) {
         	if(isset($item['parent_id']) && $item['parent_id'] && isset($itemsByReference[$item['parent_id']]))
            unset($data[$key]);
        }

        return $data;
      }

    /**@----------- Get Drop Down Array ----------------*/
    private function drop_down($data){
    	$data=$this->tree($data);
    	$arr=[];
        foreach ($data as $key => $value) {
            $arr[$value['id']]=isset($value['name'])?$value['name']:'';
            if(isset($value['children'])){
                foreach ($value['children'] as $sub_key => $sub_value) {
                    $arr[$sub_value['id']]='--'.$sub_value['name'];
                   
                } 
            }
           
        }

        return $arr;

    }

}
