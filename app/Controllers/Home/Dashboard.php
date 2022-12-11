<?php

namespace App\Controllers\Home;

use App\Controllers\BaseController;


class Dashboard extends BaseController
{
  public function index()
  {
    $state = 1;
  


    return view("home/dashboard", [
      "countEditorials" => model("VEditorials")->countEditorials($state),
      "countBooks" =>   model("VAutors")->countAutors($state),
      "countAutors" =>  model("VAutors")->countAutors($state),
      "countStudents" =>   model("VStudents")->countStudents($state),
    ]);
  }
}
