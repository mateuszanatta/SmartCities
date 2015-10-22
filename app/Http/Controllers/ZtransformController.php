<?php

namespace SmartCity\Http\Controllers;
/**
  This class has methods to calculate average, standard deviation and z-transformation
*/
class ZtransformController extends Controller
{
  /**
    Calculate the average
    @param array $munInfo
    @param int $numOfElements
    @return Return a double with the Standard Deviation
  */
  public function calculateAverage($munInfo, $numOfElements){
    $sumValues = 0;
    foreach ($munInfo as $key => $value) {
        if($value == "-"){
          $value = 0;
        }
        //remove the comma and add dot to separate decimal
        $value = str_replace(",", ".", $value);

        $sumValues += $value;
      }
      return $sumValues/$numOfElements;
  }
  /**
    Make the Standar Deviation of averages of the cities
    @param array $munAverages
    @param double $avg
    @return Return a double with the Standard Deviation
  */
  private function standarDeviation($munAverages, $avg){
      //Calculate the Variance of the cities' averages
      $sumVariance = 0;
      $std = 0;
      foreach($munAverages as $key => $value){
          $sumVariance += pow(($value - $avg), 2);
      }

      //Calculate the Standard Deviation(Std) of the cities' averages
      $std = sqrt(($sumVariance / sizeof($munAverages)));
      return $std;
  }

  /**
    Make the z-transform of averages of the cities
    @param array $munAverages
    @return Return a array with the z value of each city
  */
  public function zTransformation($munAverages){
      //make average of given cities' averages
      $sumAvg = 0;
      $avg = 0;
      foreach($munAverages as $key => $value){
          $sumAvg += $value;
      }
      $avg = $sumAvg / sizeof($munAverages);

      //Calculate Standard Deviation
      $std = ZtransformController::standarDeviation($munAverages, $avg);

      //Apply the z-transform and save the results in an array
      $zValues = array(); //keep the z-transform results
      $zTransform = 0;
      foreach($munAverages as $key => $value){
          $zTransform = ($value - $avg) / $std;
          $zValues = array_merge($zValues, array($key => $zTransform));
      }
      return $zValues;
  }
}
