<?php
namespace SmartCity\Http\Controllers;
/**
* This class represents the key field Environment, performin queries in the database,
* make averages and return the z-transform of each domain
*/
class EnvironmentController extends Controller{

/**
* Calculate the components z-tranform for the domain Garbage Disposal
*/

    /**
    *  Calculte the average and z-transform of Garbage disposal on other place not classified of each city
    *  @return Return the z-transform for Garbage disposal on other place of each city
    */
    public function garbageDisOther(){
        //It will apply the query into the database and return the data
        $var = "Domicilios_Particulares_Permanentes.Por_Destino_do_Lixo.Outro_Destino.Total";
        $garbageDisOther = new CitiesController();
        $disposedOther = $garbageDisOther->selectData(array(
                $var => true,
                'Municipio' => true,
                "_id" => false));

        //Make disposal's average and z-values
        $zTransform = new ZtransformController();
        $garbageDisOtherAvg = array();
        for($i = 0; $i < sizeof($disposedOther); $i++){
            //Select data of each city
            $garbageDisOtherValues = $disposedOther[$i]["Domicilios_Particulares_Permanentes"]["Por_Destino_do_Lixo"]["Outro_Destino"]["Total"];
            //Make the average and save it in an array
            $garbageDisOtherAvg = array_merge($garbageDisOtherAvg, array($disposedOther[$i]["Municipio"] => $zTransform->calculateAverage($garbageDisOtherValues,sizeof($disposedOther))));
        }
        //Calculate and return Z-values
        return $zTransform->zTransformation($garbageDisOtherAvg);
    }
    /**
    *  Calculte the average and z-transform of Garbage was dumped on each city
    *  @return Return the z-transform for Garbage was dumped on each city
    */
    public function garbageDumped(){
        //It will apply the query into the database and return the data
        $var = "Domicilios_Particulares_Permanentes.Por_Destino_do_Lixo.Jogado.Total";
        $garbageDumped = new CitiesController();
        $dumped = $garbageDumped->selectData(array(
                $var => true,
                'Municipio' => true,
                "_id" => false));

        //Make dumped's average and z-values
        $zTransform = new ZtransformController();
        $dumpedAvg = array();
        for($i = 0; $i < sizeof($dumped); $i++){
            //Select data of each city
            $dumpedValues = $dumped[$i]["Domicilios_Particulares_Permanentes"]["Por_Destino_do_Lixo"]["Jogado"]["Total"];
            //Make the average and save it in an array
            $dumpedAvg = array_merge($dumpedAvg, array($dumped[$i]["Municipio"] => $zTransform->calculateAverage($dumpedValues,sizeof($dumped))));
        }
        //Calculate and return Z-values
        return $zTransform->zTransformation($dumpedAvg);
    }
    /**
    *  Calculte the average and z-transform of Garbage was buried on each city
    *  @return Return the z-transform for Garbage was buried on each city
    */
    public function garbageBuried(){
        //It will apply the query into the database and return the data
        $var = "Domicilios_Particulares_Permanentes.Por_Destino_do_Lixo.Enterrado.Total";
        $garbageBuried = new CitiesController();
        $buries = $garbageBuried->selectData(array(
                $var => true,
                'Municipio' => true,
                "_id" => false));

        //Make buried's average and z-values
        $zTransform = new ZtransformController();
        $buriesAvg = array();
        for($i = 0; $i < sizeof($buries); $i++){
            //Select data of each city
            $buriesValues = $buries[$i]["Domicilios_Particulares_Permanentes"]["Por_Destino_do_Lixo"]["Enterrado"]["Total"];
            //Make the average and save it in an array
            $buriesAvg = array_merge($buriesAvg, array($buries[$i]["Municipio"] => $zTransform->calculateAverage($buriesValues,sizeof($buries))));
        }
        //Calculate and return Z-values
        return $zTransform->zTransformation($buriesAvg);
    }
    /**
    *  Calculte the average and z-transform of Garbage was incinerated on each city
    *  @return Return the z-transform for Garbage was incinerated on each city
    */
    public function garbageIncinerated(){
        //It will apply the query into the database and return the data
        $var = "Domicilios_Particulares_Permanentes.Por_Destino_do_Lixo.Queimado.Total";
        $garbageEncierated = new CitiesController();
        $encinerated = $garbageEncierated->selectData(array(
                $var => true,
                'Municipio' => true,
                "_id" => false));

        //Make incinerated's average and z-values
        $zTransform = new ZtransformController();
        $encineratedAvg = array();
        for($i = 0; $i < sizeof($encinerated); $i++){
            //Select data of each city
            $encineratedValues = $encinerated[$i]["Domicilios_Particulares_Permanentes"]["Por_Destino_do_Lixo"]["Queimado"]["Total"];
            //Make the average and save it in an array
            $encineratedAvg = array_merge($encineratedAvg, array($encinerated[$i]["Municipio"] => $zTransform->calculateAverage($encineratedValues,sizeof($encinerated))));
        }
        //Calculate and return Z-values
        return $zTransform->zTransformation($encineratedAvg);
    }
    /**
    *  Calculte the average and z-transform of Garbage was collected on each city
    *  @return Return the z-transform for Garbage was collected on each city
    */
    public function garbageCollected(){
        //It will apply the query into the database and return the data
        $var = "Domicilios_Particulares_Permanentes.Por_Destino_do_Lixo.Queimado.Total";
        $garbageCollected = new CitiesController();
        $collected = $garbageCollected->selectData(array(
                $var => true,
                'Municipio' => true,
                "_id" => false));

        //Make collected's average and z-values
        $zTransform = new ZtransformController();
        $collectedAvg = array();
        for($i = 0; $i < sizeof($collected); $i++){
            //Select data of each city
            $collectedValues = $collected[$i]["Domicilios_Particulares_Permanentes"]["Por_Destino_do_Lixo"]["Queimado"]["Total"];
            //Make the average and save it in an array
            $collectedAvg = array_merge($collectedAvg, array($collected[$i]["Municipio"] => $zTransform->calculateAverage($collectedValues,sizeof($collected))));
        }
        //Calculate and return Z-values
        return $zTransform->zTransformation($collectedAvg);
    }

/**
* Calculate the components z-tranform for the domain Sewage
*/

