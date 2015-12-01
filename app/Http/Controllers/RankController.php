<?php
namespace SmartCity\Http\Controllers;
use SmartCity\Cities;

class RankController extends Controller{
  private $average = null; //It will be used to instatiate a object of the class ZtransformController
                          //to call the average function

  public function index()
  {
      return view("rank");
  }

  public function showRank(){
    $educationRank       = RankController::sortZvalues(RankController::educationKeyField());
    $governmentExpenRank = RankController::sortZvalues(RankController::governmentExpendituresKeyField());
    $healthRank          = RankController::sortZvalues(RankController::healthKeyField());
    $economyRank         = RankController::sortZvalues(RankController::economyKeyField());
    $employmentRank      = RankController::sortZvalues(RankController::employmentKeyField());
    $environmentRank     = RankController::sortZvalues(RankController::environmentKeyField());

    //Store the overal rating of each city
    $overallRating       = RankController::overallRating(array('education' => $educationRank,
                                                  'governmentExpen' => $governmentExpenRank,
                                                  'health' => $healthRank, 'economy' => $economyRank,
                                                  'employment' => $employmentRank, 'environment' => $environmentRank));

    return array('education' => $educationRank, 'governmentExpen' => $governmentExpenRank,
            'health' => $healthRank, 'economy' => $economyRank,
            'employment' => $employmentRank, 'environment' => $environmentRank,
            'overall' => $overallRating);
  }
  /**
  * This function is intended to be used with array_map and will multiply the z-value by -1 to invert the rank order
  * @param double the z-value
  * @return return the z-value after multiply it by -1
  */
  public function addImpact($value){
    return $value * -1;
  }
  /**
  * This function is intended to be used with array_map.
  * It will sum the components' z-values of each city
  * @param it will receive n number of arrays with the z-values
  * @return return the sum of z-value of each city
  */
  function sumCityValues(){
    return array_sum(func_get_args());
  }
  /**
  * This function is intended to be used with array_map.
  * It will divide the sum of the components of each city to obtain the average for the key field
  * @param $val it will receive n number of arrays with the z-values
  * @param $size it will receive the number of times the array was summed
  * @return return z-value average for each key field
  */
  function divideKeyFields($val, $size){
    return $val/$size;
  }
  /**
  * It will calculate the average of the z-values for Education
  * @return return the average of z-values by key field of each city
  */
  public function educationKeyField(){
      $education = new EducationController();
      //Get the z-values for high school
      $highSchoolFailure = $education->schoolFailureRate("Ensino_Medio");//High School z-value for failure
      $highSchoolFailureInverted = array_map(array($this, "addImpact"), $highSchoolFailure);
      $highSchoolDistortion = $education->schoolDistortionRate("Ensino_Medio");//High School z-value for distortion rate
      $highSchoolDistortionInverted = array_map(array($this, "addImpact"), $highSchoolDistortion);
      $highSchoolPass = $education->schoolPassRate("Ensino_Medio");//High School z-value for distortion rate
      $highSchoolDrop = $education->schoolDropOutRate("Ensino_Medio");//High School z-value for dropout
      $highSchoolDropInverted = array_map(array($this, "addImpact"), $highSchoolDrop);
      $highSchoolGraduates = $education->schoolNumberGraduates("Ensino_Medio");//High School z-value for number of graduates

      //Get the z-values for elementary and middle school
      $elemFailure = $education->schoolFailureRate("Ensino_Fundamental");//High School z-value for failure
      $elemFailureInverted = array_map(array($this, "addImpact"), $elemFailure);
      $elemDistortion = $education->schoolDistortionRate("Ensino_Fundamental");//High School z-value for distortion rate
      $elemDistortionInverted = array_map(array($this, "addImpact"), $elemDistortion);
      $elemPass = $education->schoolPassRate("Ensino_Fundamental");//High School z-value for distortion rate
      $elemDrop = $education->schoolDropOutRate("Ensino_Fundamental");//High School z-value for dropout
      $elemDropInverted = array_map(array($this, "addImpact"), $elemDrop);
      $elemGraduates = $education->schoolNumberGraduates("Ensino_Fundamental");//High School z-value for number of graduates

      //Get th z-values for preschool
      $preSchool = $education->preSchoolEnrollments();
      //sum z-values
      $sumZvalues = array_map(array($this, "sumCityValues"), $highSchoolFailureInverted,
            $highSchoolDistortionInverted, $highSchoolPass, $highSchoolDropInverted,
            $highSchoolGraduates, $elemFailureInverted, $elemDistortionInverted,
            $elemPass, $elemDropInverted, $elemGraduates, $preSchool);

      //Divide the sum of z-values to obtain the z-values average of each city
      $zValuesAvg = array_map(array($this, "divideKeyFields"), $sumZvalues, array_fill(0, count($sumZvalues), 11));
      //combine the array keys(cities'name) with the average of z-values gotten
      $zValuesAvg = array_combine(array_keys($preSchool), array_values($zValuesAvg));

      return $zValuesAvg;
  }

