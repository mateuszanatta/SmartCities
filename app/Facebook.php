<?php

namespace SmartCity;

use Jenssegers\Mongodb\Model as Eloquent;

class Facebook extends Eloquent{
  protected $collection = "facebook";
  protected $primaryKey  = "_id";
}
