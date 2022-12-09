<?php

namespace App\Controllers\Book;

use App\Controllers\BaseController;
use CodeIgniter\Exceptions\PageNotFoundException;
use Exception;

class Editorials extends BaseController
{
  public function index()
  {
    $model = model("VEditorials");

    $q = $this->request->getGet("q");

    if ($this->request->getGet("activos") === "on") {
      $state = 1;
    } else {
      $state = 2;
    }

    if ($q or $q === "") {
      $field = trim($this->request->getGet("field"));
      $editorials = $model->getEditorialBy($field, $q, $state)->paginate(config("G3stor")->regPerPage);
      $data["editorials"] = $editorials;
      $data["countEditorials"] =  count($editorials);
    } else {
      $data["editorials"] =  $model->getEditorials(1)->paginate(config("G3stor")->regPerPage);
      $data["countEditorials"] = $model->countEditorials(1);
    };

    $data["query"] = $q ?? "";
    $data["pager"] = $model->pager;
    $data["fields"] = $model->getFields();

    return view("book/editorials/editorials", $data);
  }


  public function create()
  {
    $model = model("CountriesModel");

    return view('book/editorials/editorials_create', [
      "countries" => $model->where("estado", 1)->findAll()
    ]);
  }

  public function store()
  {

    if (!$this->validate([
      "name" => "required|max_length[100]",
      "id_country" => "required|is_not_unique[paises.id_pais]",
    ])) {
      session()->setFlashdata("status_text", "Existe uno o varios errores con el registro");
      return redirect()->back()->withInput()->with("status_icon", "error")
        ->with("status", 'Disculpe, revise la informacion ingresada')->with("errors", $this->validator->getErrors());
    }

    $model = model("EditorialsModel");
    $model->insertEditorial(
      trim($this->request->getVar("name")),
      trim($this->request->getVar("id_country"))
    );


    session()->setFlashdata("status", "Editorial agregada correctamente");
    return redirect("editorials")->with("status_icon", "success");
  }


  public function edit(string $id)
  {
    $model = model("EditorialsModel");
    if (!$editorial = $model->where("estado != ", 0)->find($id)) {
      throw PageNotFoundException::forPageNotFound();
    }
    $cModel = model("CountriesModel");

    return view("book/editorials/editorials_edit", [
      "editorial" => $editorial,
      "countries" => $cModel->where("estado =", 1)->findAll()
    ]);
  }


  public function update()
  {

    if (!$this->validate([
      "name" => "required|max_length[100]",
      "id_country" => "required|is_not_unique[paises.id_pais]",
      "id_editorial" => "required|is_not_unique[editoriales.id_editorial]",
      "state" => "required"
    ])) {
      session()->setFlashdata("status_text", "Existe uno o varios errores con el registro");
      return redirect()->back()->withInput()->with("status_icon", "error")
        ->with("status", 'Disculpe, revise la informacion ingresada')->with("errors", $this->validator->getErrors());
    }

    $newIdEditorial = trim($this->request->getVar("id_editorial"));
    $newName = trim($this->request->getVar("name"));
    $newIdCountry = trim($this->request->getVar("id_country"));
    $newState = trim($this->request->getVar("state"));

    $model = model("EditorialsModel");

    $editorial = $model->find($newIdEditorial);

    if ($newName == $editorial->Nombre && $newIdCountry == $editorial->id_pais && $newState == $editorial->estado) {
      session()->setFlashdata("status", "No hubo cambios");
      return redirect("editorials")->with("status_icon", "info");
    }
    $string = implode(',', $editorial->toRawArray());
    $editorial = explode(',', $string);
    $model->oldInfo = $editorial;

    $model->updateEditorial(
      $newIdEditorial,
      $newName,
      $newIdCountry,
      $newState
    );

    session()->setFlashdata("status", "Editorial actualizada correctamente");
    return redirect("editorials")->with("status_icon", "success");
  }


  public function delete(string $id)
  {
    $model = model("EditorialsModel");

    try {
      $model->deleteEditorial($id);
    } catch (Exception $e) {
      echo $e;
    }

    session()->setFlashdata("status", "Editorial fue Eliminada correctamente");
    redirect("editorials")->with("status_icon", "success");
    return;
  }
}
