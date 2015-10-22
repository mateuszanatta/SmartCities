<?php

namespace SmartCity\Http\Controllers;
/**
* This class represents the key field Economy, performin queries in the database,
* make averages and return the z-transform of each domain
*/
class EconomyController extends Controller
{
    /**
    *  Calculte the average and z-transform of gross domestic product (GDP) of each city
    *  @return Return the z-transform for GDP of each city
    */
    public function cityGdp(){
        //It will apply the query into the database and return the data
        $var = "Contabilidade_Social.Serie_1999_em_diante.PIB";
        $citiesGdp = new CitiesController();
        $gdp = $citiesGdp->selectData(array(
                $var => true,
                'Municipio' => true,
                "_id" => false));

        //Make PIB(GDP)'s average and z-values
        $zTransform = new ZtransformController();
        $gdpAvg = array();
        for($i = 0; $i < sizeof($gdp); $i++){
            //Select data of each city
            $gdpValues = $gdp[$i]["Contabilidade_Social"]["Serie_1999_em_diante"]["PIB"];
            //Make the average and save it in an array
            $gdpAvg = array_merge($gdpAvg, array($gdp[$i]["Municipio"] => $zTransform->calculateAverage($gdpValues,sizeof($gdp))));
        }
        //Calculate and return Z-values
        return $zTransform->zTransformation($gdpAvg);
    }
    /**
    *  Calculte the average and z-transform of Gross value added (GVA) of each city
    *  @return Return the z-transform for GVA of each city
    */
    public function cityGva(){
        //It will apply the query into the database and return the data
        $var = "Contabilidade_Social.Serie_1999_em_diante.Valor_Adicionado_Bruto_a_Precos_Basicos.Total";
        $citiesGdp = new CitiesController();
        $gva = $citiesGdp->selectData(array(
                $var => true,
                'Municipio' => true,
                "_id" => false));
        //Make GVA's average
        $zTransform = new ZtransformController();
        $gvaAvg = array();

        for($i = 0; $i < sizeof($gva); $i++){
            //Select data of each city
            $gvaValues = $gva[$i]["Contabilidade_Social"]["Serie_1999_em_diante"]["Valor_Adicionado_Bruto_a_Precos_Basicos"]["Total"];
            //Make the average and save it in an array
            $gvaAvg = array_merge($gvaAvg, array($gva[$i]["Municipio"] => $zTransform->calculateAverage($gvaValues, sizeof($gva))));
        }
          //Calculate and return Z-values
        return $zTransform->zTransformation($gvaAvg);
    }
    /**
    *  Calculte the average and z-transform of the amoutn of companies of each city
    *  @return Return the z-transform for numbe of companies of each city
    */
    public function cityCompanies(){
        //It will apply the query into the database and return the data
        $var = "Emprego.Numero_de_Estabelecimentos.Total";
        $citiesCompanies = new CitiesController();
        $companies = $citiesCompanies->selectData(array(
                $var => true,
                'Municipio' => true,
                "_id" => false));
          //Make number of compnies average
        $zTransform = new ZtransformController();
        $companiesAvg = array();
        for($i = 0; $i < sizeof($companies); $i++){
          //Select data of each city
          $companiesValues = $companies[$i]["Emprego"]["Numero_de_Estabelecimentos"]["Total"];
          //Make the average and save it in an array
          $companiesAvg = array_merge($companiesAvg, array(
                            $companies[$i]["Municipio"] => $zTransform->calculateAverage($companiesValues, sizeof($companies))));
        }
        //Calculate and return Z-values
        return $zTransform->zTransformation($companiesAvg);
    }
}
