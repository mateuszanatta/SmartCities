<?php
namespace SmartCity\Http\Controllers;
use SmartCity\Cities;
use DB;
class CitiesController extends Controller{

  public function index()
  {
    // $data = Cities::where("Municipio", "Alpestre")->take(1)->get();
    // $data = Cities::all();

    if(isset($_GET)){
      $columns = $_GET["vars"];

      $var = '';
      foreach ($columns as $key => $value) {
        $var = $var.$value.'.';
      }

      $data = CitiesController::selectData(array(
                      $var => true,
                      'Municipio' => true,
                      "_id" => false));
      return $data;
    }else{
      return "Nenhuma variável foi selecionada";
    }
  }

  /**
  Define which columns will be queried in the database
  @param array $columns
  @return result of the query executed in MongoDB
  */
  public function selectData($columns){
    $data = Cities::project($columns)->orderBy("Municipio","asc")->get();

    return $data;
  }
}
