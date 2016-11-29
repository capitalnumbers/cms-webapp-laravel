<?php

namespace App\Http\Controllers;

use Mail;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use View, Input, Session;
use Auth, Hash, Crypt;

class UsersController extends Controller
{
    
	public function __construct(Request $request, UserRepository $user){

		$this->request = $request; 
		$this->user= $user;
	}

	/**@---------- All Users -------------*/
	public function index(){

		$users=$this->user->getAll();

		return view('users/index')->with('users', $users);
	}

	/**@---------- Create new User -------------*/
		public function create(){

		return view('users/create');
	}

	/**@---------- Edit User Data -------------*/
	public function edit($id=''){

		$user=$this->user->getById($id);

		return view('users/edit')->with('user', $user);
	}

	/**@---------- Save User ----------------*/
	public function save(){

		$validation=$this->validation($this->request);
		if($validation['status']==1){         //check for valid input data
			if($this->request->id){
				if($this->user->update($this->request->id, $this->request->all())){
					Session::flash('success', 'User Updated');
				}else{
					ession::flash('error', 'User Not Updated');
				}
			}else{
				if($this->user->create($this->request->all())){
					Session::flash('success', 'User Created');
				}else{
					ession::flash('error', 'User Not Created');
				}
			}
			return redirect(url('administrator/users'));

		}else{
			Session::flash('error', $validation['message']);
			if($this->request->id){
				return redirect(url('administrator/user/edit/'.$this->request->id)); 
			}else{
				return redirect(url('administrator/user/create')); 
			}
		}
	}

    /**@----------  change Active Inactive status -----------*/
	public function change_status(){

		if(isset($this->request->id)){
			$active=($this->request->active)?$this->request->active:'';
			$this->user->update($this->request->id, ['active'=>$active]);
			
			$return=1;
		}else{

			$return=0;
		}

	return $return;
	}

	/**@----------  change Block and Unblock status -----------*/
    public function block_unblock(){
    	
    	if(isset($this->request->id)){
    		$block=($this->request->block)?$this->request->block:'No';
    		$this->user->update($this->request->id, ['block'=>$block]);
    		$return=1;
    	}else{

    		$return=0;
    	}
    	
    	return $return;
    }

    /**@----------------  Delete User -------------*/
	public function delete(){
		if(isset($this->request->id)){
			$this->user->delete($this->request->id);
			$return=1;
		}
	} 

    /**@----------------- Users Profile ------------*/ 
    public function profile(){
        $user=User::find(Auth::user()->_id);
        
        return view('users/profile')->with('user', $user);
    }

    /**@-------------- Update User Profile ---------*/
    public function update_profile(){

		if($this->request->id==Auth::user()->_id){

		$validation=$this->validation($this->request);
		if($validation['status']==1){
		    $profile= User::find($this->request->id)
		        ->fill($this->request->all())
		        ->save();
		    Session::flash('success', 'User updated');
		}else{

		    Session::flash('error', 'You are not authorized');
		}

		return redirect(url('user/profile'));
		}
    }

    /**@------------- Forgot Password Email -----------------*/
	public function forgot_password_email(){

		$curr_email=$this->request->email;
		if($curr_email){
			$user=User::where('email', $curr_email)->first();
			if(!isset($user->email)){
				Session::flash('error', 'Email Not exist');

				return redirect(url('password/reset'));
			}
		}

		$enc_email=Crypt::encrypt($curr_email);
		Mail::send('emails.change_password', ['curr_email'=>$curr_email, 'enc_email'=> $enc_email], function ($m) use($curr_email) {
		$m->from(env('MAIL_USERNAME'), 'Set Password');

		$m->to($curr_email)->subject('Set Password');
		});
		if( count(Mail::failures()) > 0 ) {
			Session::flash('error', 'Mail not send please try again');    
		}else{
			Session::flash('success', 'Password reset mail send please check your email');
		}

		return redirect(url('password/reset'));
	}

    /**@------------------ Set New Password ---------*/
    public function set_password($email){

        return view('auth/passwords/reset')->with('email', $email);
    }

    /**@------------------------- Save new seted Password -------------*/
	public function save_new_password(){

		$email= Crypt::decrypt($this->request->email);

		if($this->request->password=='' || strlen($this->request->password)<6){
			Session::flash('error', 'Please enter valid password');

			return redirect(url('set_password/'.$this->request->email));
		}else if($this->request->password!=$this->request->password_confirmation){
			Session::flash('error', 'Confirm password not match');

			return redirect(url('set_password/'.$this->request->email));
		}else{
			$user=User::where('email',$email)->first();
			if(isset($user->email) && $user->email!=''){
				$user->password=$this->request->password;
				$user->save();
				Session::flash('success', 'Psaaword saved successfully');

				return redirect(url('login'));
			}else{

				Session::flash('error', 'Email not sent please try again');

			  	return redirect(url('password/reset'));
			}

		}

	}

    /**@------------  Change User Password ------------*/
    public function change_password(){

        $user=User::find(Auth::user()->_id);
        
        return view('users/change_password')->with('user', $user);
    }

    /**@----------------- Save Password ------------*/
	public function save_password(){

		if($this->request->id==Auth::user()->_id){
			if($this->request->old_password){
				if (Hash::check($this->request->old_password, Auth::user()->password)) {
					if($this->request->new_password == $this->request->confirm_password){
						$profile= User::find($this->request->id);
						$profile->password=$this->request->new_password;
						$profile->save();
						Session::flash('success', 'Psaaword changes successfully');
					}else{
						Session::flash('error', 'new password and confirm password not matched');
					}
				}else{

				Session::flash('error', 'please enter old password');
				}
			}

			return redirect(url('user/change-password'));
		}

	}

    /**@----------------- Validation --------------*/
    private function validation($data){

	$status=1; //initiate status success
	$message='';
    if(!isset($data->name) || $data->name=='' ){
		$message .=" *Please enter  name";
		$status=-1; //error status
    }
    if(isset($data->name) && $data->_name!='' && !preg_match('/^[a-zA-Z ]*$/', $data->first_name)){
		$message .=" *Please enter valid name";
		$status=-1; //error status
    }
    if(!isset($data->email) || $data->email=='' ){
		$message .=" *Please enter user email";
		$status=-1; //error status
    }
    if(isset($data->email) && $data->email!='' && !preg_match('/^[+a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/i', $data->email)){
		$message .=" *Please enter valid user email";
		$status=-1; //error status
    }
    if(isset($data->password) && $data->password==''){
		$message .=" *Please enter Password";
		$status=-1; //error status
    }
	if(isset($data->password) && strlen( $data->password)<6){
		$message .=" *Password too small";
		$status=-1; //error status
	}
	if(isset($data->confirm_password) && $data->confirm_password!=$data->password){
		$message .=" *Confirm Password not matched";
		$status=-1; //error status
	}

        return ['status'=>$status, 'message'=>$message];
    } 

 
}
