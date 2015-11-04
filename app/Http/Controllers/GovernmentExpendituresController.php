<?php
namespace SmartCity\Http\Controllers;
/**
* This class represents the key field Government Expenditures, performin queries in the database,
* make averages and return the z-transform of each domain
*/
class GovernmentExpendituresController extends Controller{

  /**
  *  Calculte the average and z-transform of municipal taxes collected
  *  @return Return the z-transform for of municipal taxes collected
  */
  public function municipalTaxes(){
      //It will apply the query into the database and return the data
      $var = "Financas_Publicas.Tributos_Municipais.Total";
      $municipalTaxes = new CitiesController();
      $taxes = $municipalTaxes->selectData(array(
              $var => true,
              'Municipio' => true,
              "_id" => false));

      //Make other federal taxes' average and z-values
      $zTransform = new ZtransformController();
      $taxesAvg = array();
      for($i = 0; $i < sizeof($taxes); $i++){
          //Select data of each city
          $taxesValues = $taxes[$i]["Financas_Publicas"]["Tributos_Municipais"]["Total"];
          //Make the average and save it in an array
          $taxesAvg = array_merge($taxesAvg, array($taxes[$i]["Municipio"] => $zTransform->calculateAverage($taxesValues,sizeof($taxes))));
      }
      //Calculate and return Z-values
      return $zTransform->zTransformation($taxesAvg);
  }

  /**
  *  Calculte the average and z-transform of federal taxes collected
  *  @return Return the z-transform for of federal taxes collected
  */
  public function federalTaxes(){
      //It will apply the query into the database and return the data
      $var = "Financas_Publicas.Tributos_Federais.Total_das_Receitas";
      $federalTaxes = new CitiesController();
      $taxes = $federalTaxes->selectData(array(
              $var => true,
              'Municipio' => true,
              "_id" => false));

      //Make other federal taxes' average and z-values
      $zTransform = new ZtransformController();
      $taxesAvg = array();
      for($i = 0; $i < sizeof($taxes); $i++){
          //Select data of each city
          $taxesValues = $taxes[$i]["Financas_Publicas"]["Tributos_Federais"]["Total_das_Receitas"];
          //Make the average and save it in an array
          $taxesAvg = array_merge($taxesAvg, array($taxes[$i]["Municipio"] => $zTransform->calculateAverage($taxesValues,sizeof($taxes))));
      }
      //Calculate and return Z-values
      return $zTransform->zTransformation($taxesAvg);
  }

  /**
  *  Calculte the average and z-transform of state taxes collected
  *  @return Return the z-transform for of state taxes collected
  */
  public function stateTaxes(){
      //It will apply the query into the database and return the data
      $var = "Financas_Publicas.Tributos_Estaduais.Arrecadacao_Total";
      $stateTaxes = new CitiesController();
      $taxes = $stateTaxes->selectData(array(
              $var => true,
              'Municipio' => true,
              "_id" => false));

      //Make other state taxes' average and z-values
      $zTransform = new ZtransformController();
      $taxesAvg = array();
      for($i = 0; $i < sizeof($taxes); $i++){
          //Select data of each city
          $taxesValues = $taxes[$i]["Financas_Publicas"]["Tributos_Estaduais"]["Arrecadacao_Total"];
          //Make the average and save it in an array
          $taxesAvg = array_merge($taxesAvg, array($taxes[$i]["Municipio"] => $zTransform->calculateAverage($taxesValues,sizeof($taxes))));
      }
      //Calculate and return Z-values
      return $zTransform->zTransformation($taxesAvg);
  }

  /**
  *  Calculte the average and z-transform of the city Government expending
  *  @return Return the z-transform for of Government expending
  */
  public function governmentExpending(){
      //It will apply the query into the database and return the data
      $var = "Financas_Publicas.Despesas_Realizadas.Total";
      $governmentExpending = new CitiesController();
      $expending = $governmentExpending->selectData(array(
              $var => true,
              'Municipio' => true,
              "_id" => false));

      //Make other state expending' average and z-values
      $zTransform = new ZtransformController();
      $expendingAvg = array();
      for($i = 0; $i < sizeof($expending); $i++){
          //Select data of each city
          $expendingValues = $expending[$i]["Financas_Publicas"]["Despesas_Realizadas"]["Total"];
          //Make the average and save it in an array
          $expendingAvg = array_merge($expendingAvg, array($expending[$i]["Municipio"] => $zTransform->calculateAverage($expendingValues,sizeof($expending))));
      }
      //Calculate and return Z-values
      return $zTransform->zTransformation($expendingAvg);
  }

}
