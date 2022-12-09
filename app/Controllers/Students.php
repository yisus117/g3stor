<?php

namespace App\Controllers;

use CodeIgniter\Exceptions\PageNotFoundException;
use Error;
use Exception;

class Students extends BaseController
{
  public function index()
  {
    $model = model("VStudentsModel");

    $fields = $model->getFields();
    $q = $this->request->getGet("q");

    if ($this->request->getGet("activos") === "on") {
      $state = 1;
    } else {
      $state = 2;
    }

    if ($q or $q === "") {
      $field = trim($this->request->getGet("field"));
      $students = $model->getStudentsByName($field, $q, $state)->paginate(config("G3stor")->regPerPage);
      $data["students"] = $students;
      $data["countStudents"] =  count($students);
    } else {
      $data["students"] =  $model->getStudents(1)->paginate(config("G3stor")->regPerPage);
      $data["countStudents"] = $model->countStudents(1);
    };
    
    $data["query"] = $q ?? "";
    $data["pager"] = $model->pager;
    $data["fields"] = $fields;


    return view("student/list", $data);
  }

  public function create()
  {
    $modelCivil = model("VCivilStatusModel");
    $modelTDocument = model("VDocumentTypesModel");
    $modelGenres = model("VGenresModel");
    $modelPrograms = model("ProgramsModel");


    return view('student/create', [
      "civilStatus" => $modelCivil->getCivilStatus(1)->getResult(),
      "documentTypes" => $modelTDocument->getDocumentTypes(1)->getResult(),
      "genres" => $modelGenres->getGenres(1)->getResult(),
      "programs" => $modelPrograms->getPrograms(1)->getResult()
    ]);
  }


  public function store()
  {

    if (!$this->validate([
      "first_name" => "required|max_length[50]",
      "second_name" => "max_length[50]",
      "first_lastname" => "required|max_length[50]",
      "second_lastname" => "max_length[50]",
      "id_doc_type" => "required|is_not_unique[v_tipo_documento.id_dparam]",
      "document" => "required|max_length[15]|is_unique[estudiantes.documento]",
      "id_civil" => "required|is_not_unique[v_estado_civil.id_dparam]",
      "id_genre" => "required|is_not_unique[v_genero.id_dparam]",
      "id_program" => "required|is_not_unique[programas.id_programa]",
      "phone" => "required|max_length[15]",
      "email" => "required|valid_email",
      "address" => "required|max_length[150]",
    ])) {
         session()->setFlashdata("status_text", "tiene uno o varios errores con el registro");
      return redirect()->back()->withInput()->with("status_icon", "error")
        ->with("status", 'Disculpe, revise la informacion ingresada')->with("errors", $this->validator->getErrors());
    }

    if (!$this->validate([
      "email" => "required|valid_email|is_unique[estudiantes.correo]",
    ])) {
      session()->setFlashdata("status_text", "El correo ingresado ya esta siendo utilizado por otro estudiante");
      return redirect()->back()->withInput()->with("status_icon", "error")
        ->with("status", 'Disculpe, El correo "' .  trim($this->request->getPost("email")) . '" ya existe')->with("errors", $this->validator->getErrors());
    }


    try {
      $model = model("StudentsModel");
      $model->insertStudent(
        trim($this->request->getPost("first_name")),
        trim($this->request->getPost("second_name")),
        trim($this->request->getPost("first_lastname")),
        trim($this->request->getPost("second_lastname")),
        trim($this->request->getPost("id_doc_type")),
        trim($this->request->getPost("document")),
        trim($this->request->getPost("id_genre")),
        trim($this->request->getPost("id_civil")),
        trim($this->request->getPost("address")),
        trim($this->request->getPost("email")),
        trim($this->request->getPost("id_program")),
        trim($this->request->getPost("phone")),
      );
    } catch (\Throwable $th) {
      //throw $th;
    }

    session()->setFlashdata("status", "Estudiante agregado correctamente");
    return redirect("students")->with("status_icon", "success");
  }


  public function edit(string $id)
  {
    $model = model("StudentsModel");
    if (!$student = $model->where("activo !=", 0)->find($id)) {
      throw PageNotFoundException::forPageNotFound();
    }
    $modelCivil = model("VCivilStatusModel");
    $modelTDocument = model("VDocumentTypesModel");
    $modelGenres = model("VGenresModel");
    $modelPrograms = model("ProgramsModel");

    return view("student/edit", [
      "student" => $student,
      "civilStatus" => $modelCivil->getCivilStatus(1)->getResult(),
      "documentTypes" => $modelTDocument->getDocumentTypes(1)->getResult(),
      "genres" => $modelGenres->getGenres(1)->getResult(),
      "programs" => $modelPrograms->getPrograms(1)->getResult()
    ]);
  }

