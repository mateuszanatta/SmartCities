<?php

namespace SmartCity;

use Jenssegers\Mongodb\Model as Eloquent;

class FacebookPagePosts extends Eloquent{
  protected $collection = "facebook_page_posts";
  protected $primaryKey  = "_id";
}
