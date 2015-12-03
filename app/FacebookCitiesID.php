<?php

namespace SmartCity;

use Jenssegers\Mongodb\Model as Eloquent;

class FacebookCitiesId extends Eloquent{
  protected $collection = "facebook_cities_id";
  protected $primaryKey  = "_id";
}
