<?php

namespace App\Controllers\Home;

use App\Controllers\BaseController;


class Dashboard extends BaseController
{
  public function index()
  {
    $state = 1;
    $editorial = model("EditorialsModel");
    $books = model("BooksModel");
    $autors = model("AutorsModel");
    $students = model("StudentsModel");

    return view("home/dashboard", [
      "countEditorials" =>  $editorial->countEditorials($state)["contar_editoriales_activos($state)"],
      "countBooks" =>  $books->countBooks($state)["contar_libros_activos($state)"],
      "countAutors" =>  $autors->countAutors($state)["contar_autores_activos($state)"],
      "countStudents" =>  $students->countStudents($state)["contar_estudiantes_activos($state)"],
    ]);
  }
}
