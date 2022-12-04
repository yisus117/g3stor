<?php

namespace App\Controllers\Book;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;

class Editorials extends BaseController
{
  public function index()
  {
    $model = model("EditorialsModel");
    if ($this->request->getGet("active") != "2") {
      $state = 1;
    } else {
      $state = 2;
    }



    if ($this->request->getGet("q")) {
      $q = trim($this->request->getGet("q"));
      $editorial = $model->getEditorialByName($q, $state)->paginate(config("G3stor")->regPerPage);
      $data["editorials"] = $editorial ;
      $data["countEditorials"] =  count($editorial);
      $data["query"] = $q;
      $data["pager"] = $model->pager;
    } else {
      $data["editorials"] =  $model->getEditorials($state)->paginate(config("G3stor")->regPerPage);
      $data["countEditorials"] = $model->countEditorials($state)["contar_editoriales_activos($state)"];
      $data["query"] = "";
      $data["pager"] = $model->pager;
    }


    return view("book/editorials/editorials", $data);
  }


  public function create()
  {
    $model = model("CountriesModel");

    return view('book/editorials/editorials_create', [
      "countries" => $model->findAll()
    ]);
  }

  public function store()
  {

    if (!$this->validate([
      "name" => "required|max_length[200]",
      "id_country" => "required|is_not_unique[paises.id_pais]",
    ])) {
      return redirect()->back()->withInput()->with("msg", [
        "type" => "is-danger",
        "body" => "Tienes campos incorrectos"
      ])->with("errors", $this->validator->getErrors());
    }

    $model = model("EditorialsModel");
    $model->save([
      "nombre" => trim($this->request->getVar("name")),
      "id_pais" => trim($this->request->getVar("id_country"))
    ]);

    return redirect("editorials")->with("msg", [
      "type" => "success",
      "body" => "La editorial fue agregada exitosamente"
    ]);
  }


  public function edit(string $id)
  {
    $model = model("EditorialsModel");
    if (!$editorial = $model->find($id)) {
      throw PageNotFoundException::forPageNotFound();
    }
    $cModel = model("CountriesModel");

    return view("book/editorials/editorials_edit", [
      "editorial" => $editorial,
      "countries" => $cModel->findAll()
    ]);
  }


  public function update()
  {

    if (!$this->validate([
      "name" => "required|max_length[200]",
      "id_country" => "required|is_not_unique[paises.id_pais]",
      "id_editorial" => "required|is_not_unique[editoriales.id_editorial]",
      "state" => "required"
    ])) {
      return redirect()->back()->withInput()->with("msg", [
        "type" => "danger",
        "body" => "Tienes campos incorrectos"
      ])->with("errors", $this->validator->getErrors());
    }

    $newIdEditorial = trim($this->request->getVar("id_editorial"));
    $newName = trim($this->request->getVar("name"));
    $newIdCountry = trim($this->request->getVar("id_country"));
    $newState = trim($this->request->getVar("state"));

    $model = model("EditorialsModel");

    $editorial = $model->find($newIdEditorial);
    
    if ($newName == $editorial->nombre && $newIdCountry == $editorial->id_pais && $newState == $editorial->estado) {
      return redirect("editorials")->with("msg", [
        "type" => "secondary",
        "body" => "Sin cambios"
      ]);
    }
    $string = implode(',', $editorial->toRawArray());
    $editorial = explode(',', $string);
    $model->oldInfo = $editorial;

    $model->save([
      "id_editorial" => $newIdEditorial,
      "nombre" =>  $newName,
      "id_pais" => $newIdCountry ,
      "estado" => $newState,
    ]);

    return redirect("editorials")->with("msg", [
      "type" => "info",
      "body" => "La Editorial fue actualizada exitosamente"
    ]);
  }


  public function delete(string $id)
  {
    $model = model("EditorialsModel");
    $editorial = $model->find($id);
    $string = implode(',', $editorial->toRawArray());
    $editorial = explode(',', $string);
    $model->oldInfo = $editorial;
    
  
    $model->deleteEditorial($id);

    return redirect("editorials")->with("msg", [
      "type" => "danger",
      "body" => "La editorial fue eliminada"
    ]);
  }
}
