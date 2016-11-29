<?php

/**@----------------------------------- Web Routes ------------------*/
Route::get('/', function () {
    return view('welcome');
});

/**@----------------------- Admin Area ------------------------------*/
Route::group(['prefix'=>'administrator','middleware' => ['auth']], function(){

	/**@----------------- Admin Settings --------------*/
	Route::get('settings', 'SettingsController@index');
	Route::post('settings', 'SettingsController@index');
	
	/**@--------------- Users Section -----------------*/
	Route::get('users', 'UsersController@index');
	Route::get('user/create', 'UsersController@create'); //create a new users
	Route::get('user/edit/{id}', 'UsersController@edit'); //Edit users
	Route::post('user/save', 'UsersController@save'); //Save users data
	Route::post('user/delete', 'UsersController@delete'); //Delete users
	Route::post('user/change-status', 'UsersController@change_status');//change active status ajax
	Route::post('user/block-unblock', 'UsersController@block_unblock');//Block Unblock Users
	Route::get('user/profile', 'UsersController@profile'); //Users Profile
	Route::post('user/update-profile', 'UsersController@update_profile'); //Update Users Profile
	Route::get('user/change-password', 'UsersController@change_password'); //Users Profile
	Route::post('user/save-password', 'UsersController@save_password'); //Users Profile

	/**@--------------- Post Category ----------------*/
	Route::get('post-categories', 'PostCategoriesController@index');
	Route::get('post-category/create', 'PostCategoriesController@create'); //create a new Post Category
	Route::get('post-category/edit/{id}', 'PostCategoriesController@edit'); //Edit Post Category
	Route::post('post-category/save', 'PostCategoriesController@save'); //Save Post Category data
	Route::post('post-category/delete', 'PostCategoriesController@delete'); //Delete Post Category
	Route::post('post-category/change-status', 'PostCategoriesController@change_status');//change active status ajax

	/**@--------------- Post ----------------*/
	Route::get('posts', 'PostsController@index');
	Route::get('post/create', 'PostsController@create'); //create a new Post 
	Route::get('post/edit/{id}', 'PostsController@edit'); //Edit Post 
	Route::post('post/save', 'PostsController@save'); //Save Post  data
	Route::post('post/delete', 'PostsController@delete'); //Delete Post 
	Route::post('post/change-status', 'PostsController@change_status');//change active status ajax

});

Auth::routes();

Route::get('/home', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index');