  /**
  * It will calculate the average of the z-values for Government Expenditures
  * @return return the average of z-values by key field of each city
  */
  public function governmentExpendituresKeyField(){
      $expenditures = new GovernmentExpendituresController();

      //Get the z-value for city taxes
      $municipalTaxes = $expenditures->municipalTaxes();

      //Get the z-value for federal taxes
      $federalTaxes = $expenditures->federalTaxes();

      //Get the z-value for state taxes
      $stateTaxes = $expenditures->stateTaxes();

      //Get the z-value for government expending
      $governmentExpending = $expenditures->governmentExpending();

      //sum z-values
      $sumZvalues = array_map(array($this, "sumCityValues"), $municipalTaxes, $federalTaxes, $stateTaxes, $governmentExpending);

      //Divide the sum of z-values to obtain the z-values average of each city
      $zValuesAvg = array_map(array($this, "divideKeyFields"), $sumZvalues, array_fill(0, count($sumZvalues), 4));
      //combine the array keys(cities'name) with the average of z-values gotten
      $zValuesAvg = array_combine(array_keys($stateTaxes), array_values($zValuesAvg));

      return $zValuesAvg;
  }

  /**
  * It will calculate the average of the z-values for Health
  * @return return the average of z-values by key field of each city
  */
  public function healthKeyField(){
      $health = new HealthController();
      $sewage = new EnvironmentController();

      //Get the z-value for other water supply
      $waterSupplyOther = $health->waterSupplyOther();
      $waterSupplyOtherInverted = array_map(array($this, "addImpact"), $waterSupplyOther);

      //Get the z-value for well or spring source
      $wellSpring = $health->wellSpring();
      $wellSpringInverted = array_map(array($this, "addImpact"), $wellSpring);

      //Get the z-value for public water supply
      $publicWaterSupply = $health->publicWaterSupply();

      //Get the z-value for drainage Ditch
      $drainageDitch = $sewage->drainageDitch();
      $drainageDitchInverted = array_map(array($this, "addImpact"), $drainageDitch);

      //Get the z-value for river, lake and sea sewerage disposal
      $riverLakeDisposal = $sewage->river_lake_sea_sewerageDisposal();
      $riverLakeDisposalInverted = array_map(array($this, "addImpact"), $riverLakeDisposal);

      //Get the z-value for river, lake and sea sewerage disposal
      $septicTank = $sewage->septicTank();

      //sum z-values
      $sumZvalues = array_map(array($this, "sumCityValues"), $waterSupplyOtherInverted,
                    $wellSpringInverted, $publicWaterSupply, $drainageDitchInverted,
                    $riverLakeDisposalInverted, $septicTank);

      //Divide the sum of z-values to obtain the z-values average of each city
      $zValuesAvg = array_map(array($this, "divideKeyFields"), $sumZvalues, array_fill(0, count($sumZvalues), 6));
      //combine the array keys(cities'name) with the average of z-values gotten
      $zValuesAvg = array_combine(array_keys($septicTank), array_values($zValuesAvg));

      return $zValuesAvg;
  }

