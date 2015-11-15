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
    private $facebook;
    //Get the user data from stored in a session
    private $user_info;

    public function index(){
      $this->facebook = new Facebook;
      //Get user information stored in the Session
      $this->user_info = Session::get('fb_user_info');

      $accessToken     = Session::get('fb_user_access_token');
      $userId          = $this->user_info['id'];
      $userName        = $this->user_info['name'];
      $userBirthday    = $this->user_info['birthday']->date;
      $userCurrentCity = $this->user_info['location']['name'];
      $userEmail       = $this->user_info['email'];

      //Verify if user is already in the database
      $userExist = FbController::userExist($userId);
      if($userExist == 0){
        FbController::saveUser($accessToken, $userId, $userName, $userBirthday,
                               $userCurrentCity, $userEmail);
      }else{
        FbController::updateUser($userId, $accessToken);
      }

      DB::reconnect();//Make a fresh connection
      //Redirect to the page with the social Info
      return redirect()->action('SocialController@index');
    }

    /**
    * Insert new user in the database
    *
    * @param string $accessToken It keeps the facebook long term access token
    * @param string $userId It keeps the facebook user id
    * @param string $userName It keeps the facebook user name
    * @param string $userBirthday It keeps the user birthday
    * @param string $userCurrentCity It keeps where the user is living
    * @param string $userEmail It keeps the user email
    */
    private function saveUser($accessToken, $userId, $userName, $userBirthday, $userCurrentCity, $userEmail){
      //Add info to the model
      $this->facebook->AccessToken  = $accessToken;
      $this->facebook->User_id      = $userId;
      $this->facebook->Name         = $userName;
      $this->facebook->Birthday     = $userBirthday;
      $this->facebook->Current_city = $userCurrentCity;
      $this->facebook->Email        = $userEmail;
      //Save
      $this->facebook->save();
    }

    /**
    * Update user data by their Facebook user ID
    * Every time when user make a new logging it will update their accessToken in the database
    *
    * @param string $userId the Facebook user id
    */
    private function updateUser($userId, $accessToken){
      $updateUser = $this->facebook->where('User_id', $userId);

      $updateUser->update(['AccessToken' => $accessToken]);
    }
    /**
    * This function will return the number of time a user is stored in the database
    * once user should be stored only once, it will return 1 when there is a register
    * and 0 when there is no register.
    * It will search for the Facebook user ID
    *
    * @param string $userId the Facebook user id
    */
    private function userExist($userId){
      return $this->facebook->where('User_id', $userId)->count();
    }

}
