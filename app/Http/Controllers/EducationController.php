<?php
namespace SmartCity\Http\Controllers;
/**
* This class represents the key field Education, performin queries in the database,
* make averages and return the z-transform of each domain
*/
class EducationController extends Controller{
  ///////////////////////////////////////////////////////
  //////////////////Preschool section///////////////////
  /////////////////////////////////////////////////////

  /**
  *  Calculte the average and z-transform of number of children enrolled in preschool
  *  @return Return the z-transform for of number of children enrolled in preschool
  */
  public function preSchoolEnrollments(){
      //It will apply the query into the database and return the data
      $var = "Educacao.Educacao_Infantil.Matricula_Inicial.Total";
      $cityEnrollments = new CitiesController();
      $preSchoolEnrollments = $cityEnrollments->selectData(array(
              $var => true,
              'Municipio' => true,
              "_id" => false));

      //Make other preschool enrllments' average and z-values
      $zTransform = new ZtransformController();
      $preSchoolEnrollmentsAvg = array();
      for($i = 0; $i < sizeof($preSchoolEnrollments); $i++){
          //Select data of each city
          $preSchoolEnrollmentsValues = $preSchoolEnrollments[$i]["Educacao"]["Educacao_Infantil"]["Matricula_Inicial"]["Total"];
          //Make the average and save it in an array
          $preSchoolEnrollmentsAvg = array_merge($preSchoolEnrollmentsAvg, array($preSchoolEnrollments[$i]["Municipio"] => $zTransform->calculateAverage($preSchoolEnrollmentsValues,sizeof($preSchoolEnrollments))));
      }
      //Calculate and return Z-values
      return $zTransform->zTransformation($preSchoolEnrollmentsAvg);
  }

  ///////////////////////////////////////////////////////
  ////////Elementary school, Middle school and High School///////////
  /////////////////////////////////////////////////////

  /**
  *  Calculte the average and z-transform pass rate in Elementary and Middle school or High School
  *  Pass rate is the rate of students who passed in a given year X
  *  @param string $schoolGrade the year to be searched: "Ensino_Fundamental" or "Ensino_medio"
  *  @return Return the z-transform for pass rate in Elementary and Middle school or High School
  */
  public function schoolPassRate($schoolGrade){
      //It will apply the query into the database and return the data
      $var = "Educacao.".$schoolGrade.".Taxa_de_Aprovacao.Total";
      $cityPassRate = new CitiesController();
      $passRate = $cityPassRate->selectData(array(
              $var => true,
              'Municipio' => true,
              "_id" => false));

      //Make other preschool enrllments' average and z-values
      $zTransform = new ZtransformController();
      $passRateAvg = array();
      for($i = 0; $i < sizeof($passRate); $i++){
          //Select data of each city
          $passRateValues = $passRate[$i]["Educacao"][$schoolGrade]["Taxa_de_Aprovacao"]["Total"];
          //Make the average and save it in an array
          $passRateAvg = array_merge($passRateAvg, array($passRate[$i]["Municipio"] => $zTransform->calculateAverage($passRateValues,sizeof($passRate))));
      }
      //Calculate and return Z-values
      return $zTransform->zTransformation($passRateAvg);
  }
  /**
  *  Calculte the average and z-transform of failure rate in Elementary and Middle school or High School
  *  @return Return the z-transform for of failure rate in Elementary and Middle school or High School
  */
  public function schoolFailureRate($schoolGrade){
      //It will apply the query into the database and return the data
      $var = "Educacao.".$schoolGrade.".Taxa_de_Reprovacao.Total";
      $cityFailureRate = new CitiesController();
      $failureRate = $cityFailureRate->selectData(array(
              $var => true,
              'Municipio' => true,
              "_id" => false));

      //Make other preschool enrllments' average and z-values
      $zTransform = new ZtransformController();
      $failureRateAvg = array();
      for($i = 0; $i < sizeof($failureRate); $i++){
          //Select data of each city
          $failureRateValues = $failureRate[$i]["Educacao"][$schoolGrade]["Taxa_de_Reprovacao"]["Total"];
          //Make the average and save it in an array
          $failureRateAvg = array_merge($failureRateAvg, array($failureRate[$i]["Municipio"] => $zTransform->calculateAverage($failureRateValues,sizeof($failureRate))));
      }
      //Calculate and return Z-values
      return $zTransform->zTransformation($failureRateAvg);
  }

