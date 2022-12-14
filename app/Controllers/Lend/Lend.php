<?php

namespace App\Controllers\Lend;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use Exception;

class Lend extends BaseController
{
  public function index()
  {
    $model = model("LendBooksModel");

    $q = $this->request->getGet("q");

    if ($this->request->getGet("activos") === "on") {
      $state = 1;
    } else {
      $state = 2;
    }

    if ($q or $q === "") {
      $field = trim($this->request->getGet("field"));
      $lend = $model->getLendBy($field, $q, $state)->paginate(config("G3stor")->regPerPage);
      $data["lend"] = $lend;
      $data["countLend"] =  count($lend);
    } else {
      $data["lend"] =  $model->getLend(1)->paginate(config("G3stor")->regPerPage);
      $data["countLend"] = $model->countLend(1);
    };

    $data["query"] = $q ?? "";
    $data["pager"] = $model->pager;
    $data["fields"] = $model->getFields();

    return view('lend/list', $data);
  }



  public function create()
  {
    $model = model("VStudents");
    $data = [];
    $doc = $this->request->getGet("doc");

    
    if($doc){
      $student = $model->getStudentsByDoc($doc, 1)->first();
      $data["student"] = $student;
      $data["search"] = $doc;
     }

    return view('lend/create', $data);
  }

  public function store()
  {

    if (!$this->validate([
      "first_name" => "required|max_length[50]",
      "second_name" => "max_length[50]",
      "first_lastname" => "required|max_length[50]",
      "second_lastname" => "max_length[50]",
      "pseudonym" => "max_length[50]",
      "address" => "max_length[200]",
      "id_country" => "required|is_not_unique[paises.id_pais]",
    ])) {
      session()->setFlashdata("status_text", "Existe uno o varios errores con el registro");
      return redirect()->back()->withInput()->with("status_icon", "error")
        ->with("status", 'Disculpe, revise la informacion ingresada')->with("errors", $this->validator->getErrors());
    }

    $firstName = trim($this->request->getVar("first_name"));
    $secondName = trim($this->request->getVar("second_name"));
    $firstLastName = trim($this->request->getVar("first_lastname"));
    $secondLastName = trim($this->request->getVar("second_lastname"));
    $pseudonym = trim($this->request->getVar("pseudonym"));
    $address = trim($this->request->getVar("address"));
    $idCountry = trim($this->request->getVar("id_country"));


    $model = model("AutorsModel");
    $model->save([
      "primer_nombre" =>  $firstName,
      "segundo_nombre" => $secondName,
      "primer_apellido" => $firstLastName,
      "segundo_apellido" => $secondLastName,
      "seudonimo" => $pseudonym,
      "direccion" => $address,
      "id_pais" => $idCountry,
    ]);

    session()->setFlashdata("status", "Autor agregado correctamente");
    return redirect("autors")->with("status_icon", "success");
  }


  public function edit(string $id)
  {
    $model = model("AutorsModel");
    if (!$autor = $model->where("estado !=", 0)->find($id)) {
      throw PageNotFoundException::forPageNotFound();
    }
    $cModel = model("CountriesModel");

    return view("book/autors/autors_edit", [
      "autor" => $autor,
      "countries" => $cModel->where("estado", 1)->findAll()
    ]);
  }

  public function update()
  {


    if (!$this->validate([
      "id_autor" => "required|is_not_unique[autores.id_autor]",
      "first_name" => "required|max_length[50]",
      "second_name" => "max_length[50]",
      "first_lastname" => "max_length[50]",
      "second_lastname" => "max_length[50]",
      "pseudonym" => "max_length[50]",
      "address" => "required|max_length[200]",
      "id_country" => "required|is_not_unique[paises.id_pais]",
    ])) {
      session()->setFlashdata("status_text", "Existe uno o varios errores con el registro");
      return redirect()->back()->withInput()->with("status_icon", "error")
        ->with("status", 'Disculpe, revise la informacion ingresada')->with("errors", $this->validator->getErrors());
    }
    $idAutor = trim($this->request->getVar("id_autor"));
    $firstName = trim($this->request->getVar("first_name"));
    $secondName = trim($this->request->getVar("second_name"));
    $firstLastName = trim($this->request->getVar("first_lastname"));
    $secondLastName = trim($this->request->getVar("second_lastname"));
    $pseudonym = trim($this->request->getVar("pseudonym"));
    $address = trim($this->request->getVar("address"));
    $idCountry = trim($this->request->getVar("id_country"));
    $state = trim($this->request->getVar("state"));


    $model = model("AutorsModel");

    $autor = $model->find($idAutor);

    if ($firstName == $autor->primer_nombre && $secondName == $autor->segundo_nombre && $firstLastName == $autor->primer_apellido && $secondLastName == $autor->segundo_apellido && $pseudonym == $autor->seudonimo && $address == $autor->direccion && $idCountry == $autor->id_pais && $state == $autor->estado) {
      return redirect("autors")->with("msg", [
        "type" => "secondary",
        "body" => "Sin cambios"
      ]);
    }
    $string = implode(',', $autor->toRawArray());
    $autor = explode(',', $string);
    $model->oldInfo = $autor;

    $model->save([
      "id_autor" => $idAutor,
      "primer_nombre" =>  $firstName,
      "segundo_nombre" => $secondName,
      "primer_apellido" => $firstLastName,
      "segundo_apellido" => $secondLastName,
      "seudonimo" => $pseudonym,
      "direccion" => $address,
      "id_pais" => $idCountry,
      "estado" => $state,
    ]);

    session()->setFlashdata("status", "Autor actualizado correctamente");
    return redirect("autors")->with("status_icon", "success");
  }




  public function delete(string $id)
  {
    
    try {
      $model = model("AutorsModel");
      $model->deleteAutor($id);
    } catch (Exception $e) {
      echo $e;
    }

    session()->setFlashdata("status", "Autor fue Eliminado correctamente");
    redirect("autors")->with("status_icon", "success");
    return;
  }
}
