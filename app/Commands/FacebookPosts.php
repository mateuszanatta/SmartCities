<?php

namespace SmartCity\Commands;

use SmartCity\Commands\Command;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use SmartCity\FacebookTags;

class FacebookPosts implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    private $data;
    private $city;
    private $tagModel;
    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct($data, $city)
    {
      $this->data     = $data;
      $this->city     = $city;
    }

    /**
     * Execute the command.
     *
     * @return void
     */
    public function handle()
    {
        // print_r($this->data);
        //print_r('<br />' . $this->city);
        //FacebookPosts::incrementTags("Buracos", 1);
        //$this->release();
    }
    
}
