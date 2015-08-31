<?php

namespace App\Http\Controllers;

class InventoryController extends Controller{

    public function index()
    {
        $data =  "Empty";
        return view('inventory', ['name' => $data]);
    }
}