  /**
  *  Calculte the average and z-transform of distortion rate age-class in Elementary and Middle school or High School
  *  This rate measure how many students are attending to grade that are not recommended to their age.
  *  @return Return the z-transform for of failure rate in Elementary and Middle school or High School
  */
  public function schoolDistortionRate($schoolGrade){
      //It will apply the query into the database and return the data
      $var = "Educacao.".$schoolGrade.".Taxa_de_Distorcao_Idade_Serie.Total";
      $cityDistortionRates = new CitiesController();
      $distorionRate = $cityDistortionRates->selectData(array(
              $var => true,
              'Municipio' => true,
              "_id" => false));

      //Make other preschool enrllments' average and z-values
      $zTransform = new ZtransformController();
      $distorionRateAvg = array();
      for($i = 0; $i < sizeof($distorionRate); $i++){
          //Select data of each city
          $distorionRateValues = $distorionRate[$i]["Educacao"][$schoolGrade]["Taxa_de_Distorcao_Idade_Serie"]["Total"];
          //Make the average and save it in an array
          $distorionRateAvg = array_merge($distorionRateAvg, array($distorionRate[$i]["Municipio"] => $zTransform->calculateAverage($distorionRateValues,sizeof($distorionRate))));
      }
      //Calculate and return Z-values
      return $zTransform->zTransformation($distorionRateAvg);
  }

  /**
  *  Calculte the average and z-transform of dropout rate in Elementary and Middle school or High School
  *  @return Return the z-transform for of failure rate in Elementary and Middle school or High School
  */
  public function schoolDropOutRate($schoolGrade){
      //It will apply the query into the database and return the data
      $var = "Educacao.".$schoolGrade.".Taxa_de_Abandono.Total";
      $cityDropoutRates = new CitiesController();
      $dropoutRate = $cityDropoutRates->selectData(array(
              $var => true,
              'Municipio' => true,
              "_id" => false));

      //Make other preschool enrllments' average and z-values
      $zTransform = new ZtransformController();
      $dropoutRateAvg = array();
      for($i = 0; $i < sizeof($dropoutRate); $i++){
          //Select data of each city
          $dropoutRateValues = $dropoutRate[$i]["Educacao"][$schoolGrade]["Taxa_de_Abandono"]["Total"];
          //Make the average and save it in an array
          $dropoutRateAvg = array_merge($dropoutRateAvg, array($dropoutRate[$i]["Municipio"] => $zTransform->calculateAverage($dropoutRateValues,sizeof($dropoutRate))));
      }
      //Calculate and return Z-values
      return $zTransform->zTransformation($dropoutRateAvg);
  }

  /**
  *  Calculte the average and z-transform of dropout rate in Elementary and Middle school or High School.
  *  Number of students who graduated at elementary school in a given year X
  *  @return Return the z-transform for of failure rate in Elementary and Middle school or High School
  */
  public function schoolNumberGraduates($schoolGrade){
      //It will apply the query into the database and return the data
      $var = "Educacao.".$schoolGrade.".Numero_de_Concluintes.Total";
      $cityNumberGraduates = new CitiesController();
      $numberGraduates = $cityNumberGraduates->selectData(array(
              $var => true,
              'Municipio' => true,
              "_id" => false));

      //Make other preschool enrllments' average and z-values
      $zTransform = new ZtransformController();
      $numberGraduatesAvg = array();
      for($i = 0; $i < sizeof($numberGraduates); $i++){
          //Select data of each city
          $numberGraduatesValues = $numberGraduates[$i]["Educacao"][$schoolGrade]["Numero_de_Concluintes"]["Total"];
          //Make the average and save it in an array
          $numberGraduatesAvg = array_merge($numberGraduatesAvg, array($numberGraduates[$i]["Municipio"] => $zTransform->calculateAverage($numberGraduatesValues,sizeof($numberGraduates))));
      }
      //Calculate and return Z-values
      return $zTransform->zTransformation($numberGraduatesAvg);
  }
}
