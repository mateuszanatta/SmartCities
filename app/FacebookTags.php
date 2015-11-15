<?php

namespace SmartCity;

use Jenssegers\Mongodb\Model as Eloquent;

class FacebookTags extends Eloquent{
  protected $collection = "facebook_tags";
  protected $primaryKey  = "_id";
}
