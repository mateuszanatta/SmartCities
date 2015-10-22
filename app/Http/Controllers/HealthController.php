<?php
namespace SmartCity\Http\Controllers;
/**
* This class represents the key field Health, performin queries in the database,
* make averages and return the z-transform of each domain
*/
class HealthController extends Controller{
  /**
  *  Calculte the average and z-transform of number of people using water supplies not listed on the database
  *  @return Return the z-transform for of number of people using water supplies not listed on the database
  */
  public function waterSupplyOther(){
      //It will apply the query into the database and return the data
      $var = "Domicilios_Particulares_Permanentes.Por_Abastecimento_de_Agua.Outra_Forma.Total";
      $cityOther = new CitiesController();
      $otherSupply = $cityOther->selectData(array(
              $var => true,
              'Municipio' => true,
              "_id" => false));

      //Make other water supply's average and z-values
      $zTransform = new ZtransformController();
      $otherSupplyAvg = array();
      for($i = 0; $i < sizeof($otherSupply); $i++){
          //Select data of each city
          $otherSupplyValues = $otherSupply[$i]["Domicilios_Particulares_Permanentes"]["Por_Abastecimento_de_Agua"]["Outra_Forma"]["Total"];
          //Make the average and save it in an array
          $otherSupplyAvg = array_merge($otherSupplyAvg, array($otherSupply[$i]["Municipio"] => $zTransform->calculateAverage($otherSupplyValues,sizeof($otherSupply))));
      }
      //Calculate and return Z-values
      return $zTransform->zTransformation($otherSupplyAvg);
  }

  /**
  *  Calculte the average and z-transform of number of people drinking water from a well or spring
  *  @return Return the z-transform for of number of people using drinking water from a well or spring
  */
  public function wellSpring(){
      //It will apply the query into the database and return the data
      $var = "Domicilios_Particulares_Permanentes.Por_Abastecimento_de_Agua.Poco_ou_Nascente.Total";
      $cityWellSpring = new CitiesController();
      $wellSpring = $cityWellSpring->selectData(array(
              $var => true,
              'Municipio' => true,
              "_id" => false));

      //Make well or spring's average and z-values
      $zTransform = new ZtransformController();
      $wellSpringAvg = array();
      for($i = 0; $i < sizeof($wellSpring); $i++){
          //Select data of each city
          $wellSpringValues = $wellSpring[$i]["Domicilios_Particulares_Permanentes"]["Por_Abastecimento_de_Agua"]["Poco_ou_Nascente"]["Total"];
          //Make the average and save it in an array
          $wellSpringAvg = array_merge($wellSpringAvg, array($wellSpring[$i]["Municipio"] => $zTransform->calculateAverage($wellSpringValues,sizeof($wellSpring))));
      }
      //Calculate and return Z-values
      return $zTransform->zTransformation($wellSpringAvg);
  }

  /**
  *  Calculte the average and z-transform of number of people drinking water from a public water supply
  *  @return Return the z-transform for of number of people using drinking water from a public water supply
  */
  public function publicWaterSupply(){
      //It will apply the query into the database and return the data
      $var = "Domicilios_Particulares_Permanentes.Por_Abastecimento_de_Agua.Rede_Geral.Total";
      $cityPublicSupply = new CitiesController();
      $publicSupply = $cityPublicSupply->selectData(array(
              $var => true,
              'Municipio' => true,
              "_id" => false));

      //Make public water supply's average and z-values
      $zTransform = new ZtransformController();
      $publicSupplyAvg = array();
      for($i = 0; $i < sizeof($publicSupply); $i++){
          //Select data of each city
          $publicSupplyValues = $publicSupply[$i]["Domicilios_Particulares_Permanentes"]["Por_Abastecimento_de_Agua"]["Rede_Geral"]["Total"];
          //Make the average and save it in an array
          $publicSupplyAvg = array_merge($publicSupplyAvg, array($publicSupply[$i]["Municipio"] => $zTransform->calculateAverage($publicSupplyValues,sizeof($publicSupply))));
      }
      //Calculate and return Z-values
      return $zTransform->zTransformation($publicSupplyAvg);
  }
}
