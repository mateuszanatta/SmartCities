<?php
namespace SmartCity\Http\Controllers;
use SmartCity\Facebook;
use DB;
use Session;
/**
* This class will access the session that helds the facebook information after
* user log in and store it in the DB
*/
class FbController extends Controller{

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