  /**
  * It will calculate the average of the z-values for Economy
  * @return return the average of z-values by key field of each city
  */
  public function economyKeyField(){
      $economy = new EconomyController();

      //Get the z-value for  gross domestic product (GDP)
      $cityGdp = $economy->cityGdp();

      //Get the z-value for Gross value added (GVA)
      $cityGva = $economy->cityGva();

      //Get the z-value for amount of companies
      $cityCompanies = $economy->cityCompanies();

      //sum z-values
      $sumZvalues = array_map(array($this, "sumCityValues"), $cityGdp, $cityGva, $cityCompanies);

      //Divide the sum of z-values to obtain the z-values average of each city
      $zValuesAvg = array_map(array($this, "divideKeyFields"), $sumZvalues, array_fill(0, count($sumZvalues), 3));
      //combine the array keys(cities'name) with the average of z-values gotten
      $zValuesAvg = array_combine(array_keys($cityCompanies), array_values($zValuesAvg));

      return $zValuesAvg;
  }

  /**
  * It will calculate the average of the z-values for Economy
  * @return return the average of z-values by key field sortZvaluesof each city
  */
  public function employmentKeyField(){
      $employmnet = new EmploymentController();

      //Get the z-value for  gross domestic product (GDP)
      $cityEmployment = $employmnet->cityEmployment();

      //Get the z-value for Gross value added (GVA)
      $citySalary = $employmnet->citySalary();

      //sum z-values
      $sumZvalues = array_map(array($this, "sumCityValues"), $cityEmployment, $citySalary);

      //Divide the sum of z-values to obtain the z-values average of each city
      $zValuesAvg = array_map(array($this, "divideKeyFields"), $sumZvalues, array_fill(0, count($sumZvalues), 2));
      //combine the array keys(cities'name) with the average of z-values gotten
      $zValuesAvg = array_combine(array_keys($citySalary), array_values($zValuesAvg));

      return $zValuesAvg;
  }

  /**
  * It will calculate the average of the z-values for Environment
  * @return return the average of z-values by key field of each city
  */
  public function environmentKeyField(){
      $sewage = new EnvironmentController();

      //Get the z-value for drainage Ditch
      $drainageDitch = $sewage->drainageDitch();
      $drainageDitchInverted = array_map(array($this, "addImpact"), $drainageDitch);

      //Get the z-value for river, lake and sea sewerage disposal
      $riverLakeDisposal = $sewage->river_lake_sea_sewerageDisposal();
      $riverLakeDisposalInverted = array_map(array($this, "addImpact"), $riverLakeDisposal);

      //Get the z-value for river, lake and sea sewerage disposal
      $septicTank = $sewage->septicTank();

      //Get the z-value for other kinds of garbage disposal
      $garbageDisOther = $sewage->garbageDisOther();
      $garbageDisOtherInverted = array_map(array($this, "addImpact"), $garbageDisOther);

      //Get the z-value for the garbage dumped
      $garbageDumped = $sewage->garbageDumped();
      $garbageDumpedInverted = array_map(array($this, "addImpact"), $garbageDumped);

      //Get the z-value for garbage buried
      $garbageBuried = $sewage->garbageBuried();
      $garbageBuriedInverted = array_map(array($this, "addImpact"), $garbageBuried);

      //Get the z-value for garbage incinerated
      $garbageIncinerated = $sewage->garbageIncinerated();
      $garbageIncineratedInverted = array_map(array($this, "addImpact"), $garbageIncinerated);

      //Get the z-value for garbage collected
      $garbageCollected = $sewage->garbageCollected();

      //Get the z-value for cesspit
      $cesspit = $sewage->cesspit();
      $cesspitInverted = array_map(array($this, "addImpact"), $cesspit);

      //Get the z-value for other kinds of sewerage
      $otherSewerage = $sewage->otherSewerage();
      $otherSewerageInverted = array_map(array($this, "addImpact"), $otherSewerage);

      //Get the z-value for sewerage system
      $sewerageSystem = $sewage->sewerageSystem();

      //sum z-values
      $sumZvalues = array_map(array($this, "sumCityValues"), $drainageDitchInverted,
                    $riverLakeDisposalInverted, $septicTank, $garbageDisOtherInverted,
                    $garbageDumpedInverted, $garbageBuriedInverted, $garbageIncineratedInverted,
                    $garbageCollected, $cesspitInverted, $otherSewerageInverted, $sewerageSystem);

      //Divide the sum of z-values to obtain the z-values average of each city
      $zValuesAvg = array_map(array($this, "divideKeyFields"), $sumZvalues, array_fill(0, count($sumZvalues), 11));
      //combine the array keys(cities'name) with the average of z-values gotten
      $zValuesAvg = array_combine(array_keys($septicTank), array_values($zValuesAvg));

      return $zValuesAvg;
  }