    /**
    *  Calculte the average and z-transform of number of cesspit on each city
    *  @return Return the z-transform for of number of cesspit on each city
    */
    public function cesspit(){
        //It will apply the query into the database and return the data
        $var = "Domicilios_Particulares_Permanentes.Por_Tipo_de_Esgotamento_Sanitario.Fossa_Rudimentar.Total";
        $cityCesspit = new CitiesController();
        $cesspit = $cityCesspit->selectData(array(
                $var => true,
                'Municipio' => true,
                "_id" => false));

        //Make cesspit's average and z-values
        $zTransform = new ZtransformController();
        $cesspitAvg = array();
        for($i = 0; $i < sizeof($cesspit); $i++){
            //Select data of each city
            $cesspitValues = $cesspit[$i]["Domicilios_Particulares_Permanentes"]["Por_Tipo_de_Esgotamento_Sanitario"]["Fossa_Rudimentar"]["Total"];
            //Make the average and save it in an array
            $cesspitAvg = array_merge($cesspitAvg, array($cesspit[$i]["Municipio"] => $zTransform->calculateAverage($cesspitValues,sizeof($cesspit))));
        }
        //Calculate and return Z-values
        return $zTransform->zTransformation($cesspitAvg);
    }

    /**
    *  Calculte the average and z-transform of number of septic tank on each city
    *  @return Return the z-transform for of number of septic tank  on each city
    */
    public function septicTank(){
        //It will apply the query into the database and return the data
        $var = "Domicilios_Particulares_Permanentes.Por_Tipo_de_Esgotamento_Sanitario.Fossa_Septica.Total";
        $citySepticTank = new CitiesController();
        $septicTank = $citySepticTank->selectData(array(
                $var => true,
                'Municipio' => true,
                "_id" => false));

        //Make septicTank's average and z-values
        $zTransform = new ZtransformController();
        $septicTankAvg = array();
        for($i = 0; $i < sizeof($septicTank); $i++){
            //Select data of each city
            $septicTankValues = $septicTank[$i]["Domicilios_Particulares_Permanentes"]["Por_Tipo_de_Esgotamento_Sanitario"]["Fossa_Septica"]["Total"];
            //Make the average and save it in an array
            $septicTankAvg = array_merge($septicTankAvg, array($septicTank[$i]["Municipio"] => $zTransform->calculateAverage($septicTankValues,sizeof($septicTank))));
        }
        //Calculate and return Z-values
        return $zTransform->zTransformation($septicTankAvg);
    }

    /**
    *  Calculte the average and z-transform of number of other ways of dispose sewage on each city
    *  @return Return the z-transform for of number of other ways of dispose sewage on each city
    */
    public function otherSewerage(){
        //It will apply the query into the database and return the data
        $var = "Domicilios_Particulares_Permanentes.Por_Tipo_de_Esgotamento_Sanitario.Outro_Escoadouro.Total";
        $cityOtherSewer = new CitiesController();
        $otherSewer = $cityOtherSewer->selectData(array(
                $var => true,
                'Municipio' => true,
                "_id" => false));

        //Make otherSewer's average and z-values
        $zTransform = new ZtransformController();
        $otherSewerAvg = array();
        for($i = 0; $i < sizeof($otherSewer); $i++){
            //Select data of each city
            $otherSewerValues = $otherSewer[$i]["Domicilios_Particulares_Permanentes"]["Por_Tipo_de_Esgotamento_Sanitario"]["Outro_Escoadouro"]["Total"];
            //Make the average and save it in an array
            $otherSewerAvg = array_merge($otherSewerAvg, array($otherSewer[$i]["Municipio"] => $zTransform->calculateAverage($otherSewerValues,sizeof($otherSewer))));
        }
        //Calculate and return Z-values
        return $zTransform->zTransformation($otherSewerAvg);
    }

