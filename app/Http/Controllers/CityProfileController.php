<?php
namespace SmartCity\Http\Controllers;
use SmartCity\Cities;

class CityProfileController extends Controller{

  public function index($cityName){
    if(isset($cityName)){
      return view("cityprofile", ["cityName"=> $cityName]);
    }
    return 0;
  }
  /**
  * Return the key fields z-values for the selected city and the key fields z-values average
  * @param string $cityName name of the selected city
  * @return array $cityValues it contains the z-values and a z-values average
  */
  public function profile($cityName){
    if(isset($cityName)){
      if(strcmp($cityName, '') != 0){
        $keyFieldsZValues = new RankController();
        $average          = new ZtransformController();

        //Retrive the z-values for each key field
        $educationKeyField       = $keyFieldsZValues->educationKeyField();
        $governmentExpenKeyField = $keyFieldsZValues->governmentExpendituresKeyField();
        $healthKeyField          = $keyFieldsZValues->healthKeyField();
        $economyKeyField         = $keyFieldsZValues->economyKeyField();
        $employmentKeyField      = $keyFieldsZValues->employmentKeyField();
        $environmentKeyField     = $keyFieldsZValues->environmentKeyField();

        //create an array with each z-value of the selected city
        $cityInfo = array('Educação' => $educationKeyField[$cityName], 'Finanças Públicas' => $governmentExpenKeyField[$cityName],
                'Saúde' => $healthKeyField[$cityName], 'Economia' => $economyKeyField[$cityName],
                'Emprego' => $employmentKeyField[$cityName], 'Meio Ambiente' => $environmentKeyField[$cityName]);

        $cityValues = CityProfileController::mergeAverage($cityInfo);

        return $cityValues;
      }
    }
    return 0;
  }

  /**
  * Return the education z-values for the selected city and its average
  * @param string $cityName name of the selected city
  * @return array $cityValues it contains the z-values and a z-values average
  */
  public function educationDomain($cityName){
    if(isset($cityName)){
      if(strcmp($cityName, '') != 0){
        $education = new EducationController();

        //Get the z-values for high school
        $highSchoolFailure    = $education->schoolFailureRate("Ensino_Medio");//High School z-value for failure
        $highSchoolDistortion = $education->schoolDistortionRate("Ensino_Medio");//High School z-value for distortion rate
        $highSchoolPass       = $education->schoolPassRate("Ensino_Medio");//High School z-value for distortion rate
        $highSchoolDrop       = $education->schoolDropOutRate("Ensino_Medio");//High School z-value for dropout
        $highSchoolGraduates  = $education->schoolNumberGraduates("Ensino_Medio");//High School z-value for number of graduates

        //Get the z-values for elementary and middle school
        $elemFailure    = $education->schoolFailureRate("Ensino_Fundamental");//High School z-value for failure
        $elemDistortion = $education->schoolDistortionRate("Ensino_Fundamental");//High School z-value for distortion rate
        $elemPass       = $education->schoolPassRate("Ensino_Fundamental");//High School z-value for distortion rate
        $elemDrop       = $education->schoolDropOutRate("Ensino_Fundamental");//High School z-value for dropout
        $elemGraduates  = $education->schoolNumberGraduates("Ensino_Fundamental");//High School z-value for number of graduates

        //Get th z-values for preschool
        $preSchool = $education->preSchoolEnrollments();

        $cityEduInfo = array("Ensino Médio - Reprovação" => $highSchoolFailure[$cityName], "Ensino Médio - Distorção Idade-Série" => $highSchoolDistortion[$cityName],
                         "Ensino Médio - Aprovação" => $highSchoolPass[$cityName], "Ensino Médio - Abandono" => $highSchoolDrop[$cityName],
                         "Ensino Médio - Concluintes" => $highSchoolGraduates[$cityName], "Ensino Fundamental - Reprovação" => $elemFailure[$cityName],
                         "Ensino Funcamental - Distorção Idade-Série" => $elemDistortion[$cityName], "Ensino Funcamental - Aprovação" => $elemPass[$cityName],
                         "Ensino Funcamental - Abandono" => $elemDrop[$cityName], "Ensino Funcamental - Concluintes" => $elemGraduates[$cityName],
                         "Educação Infantil - Matrículas" => $preSchool[$cityName]);

        $cityEduValues = CityProfileController::mergeAverage($cityEduInfo);

        return $cityEduValues;
      }
    }
    return 0;
  }

