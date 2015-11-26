<?php

namespace SmartCity\Jobs;

use SmartCity\FacebookTags;
use SmartCity\Jobs\Job;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Bus\SelfHandling;
use Illuminate\Contracts\Queue\ShouldQueue;
use DB;

class FacebookPost extends Job implements SelfHandling, ShouldQueue
{
    use InteractsWithQueue, SerializesModels;
    private $data;
    private $city;
    private $tags;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)//, $city)
    {
        $this->data = $data;
        $this->tags = array();
        $this->city = array();
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      //Iterate the array and sends the post data to be analyzed
      foreach($this->data as $key => $value){
        FacebookPost::findTags($value);
        FacebookPost::save();
      }

      DB::reconnect();//Make a fresh connection
    }

    private function findTags($data){
        foreach($data as $objKey => $message){

          if($objKey == "message"){
            $findCity = FacebookPost::findCityTag($message);
            if(isset($findCity)){
              $this->city = $findCity;
              FacebookPost::findIssuesTag($message);
            }else{
              return FALSE;
            }
          }
        }
    }
    /**
    * This method will look for tags that stand for issues
    * @param String $message The content of the post
    *
    */
    private function findIssuesTag($message){

      $messageArr = explode(" ", $message);
      $cityTagArr = array();

      foreach ($messageArr as $key => $value) {
        if(strcasecmp($value, "#pavimento") === 0){

          FacebookPost::setCityTags("Pavimento");

        }
        if((strcasecmp($value, "#transito") === 0) || (strcasecmp($value, "#trânsito") === 0)){

          FacebookPost::setCityTags("Trânsito");

        }
        if((strcasecmp($value, "#poluicao") === 0) || (strcasecmp($value, "#poluição") === 0) ||
                  (strcasecmp($value, "#poluiçao") === 0)){

          FacebookPost::setCityTags("Poluição");

        }
        if((strcasecmp($value, "#estacionamento") === 0)){

          FacebookPost::setCityTags("Estacionamento");

        }
        if((strcasecmp($value, "#calcada") === 0) || (strcasecmp($value, "#calçada") === 0) ||
                  (strcasecmp($value, "#calçadas") === 0) || (strcasecmp($value, "#calcadas") === 0) ||
                  (strcasecmp($value, "#passeio") === 0) || (strcasecmp($value, "#passeios") === 0)){

          FacebookPost::setCityTags("Calçadas");

        }
        if((strcasecmp($value, "#saude") === 0) || (strcasecmp($value, "#saúde") === 0)){

          FacebookPost::setCityTags("Saúde");

        }
        if((strcasecmp($value, "#atendimento") === 0) || (strcasecmp($value, "#funcionários") === 0) ||
                  (strcasecmp($value, "#funcionarios") === 0) || (strcasecmp($value, "#funcionarios") === 0)){

          FacebookPost::setCityTags("Atendimento");

        }
        if((strcasecmp($value, "#emprego") === 0) || (strcasecmp($value, "#trabalho") === 0)){

          FacebookPost::setCityTags("Emprego");

        }
        if((strcasecmp($value, "#aluguel") === 0)){

          FacebookPost::setCityTags("Aluguel");

        }
        if((strcasecmp($value, "#imoveis") === 0) || (strcasecmp($value, "#imóveis") === 0)){

          FacebookPost::setCityTags("Imóveis");

        }
        if((strcasecmp($value, "#diversão") === 0) || (strcasecmp($value, "#diversao") === 0)){

          FacebookPost::setCityTags("Diversão");

        }
        if((strcasecmp($value, "#infraestrutura") === 0)){

          FacebookPost::setCityTags("Infraestrutura");

        }
        if((strcasecmp($value, "#violencia") === 0) || (strcasecmp($value, "#violência") === 0)){

          FacebookPost::setCityTags("Violência");

        }
        if((strcasecmp($value, "#drogas") === 0)){

          FacebookPost::setCityTags("Drogas");

        }
        if((strcasecmp($value, "#educacao") === 0) || (strcasecmp($value, "#educação") === 0)){

          FacebookPost::setCityTags("Educação");

        }
        if((strcasecmp($value, "#impostos") === 0)){

          FacebookPost::setCityTags("Impostos");

        }
        if((strcasecmp($value, "#SaneamentoBásico") === 0) || (strcasecmp($value, "#SaneamentoBasico") === 0)){

          FacebookPost::setCityTags("SaneamentoBásico");

        }
        if((strcasecmp($value, "#buracos") === 0) || (strcasecmp($value, "#buraco") === 0)){

          FacebookPost::setCityTags("Buracos");

        }
      }
    }

    private function setCityTags($tag){
          $this->tags[$tag] = 1;
    }

    /**
    * This method will look for tags that stand for a city
    * @param String $message The content of the post
    *
    */
    private function findCityTag($message){

      $messageArr = explode(" ", $message);
      $cityTagArr = array();

      foreach($messageArr as $key => $value){
        if((strcasecmp($value, "#FW") === 0) || (strcasecmp($value, "#FredWest") === 0) ||
            (strcasecmp($value, "#FredericoWestphalen") === 0)){

          $cityTagArr[] = "Frederico Westphalen";

        }
        if(strcasecmp($value, "#Alpestre") === 0){

          $cityTagArr[] = "Alpestre";

        }
        if((strcasecmp($value, "#AmetistadoSul") === 0) || (strcasecmp($value, "#AmetistaSul") === 0)){

          $cityTagArr[] = "Ametista do Sul";

        }
        if((strcasecmp($value, "#Caiçara") === 0) || (strcasecmp($value, "#Caicara") === 0)){

          $cityTagArr[] = "Caiçara";

        }
        if(strcasecmp($value, "#Constantina") === 0){

          $cityTagArr[] = "Constantina";

        }
        if((strcasecmp($value, "#CristaldoSul") === 0) || (strcasecmp($value, "#CristalSul") === 0)){

          $cityTagArr[] = "Cristal do Sul";

        }
        if((strcasecmp($value, "#DoisIrmãosdasMissões") === 0) || (strcasecmp($value, "#DoisIrmaosdasMissoes") === 0) ||
                  (strcasecmp($value, "#DoisIrmaosMissoes") === 0)){

          $cityTagArr[] = "Dois Irmãos das Missões";

        }
        if((strcasecmp($value, "#EngenhoVelho") === 0)){

          $cityTagArr[] = "Engenho Velho";

        }
        if((strcasecmp($value, "#ErvalSeco") === 0)){

          $cityTagArr[] = "Erval Seco";

        }
        if((strcasecmp($value, "#GramadodosLoureiros") === 0) || (strcasecmp($value, "#GramadoLoureiros") === 0)){

          $cityTagArr[] = "Gramado dos Loureiros";

        }
        if((strcasecmp($value, "#Iraí") === 0) || (strcasecmp($value, "#Irai") === 0)){

          $cityTagArr[] = "Iraí";

        }
        if((strcasecmp($value, "#LiberatoSalzano") === 0)){

          $cityTagArr[] = "Liberato Salzano";

        }
        if((strcasecmp($value, "#Nonoai") === 0)){

          $cityTagArr[] = "Nonoai";

        }
        if((strcasecmp($value, "#NovoTiradentes") === 0)){

          $cityTagArr[] = "Novo Tiradentes";

        }
        if((strcasecmp($value, "#NovoXingu") === 0)){

          $cityTagArr[] = "Novo Xingu";

        }
        if((strcasecmp($value, "#Palmitinho") === 0)){

          $cityTagArr[] = "Palmitinho";

        }
        if((strcasecmp($value, "#PinheirinhodoVale") === 0) || (strcasecmp($value, "#PinheirinhoVale") === 0)){

          $cityTagArr[] = "Pinheirinho do Vale";

        }
        if((strcasecmp($value, "#Planalto") === 0)){

          $cityTagArr[] = "Planalto";

        }
        if((strcasecmp($value, "#RiodosÍndios") === 0) || (strcasecmp($value, "#RiodosIndios") === 0) ||
                  (strcasecmp($value, "#RioÍndios") === 0) || (strcasecmp($value, "#RioIndios") === 0)){

          $cityTagArr[] = "Rio dos Índios";

        }
        if((strcasecmp($value, "#RodeioBonito") === 0)){

          $cityTagArr[] = "Rodeio Bonito";

        }
        if((strcasecmp($value, "#Rondinha") === 0)){

          $cityTagArr[] = "Rondinha";

        }
        if((strcasecmp($value, "#Seberi") === 0)){

          $cityTagArr[] = "Seberi";

        }
        if((strcasecmp($value, "#TaquaruçudoSul") === 0) || (strcasecmp($value, "#TaquarucudoSul") === 0) ||
                  (strcasecmp($value, "#TaquaruçuSul") === 0) || (strcasecmp($value, "#TaquarucuSul") === 0)){

          $cityTagArr[] = "Taquaruçu do Sul";

        }
        if((strcasecmp($value, "#TrêsPalmeiras") === 0) || (strcasecmp($value, "#TresPalmeiras") === 0)){

          $cityTagArr[] = "Três Palmeiras";

        }
        if((strcasecmp($value, "#TrindadedoSul") === 0) || (strcasecmp($value, "#TrindadeSul") === 0)){

          $cityTagArr[] = "Trindade do Sul";

        }
        if((strcasecmp($value, "#VicenteDutra") === 0) || (strcasecmp($value, "#ViDu") === 0)){

          $cityTagArr[] = "Vicente Dutra";

        }
        if((strcasecmp($value, "#Vista Alegre") === 0)){

          $cityTagArr[] = "Vista Alegre";

        }
      }
      return $cityTagArr;
    }

    /**
    * This function will save the hashtag information in the database, adding a
    * new hashtag, its city and number of times it appeared
    * @param String $tagName the identification of the tag to update the counter
    * @param Int $count the number of times a hashtag was found
    * @param FacebookTags $tagModel It keeps the model information
    */
    private function save(){
      //instantiate the model object
      $tagModel = new FacebookTags;

      $collectionExist = FacebookPost::collectionExist($tagModel);

      if(isset($collectionExist)){

        foreach($this->city as $cityKey => $cityValue){
          $cityExist = FacebookPost::cityExist($tagModel, $cityValue);

          if($cityExist > 0){

            foreach($this->tags as $tagKey => $tagValue){
              $tagExist = FacebookPost::tagsExist($tagKey, $cityValue);

              if($tagExist){
                FacebookPost::incrementTag($tagKey, $tagValue, $cityValue);
              }else{
                FacebookPost::addTag($tagKey, $cityValue, $tagValue);
              }
            }

          }else{
            FacebookPost::saveInfo($this->tags, $cityValue);
          }
        }
      }else{
        FacebookPost::saveInfo($this->tags, $this->city);
      }

      $this->tags = array();
      $this->city = array();
    }

    /**
    * This function should be used only when the city is not stored.
    * It will save information in the database, adding a new hashtag, its city
    * and number of times it appeared.
    * @param String $tagName the identification of the tag to update the counter
    * @param FacebookTags $tagModel It keeps the model information
    */
    private function saveInfo($tagName, $city){
      $tagModel = new FacebookTags;

      if(is_array($city)){
        foreach ($city as $cityKey => $cityValue) {
          $tagModel->City = $cityValue;
          $tagModel->save();
          foreach ($tagName as $tagKey => $tagValue) {
            FacebookPost::addTag($tagKey, $cityValue, $tagValue, $tagModel);
          }
        }
      }else{
        $tagModel->City = $city;
        $tagModel->save();
        foreach ($tagName as $tagKey => $tagValue) {
          FacebookPost::addTag($tagKey, $city, $tagValue, $tagModel);
        }
      }

    }

    /**
    * This function will save a hashtag when the city is already stored in the database
    * @param String $tagName the identification of the tag to update the counter
    * @param Int $count the number of times a hashtag was found
    * @param Int $city The city name
    */
    private function addTag($tagName, $city, $count){
      $tagModel = new FacebookTags;
      $updateTag = $tagModel->where("City", $city);
      $addTag    = $updateTag->get()[0]->Tags;

      if(isset($addTag)){
        $addTag = array_merge($addTag, [$tagName => $count]);
        $updateTag->update(["Tags" => $addTag]);
      }else{
        $updateTag->update(["Tags" => [$tagName => $count]]);
      }


    }

    /**
    * This function will increment the hashtag counter in the database
    * @param String $tagName the identification of the tag to update the counter
    * @param Int $count the number of times a hashtag was found
    */
    private function incrementTag($tagName, $count, $city){
      $tagModel = new FacebookTags;
      $updateTag = $tagModel->where("City", $city);

      //Increment the hashatag in $tagName with the number of times that it was found
      $updateTag->increment("Tags." . $tagName, $count);
    }

    /**
    * This function will verify if the city is already stored in the database
    * @param FacebookTags $tagModel It keeps the model information
    * @return Int Return the number of time the city is found in the database
    */
    private function cityExist($tagModel, $city){
      return $tagModel->where("City", $city)->count();
    }

    /**
    * This function will verify if model exist
    * @param FacebookTags $tagModel It keeps the model information
    */
    private function collectionExist($model){
      return $model;
    }

    /**
    * This function will verify if a tag is already in the database
    * @param String $tagName the identification of the tag
    * @return bool Return true if the tag exist, otherwise return false
    */
    private function tagsExist($tagName, $city){
      $tagModel = new FacebookTags;
      $verifyTag = $tagModel->where("City", $city);

      if(isset($verifyTag->get()[0]->Tags[$tagName])){
        return true;
      }else{
        return false;
      }
    }
}
