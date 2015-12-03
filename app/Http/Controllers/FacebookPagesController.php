<?php

namespace SmartCity\Http\Controllers;
use SmartCity\FacebookCitiesId;
use DateTime;
class FacebookPagesController extends Controller
{
  function index(\SammyK\LaravelFacebookSdk\LaravelFacebookSdk $fb){
    $fb->setDefaultAccessToken(getenv("FACEBOOK_APP_ACCESSTOKEN"));

    $cities = FacebookPagesController::getCities();

    foreach($cities as $key => $values){
      try{
        //Get last saturday date
        $since = new DateTime("Saturday last week");
        // Requires the "read_stream" permission
        $requestPagePosts = $fb->get($values["FacebookId"] . "/posts?fields=message&limit=100&created_time&since=" . $since->Format("Y-m-d"));//2015-11-30");
      }catch(\Facebook\Exceptions\FacebookResponseException $e){
        // When Graph returns an error
       dd('Graph returned an error: ' . $e->getMessage());
        exit;
      } catch(\Facebook\Exceptions\FacebookSDKException $e) {
        // When validation fails or other local issues
        dd('Facebook SDK returned an error: ' . $e->getMessage());
        exit;
      }

      //Try to get posts from first to last page
      // Get Page 1
      $feedEdge = $requestPagePosts->getGraphEdge();
      foreach ($feedEdge as $status) {
        $this->dispatch(new \SmartCity\Jobs\FacebookPagePostsJob($feedEdge, $values["City"]));
      }

      // Get Next pages
      $nextFeed = $fb->next($feedEdge);
      while($nextFeed !== null){
        foreach ($nextFeed as $status) {
          $this->dispatch(new \SmartCity\Jobs\FacebookPagePostsJob($nextFeed, $values["City"]));
        }
        $nextFeed = $fb->next($feedEdge);
      }
    }

  }
  /**
  * Retrieve the Facebook cities' name and their Facebook ID
  *
  * @return Array with the cities' name and their Facebook ID
  */
  private function getCities(){
    $model = new FacebookCitiesId();
    $result = $model->project(array("City" => true, "FacebookId" => true, "_id" => false))->get();
    return $result;
  }
}
