<?php

namespace SmartCity\Jobs;

use SmartCity\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use SmartCity\FacebookPagePosts;
use DB;
/**
* This class implemente threads and perform a job running throughout an array
* to save the posts of the Cities' Facebook Pages
*/
class FacebookPagePostsJob extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;

    private $data;
    private $city;

    /**
     * Create a new job instance.
     * @param Array $data The post content
     * @return void
     */
    public function __construct($data, $city)
    {
        $this->data = $data;
        $this->city = $city;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      foreach ($this->data as $status) {
        //Iterate the array and sends the post data to be analyzed
        if($status !== null){
          foreach($status as $key => $value){
            //Verify if the array has the message, which contains the user writing
            if($key == "message"){
              // var_dump($value);
              FacebookPagePostsJob::save($value);
            }
          }
        }
      }

      DB::reconnect();//Make a fresh connection
    }

    private function save($message){
      $model = new FacebookPagePosts();

      $cityExist = FacebookPagePostsJob::cityExist($model, $this->city);

      if($cityExist > 0){
        FacebookPagePostsJob::addPost($message, $this->city);
      }else{
        $model->City = $this->city;
        $model->save();
        FacebookPagePostsJob::addPost($message, $this->city);
      }
    }

    private function addPost($message, $city){
      $model = new FacebookPagePosts();
      $updatePosts = $model->where("City", $city);

      $addPost     = $updatePosts->get()[0]->Posts;

      if(isset($addPost)){
        $addPost = array_merge($addPost, [$message]);
        $updatePosts->update(["Posts" => $addPost]);
      }else{
        $updatePosts->update(["Posts" => [$message]]);
      }
    }

    /**
    * This function will verify if the city is already stored in the database
    * @param FacebookTags $model It keeps the model information
    * @param String $city the city related to the tags
    * @return Int Return the number of time the city is found in the database
    */
    private function cityExist($model, $city){
      return $model->where("City", $city)->count();
    }
}