    /**
    *  Calculte the average and z-transform of number of people using sewerage system on each city
    *  @return Return the z-transform for of number of people using sewerage system on each city
    */
    public function sewerageSystem(){
        //It will apply the query into the database and return the data
        $var = "Domicilios_Particulares_Permanentes.Por_Tipo_de_Esgotamento_Sanitario.Rede_Geral_de_Esgoto_ou_Pluvial.Total";
        $citysewerageSystem = new CitiesController();
        $sewerageSystem = $citysewerageSystem->selectData(array(
                $var => true,
                'Municipio' => true,
                "_id" => false));

        //Make sewerageSystem's average and z-values
        $zTransform = new ZtransformController();
        $sewerageSystemAvg = array();
        for($i = 0; $i < sizeof($sewerageSystem); $i++){
            //Select data of each city
            $sewerageSystemValues = $sewerageSystem[$i]["Domicilios_Particulares_Permanentes"]["Por_Tipo_de_Esgotamento_Sanitario"]["Rede_Geral_de_Esgoto_ou_Pluvial"]["Total"];
            //Make the average and save it in an array
            $sewerageSystemAvg = array_merge($sewerageSystemAvg, array($sewerageSystem[$i]["Municipio"] => $zTransform->calculateAverage($sewerageSystemValues,sizeof($sewerageSystem))));
        }
        //Calculate and return Z-values
        return $zTransform->zTransformation($sewerageSystemAvg);
    }

    /**
    *  Calculte the average and z-transform of number of people using river,lake or sea to dispose thei sewer on each city
    *  @return Return the z-transform for of number of people using river,lake or sea to dispose thei sewer on each city
    */
    public function river_lake_sea_sewerageDisposal(){
        //It will apply the query into the database and return the data
        $var = "Domicilios_Particulares_Permanentes.Por_Tipo_de_Esgotamento_Sanitario.Rio,_Lago_ou_Mar.Total";
        $citySewerageDisposal = new CitiesController();
        $sewerageDisposal = $citySewerageDisposal->selectData(array(
                $var => true,
                'Municipio' => true,
                "_id" => false));

        //Make otherSewer's average and z-values
        $zTransform = new ZtransformController();
        $sewerageDisposalAvg = array();
        for($i = 0; $i < sizeof($sewerageDisposal); $i++){
            //Select data of each city
            $sewerageDisposalValues = $sewerageDisposal[$i]["Domicilios_Particulares_Permanentes"]["Por_Tipo_de_Esgotamento_Sanitario"]["Rio,_Lago_ou_Mar"]["Total"];
            //Make the average and save it in an array
            $sewerageDisposalAvg = array_merge($sewerageDisposalAvg, array($sewerageDisposal[$i]["Municipio"] => $zTransform->calculateAverage($sewerageDisposalValues,sizeof($sewerageDisposal))));
        }
        //Calculate and return Z-values
        return $zTransform->zTransformation($sewerageDisposalAvg);
    }

    /**
    *  Calculte the average and z-transform of number of people using river,lake or sea to dispose thei sewer on each city
    *  @return Return the z-transform for of number of people using river,lake or sea to dispose thei sewer on each city
    */
    public function drainageDitch(){
        //It will apply the query into the database and return the data
        $var = "Domicilios_Particulares_Permanentes.Por_Tipo_de_Esgotamento_Sanitario.Vala.Total";
        $cityDrainageDitch = new CitiesController();
        $drainageDitch = $cityDrainageDitch->selectData(array(
                $var => true,
                'Municipio' => true,
                "_id" => false));

        //Make otherSewer's average and z-values
        $zTransform = new ZtransformController();
        $drainageDitchAvg = array();
        for($i = 0; $i < sizeof($drainageDitch); $i++){
            //Select data of each city
            $drainageDitchValues = $drainageDitch[$i]["Domicilios_Particulares_Permanentes"]["Por_Tipo_de_Esgotamento_Sanitario"]["Vala"]["Total"];
            //Make the average and save it in an array
            $drainageDitchAvg = array_merge($drainageDitchAvg, array($drainageDitch[$i]["Municipio"] => $zTransform->calculateAverage($drainageDitchValues,sizeof($drainageDitch))));
        }
        //Calculate and return Z-values
        return $zTransform->zTransformation($drainageDitchAvg);
    }
}