  /**
  * Return the government expenditures z-values for the selected city and its average
  * @param string $cityName name of the selected city
  * @return array $cityValues it contains the z-values and a z-values average
  */
  public function governmentExpendituresDomain($cityName){
    if(isset($cityName)){
      if(strcmp($cityName, '') != 0){
        $expenditures = new GovernmentExpendituresController();

        //Get the z-value for city taxes
        $municipalTaxes = $expenditures->municipalTaxes();

        //Get the z-value for federal taxes
        $federalTaxes = $expenditures->federalTaxes();

        //Get the z-value for state taxes
        $stateTaxes = $expenditures->stateTaxes();

        //Get the z-value for government expending
        $governmentExpending = $expenditures->governmentExpending();

        $cityExpendituresInfo = array("Tributos Municipais" => $municipalTaxes[$cityName],
                                      "Tributos Federais" => $federalTaxes[$cityName],
                                      "Tributos Estaduais" => $stateTaxes[$cityName],
                                      "Despesas Realizadas" => $governmentExpending[$cityName]);

        $cityExpendituresValues = CityProfileController::mergeAverage($cityExpendituresInfo);

        return $cityExpendituresValues;
      }
    }
    return 0;
  }

  /**
  * Return the health z-values for the selected city and its average
  * @param string $cityName name of the selected city
  * @return array $cityValues it contains the z-values and a z-values average
  */
  public function healthDomain($cityName){
    if(isset($cityName)){
      if(strcmp($cityName, '') != 0){
        $health  = new HealthController();
        $sewage  = new EnvironmentController();

        //Get the z-value for other water supply
        $waterSupplyOther = $health->waterSupplyOther();

        //Get the z-value for well or spring source
        $wellSpring = $health->wellSpring();

        //Get the z-value for public water supply
        $publicWaterSupply = $health->publicWaterSupply();

        //Get the z-value for drainage Ditch
        $drainageDitch = $sewage->drainageDitch();

        //Get the z-value for river, lake and sea sewerage disposal
        $riverLakeDisposal = $sewage->river_lake_sea_sewerageDisposal();

        //Get the z-value for river, lake and sea sewerage disposal
        $septicTank = $sewage->septicTank();

        $cityHealthInfo = array("Abastecimento de Água - Outros" => $waterSupplyOther[$cityName],
                                "Abastecimento de Água - Poço ou Nascente" => $wellSpring[$cityName],
                                "Abastecimento de Água - Rede Geral" => $publicWaterSupply[$cityName],
                                "Esgotamento Sanitário - Vala" => $drainageDitch[$cityName],
                                "Esgotamento Sanitário - Fossa Séptica" => $septicTank[$cityName],
                                "Esgotamento Sanitário - Rio, lago ou mar" => $riverLakeDisposal[$cityName]);

        $cityHealthValues = CityProfileController::mergeAverage($cityHealthInfo);

        return $cityHealthValues;
      }
    }
    return 0;
  }

  /**
  * Return the economy domain z-values for the selected city and its average
  * @param string $cityName name of the selected city
  * @return array $cityValues it contains the z-values and a z-values average
  */
  public function economyDomain($cityName){
    if(isset($cityName)){
      if(strcmp($cityName, '') != 0){
        $economy = new EconomyController();

        //Get the z-value for  gross domestic product (GDP)
        $cityGdp = $economy->cityGdp();

        //Get the z-value for Gross value added (GVA)
        $cityGva = $economy->cityGva();

        //Get the z-value for amount of companies
        $cityCompanies = $economy->cityCompanies();

        $cityEconomyInfo = array("Número de estabelecimentos" => $cityCompanies[$cityName],
                                "PIB" => $cityGdp[$cityName],
                                "Valor Adicionado Bruto" => $cityGva[$cityName]);

        $cityEconomyValues = CityProfileController::mergeAverage($cityEconomyInfo);

        return $cityEconomyValues;
      }
    }
    return 0;
  }
  /**
  * Return the employment domain z-values for the selected city and its average
  * @param string $cityName name of the selected city
  * @return array $cityValues it contains the z-values and a z-values average
  */
  public function employmentDomain($cityName){
    if(isset($cityName)){
      if(strcmp($cityName, '') != 0){
        $employmnet = new EmploymentController();

        //Get the z-value for  gross domestic product (GDP)
        $cityEmployment = $employmnet->cityEmployment();

        //Get the z-value for Gross value added (GVA)
        $citySalary = $employmnet->citySalary();

        $cityEmploymentInfo = array("Número de vínculos empregatícios" => $cityEmployment[$cityName],
                                    "Remuneração média" => $citySalary[$cityName]);

        $cityEmploymentValues = CityProfileController::mergeAverage($cityEmploymentInfo);

        return $cityEmploymentValues;
      }
    }
    return 0;
  }

