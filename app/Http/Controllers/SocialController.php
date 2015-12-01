<?php
namespace SmartCity\Http\Controllers;
use \Auto\Autoloader;
use \Auto\Task;
use SmartCity\FacebookTags;
use SmartCity\Facebook;
use DateTime;
use DB;

class SocialController extends Controller{
    private $login_url;
    function index(){
        return view('social', ['section' => 'geral']);
    }
    function cidades(){
      return view('social', ['section'=>'cidades']);
    }
    /**
    * Retrieve all the cities with stored tags in the database
    * @return Array with cities and their tags
    */
    function selectAllTags(){
      $tags     = FacebookTags::all();//Retrieve all data relative to tags
      $cityTags = array();

      $decodedTags = json_decode($tags);

      foreach($decodedTags as $key => $value){
        $cityTags[$value->City] = $value->Tags;
      }

      return $cityTags;
    }
    /**
    * Sort the tags and return the top ten tags only
    * @return Array with the top ten tags
    */
    function allTagsTopTen(){
      $sumTags = SocialController::sumAllTags();

      //sort the values from high to low
      arsort($sumTags);
      //return the top 10 tags
      return array_slice($sumTags, 0, 10);
    }

    /**
    * Retrieve all the tags from the BD and count the number of occurrences of each tag
    * @return Array with the tags and the number of times they were mentioned
    */
    function sumAllTags(){
      $data    = FacebookTags::all();//Retrieve all data relative to tags
      $sumTags = array();

      $tags = json_decode($data);

      foreach($tags as $key => $value){
        $tags = $value->Tags;
        foreach($tags as $id => $tagValue){
          if(isset($sumTags[$id])){
            $sumTags[$id] += $tagValue;
          }else{
            $sumTags[$id] = $tagValue;
          }
        }
      }
      return $sumTags;
    }
    /**
    * It will retrieve all the user, calculate their age, and include them in a age range
    * @return Array with the age's range and its values
    */
    function userAgeRange(){
      $user      = Facebook::all();
      $ageRange  = array();
      $todayDate = new DateTime("today");
      $birthday  = "";

      $userInfo = json_decode($user);

      foreach($userInfo as $key => $value){
        $birthday = $value->Birthday;
        //Calculate the difference between today date and the birthday date to have the user age
        $userAge = date_diff(date_create($birthday), date_create($todayDate->format("Y-m-d H:i:s.mmm")), false);

        //Verify in wich range the user is included and increment one in the age range
        if($userAge->y <= 15){
          if(isset($ageRange["0-15"])){
            $ageRange["0-15"] += 1;
          }else{
            $ageRange["0-15"] = 1;
          }
        }else if($userAge->y >= 16 && $userAge->y <= 21){
          if(isset($ageRange["0-15"])){
            $ageRange["16-21"] += 1;
          }else{
            $ageRange["16-21"] = 1;
          }
        }else if($userAge->y >= 22 && $userAge->y <= 37){
          if(isset($ageRange["0-15"])){
            $ageRange["22-37"] += 1;
          }else{
            $ageRange["22-37"] = 1;
          }
        }else if($userAge->y >= 38 && $userAge->y <= 53){
          if(isset($ageRange["0-15"])){
            $ageRange["38-53"] += 1;
          }else{
            $ageRange["38-53"] = 1;
          }
        }else if($userAge->y >= 54 && $userAge->y <= 69){
          if(isset($ageRange["0-15"])){
            $ageRange["54-69"] += 1;
          }else{
            $ageRange["54-69"] = 1;
          }
        }else if($userAge->y >= 70 && $userAge->y <= 85){
          if(isset($ageRange["0-15"])){
            $ageRange["70-85"] += 1;
          }else{
            $ageRange["70-85"] = 1;
          }
        }else if($userAge->y >= 86){
          if(isset($ageRange["0-15"])){
            $ageRange["86 ou mais"] += 1;
          }else{
            $ageRange["86 ou mais"] = 1;
          }
        }
      }
      return $ageRange;
    }
    /**
    * It will calculate the number of people registered by city
    * @return Array with the amount of people per city
    **/
    function peopleFrom(){
      $user       = Facebook::all();
      $userCities = array();

      $userInfo = json_decode($user);
      foreach($userInfo as $key => $value){
        if(isset($userCities[$value->Current_city])){
          $userCities[$value->Current_city] += 1;
        }else{
          $userCities[$value->Current_city] = 1;
        }
      }

      return $userCities;
    }
}
