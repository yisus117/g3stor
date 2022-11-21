<?php

namespace App\Controllers\Book;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Autors extends BaseController
{
  public function index()
  {
    $model = model("AutorsModel");
    if ($this->request->getGet("active") != "2") {
      $state = 1;
    } else {
      $state = 2;
    }

    if ($this->request->getGet("q")) {
      $q = trim($this->request->getGet("q"));
      $editorial = $model->getAutorsByName($q, $state)->paginate(config("G3stor")->regPerPage);
      $data["autors"] = $editorial;
      $data["countAutors"] =  count($editorial);
      $data["query"] = $q;
      $data["pager"] = $model->pager;
    } else {
      $data["autors"] =  $model->getAutors($state)->paginate(config("G3stor")->regPerPage);
      $data["countAutors"] = $model->countAutors($state)["contar_autores_activos($state)"];
      $data["query"] = "";
      $data["pager"] = $model->pager;
    }


    return view('book/autors/autors', $data);
  }
  public function create()
  {
    $model = model("CountriesModel");

    return view('book/autors/autors_create', [
      "countries" => $model->findAll()
    ]);
  }

  public function store()
  {

    if (!$this->validate([
      "first_name" => "required|max_length[50]",
      "second_name" => "max_length[50]",
      "first_lastname" => "required|max_length[50]",
      "second_lastname" => "max_length[50]",
      "pseudonym" => "max_length[50]",
      "address" => "required|max_length[200]",
      "id_country" => "required|is_not_unique[paises.id_pais]",
    ])) {
      return redirect()->back()->withInput()->with("msg", [
        "type" => "warning",
        "body" => "Tienes campos incorrectos"
      ])->with("errors", $this->validator->getErrors());
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

    return redirect("autors")->with("msg", [
      "type" => "success",
      "body" => "La categoria fue agregada exitosamente"
    ]);
  }


  public function edit(string $id)
  {
    $model = model("AutorsModel");
    if (!$autor = $model->find($id)) {
      throw PageNotFoundException::forPageNotFound();
    }
    $cModel = model("CountriesModel");

    return view("book/autors/autors_edit", [
      "autor" => $autor,
      "countries" => $cModel->findAll()
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
      return redirect()->back()->withInput()->with("msg", [
        "type" => "warning",
        "body" => "Tienes campos incorrectos"
      ])->with("errors", $this->validator->getErrors());
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

    return redirect("autors")->with("msg", [
      "type" => "info",
      "body" => "La categoria fue actualizada exitosamente"
    ]);
  }




  public function delete(string $id)
  {
    $model = model("AutorsModel");
    $autor = $model->find($id);
    $string = implode(',', $autor->toRawArray());
    $autor = explode(',', $string);
    $model->oldInfo = $autor;

    $model->deleteAutor($id);

    return redirect("autors")->with("msg", [
      "type" => "danger",
      "body" => "La categoria fue eliminada"
    ]);
  }
}
