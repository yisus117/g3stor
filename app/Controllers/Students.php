<?php

namespace App\Controllers;

class Students extends BaseController
{
    public function index()
    {
        $model = model("VStudentsModel");

        if ($this->request->getGet("active") != "2") {
          $state = 1;
        } else {
          $state = 2;
        }

        if ($this->request->getGet("q")) {
          $q = trim($this->request->getGet("q"));
          $students = $model->getStudentsByName($q, $state)->paginate(config("G3stor")->regPerPage);
          $data["students"] = $students;
          $data["countStudents"] =  count($students);
          $data["query"] = $q;
          $data["pager"] = $model->pager;
        } else {
          $data["students"] =  $model->getStudents($state)->paginate(config("G3stor")->regPerPage);
          $data["countStudents"] = $model->countStudents($state)["contar_estudiantes_activos($state)"];
          $data["query"] = "";
          $data["pager"] = $model->pager;
        };


        return view("student/list", $data);
    }

    public function create()
    {
      $model = model("CountriesModel");
      $modelCivil = model("VCivilStatusModel");
      $modelTDocument = model("VDocumentTypesModel");
      $modelGenres = model("VGenresModel");
      $modelPrograms = model("ProgramsModel");

    
      return view('student/create', [
        "countries" => $model->findAll(),
        "civilStatus" => $modelCivil->getCivilStatus(1)->getResult(),
        "documentTypes" => $modelTDocument->getDocumentTypes(1)->getResult(),
        "genres" => $modelGenres->getGenres(1)->getResult(),
        "programs" => $modelPrograms->getPrograms(1)->getResult()
      ]);
    }
}
