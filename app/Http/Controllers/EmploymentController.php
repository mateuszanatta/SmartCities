<?php

namespace SmartCity\Http\Controllers;
/**
*  This class represents the domain Economy, performing queries in the database,
*  make averages and return the z-transform of each key field
*/
class EmploymentController extends Controller
{
    public function cityEmployment(){
      //It will apply the query into the database and return the data
        $var = "Emprego.Numero_de_Vinculos_Empregaticios.Total";
        $citiesEmployment= new CitiesController();
        $employment = $citiesEmployment->selectData(array(
                $var => true,
                'Municipio' => true,
                "_id" => false));
        $zTransform = new ZtransformController();
        $employmentAvg = array();
        for($i = 0; $i < sizeof($employment); $i++){
          //Select data of each city
          $employmentValues = $employment[$i]["Emprego"]["Numero_de_Vinculos_Empregaticios"]["Total"];
          //Make the average and save it in an array
          $employmentAvg = array_merge($employmentAvg, array(
                            $employment[$i]["Municipio"] => $zTransform->calculateAverage($employmentValues, sizeof($employment))));
        }
        //Calculate and return Z-values
        return $zTransform->zTransformation($employmentAvg);
    }

    public function citySalary(){
      //It will apply the query into the database and return the data
        $var = "Emprego.Numero_de_Vinculos_Empregaticios.Ativos.Rendimento_medio";
        $citiesSalary= new CitiesController();
        $salary = $citiesSalary->selectData(array(
                $var => true,
                'Municipio' => true,
                "_id" => false));
        $zTransform = new ZtransformController();
        $salaryAvg = array();
        for($i = 0; $i < sizeof($salary); $i++){
          //Select data of each city
          $salaryValues = $salary[$i]["Emprego"]["Numero_de_Vinculos_Empregaticios"]["Ativos"]["Rendimento_medio"];
          //Make the average and save it in an array
          $salaryAvg = array_merge($salaryAvg, array(
                            $salary[$i]["Municipio"] => $zTransform->calculateAverage($salaryValues, sizeof($salary))));
        }
        //Calculate and return Z-values
        return $zTransform->zTransformation($salaryAvg);
    }
}
