<?php

namespace SmartCity;

use Jenssegers\Mongodb\Model as Eloquent;

class Inventory extends Eloquent
{
    protected $collection = "zips";
    protected $primaryKey  = "_id";
    public $timestamps = false;
}
