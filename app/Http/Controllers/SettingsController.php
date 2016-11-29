<?php

namespace App\Http\Controllers;
use App\Model\Setting;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use View, Input, Session;
use Auth;
class SettingsController extends Controller
{
    
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /*-------------------- Save Data ------------------------*/
    public function index(){

        if($this->request->input('frm_type')=='social'){

        /*---------------------------- Facebook ---------------------------*/
          if($this->request->input('facebook_text')){
               $facebook_text=$this->request->input('facebook_text');
               if( $facebook_text)$this->set_data('facebook_text', $facebook_text);
          }
           if($this->request->input('facebook_url')){
               $facebook_url=$this->request->input('facebook_url');
               if( $facebook_url)$this->set_data('facebook_url', $facebook_url);
          }           
          if(Input::file('facebook_image')){
            $img=$this->get_data('facebook_image');
            if($img)@unlink(IMAGE_PATH.$img);
              $extension = Input::file('facebook_image')->getClientOriginalExtension();
               $fileName = rand(11111,99999).'.'.$extension;
               Input::file('facebook_image')->move(IMAGE_PATH, $fileName);
               $this->set_data('facebook_image', $fileName);
          }
          /*---------------------------- Twitter ---------------------------*/ 
          if($this->request->input('twitter_text')){
               $twitter_text=$this->request->input('twitter_text');
               if( $facebook_text)$this->set_data('twitter_text', $twitter_text);
          }
           if($this->request->input('twitter_url')){
               $twitter_url=$this->request->input('twitter_url');
               if($twitter_url)$this->set_data('twitter_url', $twitter_url);
          }   
                 
          if(Input::file('twitter_image')){
            $img=$this->get_data('twitter_image');
            if($img)@unlink(IMAGE_PATH.$img);
              $extension = Input::file('twitter_image')->getClientOriginalExtension();
               echo $twitter_img = rand(11111,99999).'.'.$extension;
               Input::file('twitter_image')->move(IMAGE_PATH, $twitter_img);
               $this->set_data('twitter_image', $twitter_img);

          }
         
          Session::flash('social_success', 'Deploy created successfully');
       }

       /*---------------------------- General Settings ----------------------------*/
       $data['footerText']=$this->get_data('footerText');
       if($this->request->input('frm_type')=='general'){

          if($this->request->input('footerText')){
               $footerText=$this->request->input('footerText');
               if( $footerText)$this->set_data('footerText', $footerText);
          } 
         /* if(Input::file('site_logo')){
            $img=$this->get_data('site_logo');
            if($img)@unlink(IMAGE_PATH.$img);
              $extension = Input::file('site_logo')->getClientOriginalExtension();
               $logo = 'logo.'.$extension;
               Input::file('site_logo')->move(IMAGE_PATH, $logo);
               $this->set_data('site_logo', $logo);
          }
          if($this->request->input('site_email')){
               $site_email=$this->request->input('site_email');
               if( $site_name)$this->set_data('site_email', $site_email);
          }
          if($this->request->input('system_email')){
               $system_email=$this->request->input('system_email');
               if( $site_name)$this->set_data('system_email', $system_email);
          }
          if($this->request->input('address')){
               $address=$this->request->input('address');
               if( $address)$this->set_data('address', $address);
          }*/

          Session::flash('general_success', 'Deploy created successfully');
       }
        
       
        $data['all_settings']=$this->get_data('all');
        return view('settings')->with($data);
    }

  /*-------------- Return specific data ----------------*/ 
    public static function get_data($field=NULL){
        if($field){
            if($field=='all'){
                $data = Setting::select('field','value')->get();
                $retuen_data=array();
                foreach ($data as $value) {
                    $retuen_data[$value->field]=$value->value;
                }
                return $retuen_data;
            }else{
                $data = Setting::where('field', $field)->select('value')->first();
                
                return ($data)?$data->value:'';
            }
            

        }else{
            return '';
        }
        
    }

   /*-------------- Set Global settings data ----------------*/
	function set_data($field=null, $value=null){
	  $data = Setting::select('value')->where('field', $field)->first();
	  if($data){
	      Setting::where('field', $field)->update(['value' => $value]);
	  }else{
	      Setting::insert(['field' => $field, 'value' => $value]);
	  }
	}

/*----------------------------  Generate Code ------------------------------------*/
	public function generate_code($length=6, $special_char=false){
	   $code = "";
	   $chars = array (
				  "1","2","3","4","5","6","7","8","9","0",
				  "a","A","b","B","c","C","d","D","e","E","f","F","g","G","h","H","i","I","j","J",
				  "k","K","l","L","m","M","n","N","o","O","p","P","q","Q","r","R","s","S","t","T",
				  "u","U","v","V","w","W","x","X","y","Y","z","Z"
				  );
	   if($special_char){

	   		array_push($chars,"!","@","#","$", "%", "^", "&", "*");
	   }

	   $count = count ($chars) - 1;
	   for ($i = 0; $i < $length; $i++)
		  $code .= $chars[rand (0, $count)];
	   return $code;
	}
}