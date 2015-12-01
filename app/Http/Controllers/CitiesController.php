<?php
namespace SmartCity\Http\Controllers;
use SmartCity\Cities;
use DB;
class CitiesController extends Controller{

  public function index()
  {
    return view('cities');
  }

  /**
  * Define which columns will be queried in the database
  * @param array $columns
  * @return result of the query executed in MongoDB
  */
  public function selectData($columns){
    $data = Cities::project($columns)->orderBy("Municipio","asc")->get();

    return $data;
  }
  public function category(){
    //It is going to receive a GET request with a array that defines what variableas are being requested
    //Ex.: localhost:8080/public/cities?vars[]=Domicilios_Particulares_Permanentes&vars[]=Por_Abastecimento_de_Agua&vars[]=Rede_Geral
    if(isset($_GET)){
      $columns = $_GET["selected"];

      $var = '';
      //Concatenate the variables from the GET request into a string to be used as a query on the database
      //Ex.:Domicilios_Particulares_Permanentes.Por_Abastecimento_de_Agua.Rede_Geral
      foreach ($columns as $key => $value) {
        $var = $var.$value.'.';
      }

      //It will apply the query into the database and return the data
      $data = CitiesController::selectData(array(
                      $var => true,
                      'Municipio' => true,
                      "_id" => false));
      $data2 = array();
      foreach($data as $key => $value){
        array_push($data2, array($value['Municipio'] => $value[$columns[0]]));
      }
      return $data2;
    }else{
      return "Nenhuma variável foi selecionada";
    }
  }
}
