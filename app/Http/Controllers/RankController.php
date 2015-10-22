<?php
namespace SmartCity\Http\Controllers;
use SmartCity\Cities;

class RankController extends Controller{

  public function index()
  {
      //return view('cities');
      $employment = new EducationController();
      print_r($employment->schoolNumberGraduates("Ensino_Medio"));
  }
}