  /**
  * This function will truncate the z-values
  * @param double $value  The value to be truncated
  * @return Return a truncated value
  */
  function truncateValues($value){
    if($value >= 0){
      return floor($value * 1000);
    }else{
      return ceil($value * 1000);
    }
  }


  /**
  * Create the dense ranking from sorted scores
  *@param array $sortedScores It should receive an array with already sorted values
  */
  public function makeDenseRanking($sortedScores){
    //This will hold the ranking values e.g. 1,2,3 ...
    $rankingScores = array();

    //this will keep tracking the keys in the array
    $arrayKeys = array_keys($sortedScores);

    //Keep the last score to compare with the actual score
    $lastScore = $sortedScores[$arrayKeys[0]];
    //Keep tracking the positions. Once $lastScore variable and the first value
    // in the $truncatedVales array are same, the the $i variable is set to 1
    $position = 1;
    foreach($sortedScores as $key => $value){
        //If last score is different then increases one position.
        //Because lastScore and the first value are same it will not be evaluated as true
        if($value != $lastScore){
            $position++;
        }
        $rankingScores[$key] = $position;
        //Update last score to actual value
        $lastScore = $value;
    }

    return $rankingScores;
  }
  /**
  * Sort the truncated z-scores from high to low value
  * @param array $cityValues receive a array with the z-values
  */
  private function sortZvalues($cityValues){
    //This will hold the ranking values e.g. 1,2,3 ...
    $rankingScores = array();

    //truncate the values in the array
    $truncateValues = array_map(array($this, "truncateValues"), $cityValues);
    //sort the truncated z-scores from high to low
    arsort($truncateValues);

    //Make the ranking from the truncated z-values
    $rankingScores = RankController::makeDenseRanking($truncateValues);

    return $rankingScores;
  }

  /**
  * This method will calculate a overall rating from the ranking create for each key field
  * it will sum the ranking values of each key value and then sort them from low to high,
  * once the city that has the lowest score will have the best position
  * @param array $keyFieldsRank It will receive multidimentional array which keeps
  *                             the ranking of each key field
  */
  private function overallRating($keyFieldsRank){
    //Create an array with citie's name as key and each key set as zero
    $overallSort = array_fill_keys(array_keys($keyFieldsRank["education"]), 0);
    $overallRank = array();
    //Sum the cities scores
    foreach($keyFieldsRank as $key => $keyField){
      foreach($keyField as $key => $value){
        $overallSort[$key] += $value;
      }
    }
    //sort the ranking scores from low to high
    asort($overallSort);

    //Make the ranking from the sum of each city's rank
    $rankingScores = RankController::makeDenseRanking($overallSort);

    return $rankingScores;
  }
}
