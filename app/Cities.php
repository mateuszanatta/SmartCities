<?php

namespace SmartCity;

use Jenssegers\Mongodb\Model as Eloquent;

class Cities extends Eloquent
{
  protected $collection = "cities";
  protected $primaryKey  = "_id";
  public $timestamps = false;
}
