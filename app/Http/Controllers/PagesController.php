<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\PostRepository;
use App\Repositories\BannerRepository;
use View, Input, Session;
use Auth;

class PagesController extends Controller
{

	public function __construct(Request $request, PostRepository $post, BannerRepository $banner){
    	
    	$this->post=$post;
    	$this->banner=$banner;
    	$this->request = $request;
    }

    /*-----------------  Home Page -------------------*/
    public function index(){

    	$banners=$this->banner->getAll();
    	$posts=$this->post->getAll();

    	return view('pages/index')->with('banners', $banners)->with('posts', $posts);
    }
   
}
