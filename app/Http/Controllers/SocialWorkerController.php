<?php
namespace SmartCity\Http\Controllers;
use SmartCity\Facebook;
use DB;

class SocialWorkerController extends Controller{
  private $facebookModel;
  private $tagModel;
  public function index(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb){
    $this->facebookModel = new Facebook;
    $this->tagModel = new FacebookTags;

    $userExist = SocialWorkerController::userExist();

    if($userExist > 0){

      $userAccessToken = SocialWorkerController::getUsersAccessToken();

      foreach($userAccessToken as $key => $value){
          $fb->setDefaultAccessToken($value["AccessToken"]);
          $requestUserPosts = $fb->request("GET", "/me?fields=posts.limit(100).since(2015-11-12){created_time,message}");

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

          $this->dispatch(new \SmartCity\Commands\FacebookPosts($data, $value["Current_city"]));
      }
      DB::reconnect();//Make a fresh connection
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

  private function incrementTags($tagName, $count){
    $collectionExist = SocialWorkerController::collectionExist();

    if($collectionExist){
      $cityExist = SocialWorkerController::cityExist();
      $tagExist = SocialWorkerController::tagsExist($tagName);

      if($cityExist > 0){
        if($tagExist > 0){
          SocialWorkerController::updateTag($tagName, $count);
        }
      }else{
        SocialWorkerController::saveTag($tagName, $count);
      }
    }else{
      print_r('Saving tag');
      SocialWorkerController::saveTag($tagName, $count);
    }
  }

  private function saveTag($tagName, $count){
    $this->tagModel->TagName            = $tagName;
    $this->tagModel->City               = $this->city;
    $this->tagModel->NumberOfOccurences = $count;

    $this->tagModel->save();
  }

  private function updateTag($tagName, $count){
    $test = $this->tagModel->find($this->city)->where("TagName", $tagName);
    print_r($test);
  }

  private function cityExist(){
    return $this->tagModel->find($this->city);
  }

  private function collectionExist(){
    return $this->tagModel;
  }

  private function tagsExist($tagName){
    return $this->tagModel->where("TagName", $tagName)->count();
  }
}
