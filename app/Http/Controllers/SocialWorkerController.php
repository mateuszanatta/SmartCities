<?php
namespace SmartCity\Http\Controllers;
use SmartCity\Facebook;
use SmartCity\FacebookTags;
use DateTime;

/**
* This class will retrieve the Facebook user Access Token stored in the database
* and use it to connect to Facebook and get the user posts on Facebook
*/
class SocialWorkerController extends Controller{
  private $facebookModel;

  public function index(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb){
    $this->facebookModel = new Facebook;

    //Verify if there is user on database
    $userExist = SocialWorkerController::userExist();

    if($userExist > 0){
      //get all the users access tokens from the database
      $userAccessToken = SocialWorkerController::getUsersAccessToken();

      // It will run the array if the access tokens, set them in the SDK, get the posts from Facebook
      // and send it to class which will extract the hashtags
      foreach($userAccessToken as $key => $value){
        // Set the user access token into the FAcebook SDK to perform searchs on Facebook Graph
          $fb->setDefaultAccessToken($value["AccessToken"]);
          //Get yesterday's date
          $date = new DateTime("yesterday");
          //retrive yesterday's date in the format 9999-99-99
          $yesterdayDate = $date->Format("Y-m-d");
          // $yesterdayDate = "2015-11-28";

          //Try to make a request to Facebook Graph
          try{
            //Make a request retrieving yesterday's posts message with a limit of 100 posts per page
            $requestUserPosts = $fb->get("me/posts?fields=message&since=" . $yesterdayDate . "&limit=100");
            //$responses = $fb->sendBatchRequest($batch);
          }catch(\Facebook\Exceptions\FacebookResponseException $e){
            // When Graph returns an error
           dd('Graph returned an error: ' . $e->getMessage());
            exit;
          } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            dd('Facebook SDK returned an error: ' . $e->getMessage());
            exit;
          }

          //Try to get posts from first to last page
          // Get Page 1
          $feedEdge = $requestUserPosts->getGraphEdge();
          $this->dispatch(new \SmartCity\Jobs\FacebookPost($feedEdge));

          // Get Next pages
          $nextFeed = $fb->next($feedEdge);
          //While there is more pages keep creating new jobs to process the message
          while($nextFeed !== null){
            $this->dispatch(new \SmartCity\Jobs\FacebookPost($nextFeed));
            $nextFeed = $fb->next($feedEdge);
          }
      }
    }
  }

  /**
  * Retrieve the Facebook access token from the database
  *
  * @return Array with the user access token stored in the database
  */
  private function getUsersAccessToken(){
    $result = $this->facebookModel->project(array("AccessToken" => true, "Current_city" => true, "_id" => false))->get();
    return $result;
  }
  /**
  * Verify if there is any user registered in the database
  *
  * @return Int The number of user registered
  */
  private function userExist(){
    $result = $this->facebookModel->project(array("User_id" => true, "Current_city" => true, "_id" => false))->get()->count();
    return $result;
  }
}
