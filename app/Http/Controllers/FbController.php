<?php
namespace SmartCity\Http\Controllers;
use SmartCity\Facebook;
// use SammyK\LaravelFacebookSdk;
// use Facebook\Exceptions;
//use base_path() . '\vendor\facebook\php-sdk-v4\src\Facebook\autoload.php';
use DB;
use Session;

class FbController extends Controller{
//   // if(isset($_POST)){
//     // $_POST['test'] = 'Received';
    public function index(){
      $facebook = new Facebook;
      $facebook->AccessToken = Session::get('fb_user_access_token');
      $user_info = Session::get('fb_user_info');
      $facebook->User_id = $user_info['id'];
      $facebook->Name = $user_info['name'];
      $facebook->save();
      //return "eu";//$_POST;
      return redirect()->action('SocialController@index');
    }


}
