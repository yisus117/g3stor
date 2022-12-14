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

    // dd( $model->getLend(1)->get()->getResult());

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
    $bModel = model("BooksModel");


    $data["students"] = $model->getStudents(1)->get()->getResult();
    $data["books"] = $bModel->getBooksForLend(1)->get()->getResult();


    return view('lend/create', $data);
  }

  public function store()
  {

    if (!$this->validate([
      "id_student" => "required|is_not_unique[estudiantes.id_estudiante]",
      "id_book" => "required|is_not_unique[libros.id_libros]",

    ])) {
      session()->setFlashdata("status_text", "Existe uno o varios errores con el registro");
      return redirect()->back()->withInput()->with("status_icon", "error")
        ->with("status", 'Disculpe, revise la informacion ingresada')->with("errors", $this->validator->getErrors());
    }

    $id_student = trim($this->request->getVar("id_student"));
    $id_book = trim($this->request->getVar("id_book"));
    $id_user = session()->get("id");
    $model = model("LendBooksModel");

    $model->idLibro = $id_book;
    // Obtener la fecha actual
    $fecha_actual = date('Y-m-d');

    // Sumar tres días a la fecha actual
    $fecha_actual_mas_tres_dias = strtotime('+3 days', strtotime($fecha_actual));

    // Convertir la fecha resultante a un formato legible
    $fecha_resultante = date('Y-m-d', $fecha_actual_mas_tres_dias);

    // Imprimir la fecha resultante
    echo $fecha_resultante;

    $model->save([
      "id_estudiante" =>  $id_student,
      "usuario_creador" => $id_user,
      "fecha_prestamo" => $fecha_actual,
      "fecha_devolucion" => $fecha_resultante
    ]);

    session()->setFlashdata("status", "Prestamo Realizado correctamente");
    return redirect("lend")->with("status_icon", "success");
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




  public function delete($id, $libro)
  {

    try {
      $model = model("LendBooksModel");
      $model->deleteLend($id);
    } catch (Exception $e) {
      echo $e;
    }
    $Bmodel = model("BooksModel");
    $LBDmodel = model("LendBooksDetModel");

    $Bmodel->borrowBook($libro, 1);
    // $LBDmodel->repayBook($id);
    try {
      $this->db->set('estado', 2)
        ->where('id_prestamo', $id)
        ->update('prestamos_det');
    } catch (Exception $e) {
      dd($e);
    }

    session()->setFlashdata("status", "El libro fue devuelto");
    redirect("lend")->with("status_icon", "success");
    return;
  }
}