  public function update()
  {
    if (!$this->validate([
      "id_student" => "required|max_length[5]|is_not_unique[estudiantes.id_estudiante]",
      "first_name" => "required|max_length[50]",
      "second_name" => "max_length[50]",
      "first_lastname" => "required|max_length[50]",
      "second_lastname" => "max_length[50]",
      "id_doc_type" => "required|is_not_unique[v_tipo_documento.id_dparam]",
      "document" => "required|max_length[15]",
      "id_civil" => "required|is_not_unique[v_estado_civil.id_dparam]",
      "id_genre" => "required|is_not_unique[v_genero.id_dparam]",
      "id_program" => "required|is_not_unique[programas.id_programa]",
      "phone" => "required|max_length[15]",
      "email" => "required|valid_email",
      "address" => "required|max_length[150]",
      "state" => "required",

    ])) {
      session()->setFlashdata("status_text", "tiene uno o varios errores con el registro");
      return redirect()->back()->withInput()->with("status_icon", "error")
        ->with("status", 'Disculpe, revise la informacion ingresada')->with("errors", $this->validator->getErrors());
    }

    $id_student = trim($this->request->getPost("id_student"));
    $first_name =  trim($this->request->getPost("first_name"));
    $second_name =  trim($this->request->getPost("second_name"));
    $first_lastname =   trim($this->request->getPost("first_lastname"));
    $second_lastname = trim($this->request->getPost("second_lastname"));
    $id_doc_type = trim($this->request->getPost("id_doc_type"));
    $document =   trim($this->request->getPost("document"));
    $id_genre =   trim($this->request->getPost("id_genre"));
    $id_civil =   trim($this->request->getPost("id_civil"));
    $address =  trim($this->request->getPost("address"));
    $email =  trim($this->request->getPost("email"));
    $id_program =  trim($this->request->getPost("id_program"));
    $phone =   trim($this->request->getPost("phone"));
    $state =  trim($this->request->getPost("state"));


    try {
      $model = model("StudentsModel");

      $student = $model->find($id_student);

      if ($first_name == $student->primer_nombre && $second_name == $student->segundo_nombre && $first_lastname == $student->primer_apellido && $second_lastname == $student->segundo_apellido && $id_doc_type == $student->tipo_documento && $document == $student->documento && $id_genre == $student->sexo && $id_civil == $student->estado_civil && $address == $student->direccion  && $email == $student->correo && $id_program == $student->id_programa && $phone == $student->telefono  && $state == $student->activo) {
        session()->setFlashdata("status", "No hubo cambios");
        return redirect("editorials")->with("status_icon", "info");
      }

      if ($email !== $student->correo) {

        if (!$this->validate([
          "email" => "required|valid_email|is_unique[estudiantes.correo]",
        ])) {
          session()->setFlashdata("status_text", "El correo ingresado ya esta siendo utilizado por otro estudiante");
          return redirect()->back()->withInput()->with("status_icon", "error")
            ->with("status", 'Disculpe, El correo "' . $email . '" ya existe')->with("errors", $this->validator->getErrors());
        }
      }
      if ($document !== $student->documento) {
        session()->setFlashdata("status_text", "Comuniquese con el administrador del sistema");
        return redirect("students")->with("status_icon", "error")
          ->with("status", "Disculpe, ocurrió un error al actulizar el registro");
      }


      $model->updateStudent(
        $id_student,
        $first_name,
        $second_name,
        $first_lastname,
        $second_lastname,
        $id_doc_type,
        $document,
        $id_genre,
        $id_civil,
        $address,
        $email,
        $id_program,
        $phone,
        $state,
      );
    } catch (Exception $e) {
      session()->setFlashdata("status_text", "Comuniquese con el administrador del sistema");
      return redirect("students")->with("status_icon", "error")
        ->with("status", "Disculpe, ocurrió un error al actulizar el registro");
    }

    session()->setFlashdata("status", "Estudiante actualizado correctamente");
    return redirect("students")->with("status_icon", "success");
  }


  public function delete($id)
  {
   
    $model = model("StudentsModel");

    try {
      $model->deleteStudent($id);
    } catch (Exception $e) {
      echo $e;
    }

    session()->setFlashdata("status", "Estudiante fue Eliminado correctamente");
    redirect("students")->with("status_icon", "success");
    return;
  }
}