  /**
  * Return the environment domain z-values for the selected city and its average
  * @param string $cityName name of the selected city
  * @return array $cityValues it contains the z-values and a z-values average
  */
  public function environmentDomain($cityName){
    if(isset($cityName)){
      if(strcmp($cityName, '') != 0){
        $sewage  = new EnvironmentController();
        //Get the z-value for drainage Ditch
        $drainageDitch = $sewage->drainageDitch();
        //Get the z-value for river, lake and sea sewerage disposal
        $riverLakeDisposal = $sewage->river_lake_sea_sewerageDisposal();
        //Get the z-value for river, lake and sea sewerage disposal
        $septicTank = $sewage->septicTank();
        //Get the z-value for other kinds of garbage disposal
        $garbageDisOther = $sewage->garbageDisOther();
        //Get the z-value for the garbage dumped
        $garbageDumped = $sewage->garbageDumped();
        //Get the z-value for garbage buried
        $garbageBuried = $sewage->garbageBuried();
        //Get the z-value for garbage incinerated
        $garbageIncinerated = $sewage->garbageIncinerated();
        //Get the z-value for garbage collected
        $garbageCollected = $sewage->garbageCollected();
        //Get the z-value for cesspit
        $cesspit = $sewage->cesspit();
        //Get the z-value for other kinds of sewerage
        $otherSewerage = $sewage->otherSewerage();
        //Get the z-value for sewerage system
        $sewerageSystem = $sewage->sewerageSystem();

        $cityEnvironmentInfo = array("Destino do Lixo - Outro" => $garbageDisOther[$cityName],
                                    "Destino do Lixo - Jogado" => $garbageDumped[$cityName],
                                    "Destino do Lixo - Enterrado" => $garbageBuried[$cityName],
                                    "Destino do Lixo - Queimado" => $garbageIncinerated[$cityName],
                                    "Destino do Lixo - Coletado" => $garbageCollected[$cityName],
                                    "Esgotamento Sanitário - Fossa Rudimentar" => $cesspit[$cityName],
                                    "Esgotamento Sanitário - Fossa Séptica" => $septicTank[$cityName],
                                    "Esgotamento Sanitário - Outro" => $otherSewerage[$cityName],
                                    "Esgotamento Sanitário - Rede pluvial" => $sewerageSystem[$cityName],
                                    "Esgotamento Sanitário - Rio, Lago ou mar" => $riverLakeDisposal[$cityName],
                                    "Esgotamento Sanitário - Vala" => $drainageDitch[$cityName]);

        $cityEnvironmentValues = CityProfileController::mergeAverage($cityEnvironmentInfo);

        return $cityEnvironmentValues;
      }
    }
    return 0;
  }

    /**
    * This will receive a array  with the z-values of the selected city, make the average of these values
    * and merge the average with the array received
    * @param array $cityInfo that contains the city z-values of each domain
    * @return array $cityValues with the z-values of each domain and the average of those values
    */
  private function mergeAverage($cityInfo){
    //instatiate class ZtransformController to access the method which calculates the average
    $average = new ZtransformController();
    //make the average of the z-values
    $cityAvg = $average->calculateAverage($cityInfo, sizeof($cityInfo));
    //merge the city the values array with the average calculated
    $cityValues = array_merge($cityInfo, array("Média" => $cityAvg));

    return $cityValues;
  }
}
