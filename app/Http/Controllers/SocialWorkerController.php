<?php
namespace SmartCity\Http\Controllers;
use SmartCity\Facebook;
use SmartCity\FacebookTags;
use DateTime;

class SocialWorkerController extends Controller{
  private $facebookModel;

  public function index(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb){
    $this->facebookModel = new Facebook;
    // $tagModel = new FacebookTags;

    $userExist = SocialWorkerController::userExist();

    if($userExist > 0){

      $userAccessToken = SocialWorkerController::getUsersAccessToken();

      foreach($userAccessToken as $key => $value){
          $fb->setDefaultAccessToken($value["AccessToken"]);
          //Get yesterday's date
          $date = new DateTime("yesterday");
          //retrive yesterday's date in the format 9999-99-99
          $yesterdayDate = $date->Format("Y-m-d");
          $yesterdayDate = "2015-11-25";
          $requestUserPosts = $fb->request("GET", "/me?fields=posts.limit(100).since(" . $yesterdayDate . "){message}");

          $batch = ["user-posts" => $requestUserPosts];

          try{
            $responses = $fb->sendBatchRequest($batch);
          }catch(\Facebook\Exceptions\FacebookResponseException $e){
            // When Graph returns an error
           dd('Graph returned an error: ' . $e->getMessage());
            exit;
          } catch(Facebook\Exceptions\FacebookSDKException $e) {
            // When validation fails or other local issues
            dd('Facebook SDK returned an error: ' . $e->getMessage());
            exit;
          }

          $posts = $responses->getBody();
          $posts = json_decode($posts);

          $posts = $posts[0]->body;
          $posts = json_decode($posts);

          $data = $posts->posts->data;

          // $this->dispatch(new \SmartCity\Jobs\FacebookPost($data, $value["Current_city"]));
          $this->dispatch(new \SmartCity\Jobs\FacebookPost($data));
      }
    }
  }

  private function getUsersAccessToken(){
    $result = $this->facebookModel->project(array("AccessToken" => true, "Current_city" => true, "_id" => false))->get();
    return $result;
  }

  private function userExist(){
    $result = $this->facebookModel->project(array("User_id" => true, "Current_city" => true, "_id" => false))->get()->count();
    return $result;
  }
}
