<?php
namespace SmartCity\Http\Controllers;
//use Route;
//require_once('../../vendor/autoload.php');
use \Auto\Autoloader;
use \Auto\Task;

class SocialController extends Controller{
    private $login_url;
    function index(){
        return view('social', ['section' => 'geral']);
    }
    function cidades(){
      return view('social', ['section'=>'cidades']);
    }
}
