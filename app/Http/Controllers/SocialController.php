<?php
namespace SmartCity\Http\Controllers;
use Route;
class SocialController extends Controller{
    private $login_url;
    function index(){

        return view('social', ['section' => 'geral']);
    }
    function cidades(){
      return view('social', ['section'=>'cidades']);
    }
}
