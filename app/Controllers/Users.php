<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Entities\User;
use CodeIgniter\Exceptions\PageNotFoundException;
use Exception;

class Users extends BaseController
{

  public function index()
  {
    $model = model("UsersModel");


    $data["users"] =  $model->getUsers()->paginate(config("G3stor")->regPerPage);
    $data["countUsers"] = $model->countUsers(1);


    $data["query"] = $q ?? "";
    $data["pager"] = $model->pager;
    $data["fields"] = $model->getFields();

    return view('user/list', $data);
  }

  public function create()
  {
    $model = model("GroupsModel");

    return view('user/create', [
      "groups" => $model->getGroups(1)->get()->getResult()
    ]);
  }


  public function store()
  {


    if (!$this->validate([
      "first_name" => "required|max_length[50]",
      "second_name" => "max_length[50]",
      "first_lastname" => "required|max_length[50]",
      "second_lastname" => "max_length[50]",
      "email" => "required|valid_email|is_unique[usuarios.correo]|max_length[120]",
      "password" => "required|matches[rep_password]|min_length[6]",
      "role" => "required|is_not_unique[grupos.id_grupo]|max_length[50]",
    ])) {
      session()->setFlashdata("status_text", "tiene uno o varios errores con el registro");
      return redirect()->back()->withInput()->with("status_icon", "error")
        ->with("status", 'Disculpe, revise la informacion ingresada')->with("errors", $this->validator->getErrors());
    }
    $model = model("UsersModel");

    $model->insertUser(
      trim($this->request->getPost("first_name")),
      trim($this->request->getPost("second_name")),
      trim($this->request->getPost("first_lastname")),
      trim($this->request->getPost("second_lastname")),
      trim($this->request->getPost("email")),
      trim($this->request->getPost("password")),
      trim($this->request->getPost("role"))
    );


    session()->setFlashdata("status", "Usuario agregado correctamente");
    return redirect("users")->with("status_icon", "success");
  }

  public function edit(string $id)
  {
    $model = model("UsersModel");
    if (!$user = $model->where("activo !=", 0)->find($id)) {
      throw PageNotFoundException::forPageNotFound();
    }
    $cModel = model("GroupsModel");

    return view("user/edit", [
      "user" => $user,
      "groups" => $cModel->where("estado", 1)->findAll()
    ]);
  }


  public function update()
  {
    if (!$this->validate([
      "id_user" => "required|is_not_unique[usuarios.id_usuario]",
      "first_name" => "required|max_length[50]",
      "second_name" => "max_length[50]",
      "first_lastname" => "max_length[50]",
      "second_lastname" => "max_length[50]",
      "email" => "required|valid_email",
      "role" => "max_length[50]",
      "state" => "required|max_length[200]"
    ])) {
      dd($this->validator->getErrors());
      session()->setFlashdata("status_text", "Existe uno o varios errores con el registro");
      return redirect()->back()->withInput()->with("status_icon", "error")
        ->with("status", 'Disculpe, revise la informacion ingresada')->with("errors", $this->validator->getErrors());
    }

    $email = trim($this->request->getVar("email"));

    if (null !== $this->request->getVar("old_password")) {
      $oldPassword = $this->request->getVar("old_password");
    } else {
      $oldPassword = "";
    }

    $model = model("UsersModel");
    $user = $model->getUserBy("correo", $email);


    if ($this->request->getPost("menu_check") == "on") {
      if (!$this->validate([
        "new_password" => "required|matches[rep_new_password]|min_length[6]"
      ])) {
        session()->setFlashdata("status_text", "Existe uno o varios errores contraseña");
        return redirect()->back()->withInput()->with("status_icon", "error")
          ->with("status", 'Disculpe, revise la informacion ingresada')->with("errors", $this->validator->getErrors());
      }

      if ($user) {
        if (!($oldPassword === $user->contrasena)) {
          session()->setFlashdata("status_text", "La contraseña es incorrecta");
          return redirect()->back()->withInput()->with("status_icon", "error")
            ->with("status", 'Disculpe, revise la informacion ingresada')->with("errors", $this->validator->getErrors());
        } else {
          $pass = trim($this->request->getVar("new_password"));
        }
      }
    } else {
      if (trim($this->request->getVar("first_name")) == $user->primer_nombre && trim($this->request->getVar("second_name")) == $user->segundo_nombre && trim($this->request->getVar("first_lastname")) == $user->primer_apellido && trim($this->request->getVar("second_lastname")) == $user->segundo_apellido && trim($this->request->getVar("email")) == $user->correo && trim($this->request->getVar("role")) == $user->id_grupo && trim($this->request->getVar("state")) == $user->activo) {
        session()->setFlashdata("status", "No se realizarón cambios");
        return redirect("users")->with("status_icon", "info");
      }
      $pass = $user->contrasena;
    }

    $model->save([
      "id_usuario" => trim($this->request->getVar("id_user")),
      "primer_nombre" => trim($this->request->getVar("first_name")),
      "segundo_nombre" => trim($this->request->getVar("second_name")),
      "primer_apellido" => trim($this->request->getVar("first_lastname")),
      "segundo_apellido" => trim($this->request->getVar("second_lastname")),
      "correo" => trim($this->request->getVar("email")),
      "contrasena" => $pass,
      "id_grupo" => trim($this->request->getVar("role")),
      "activo" => trim($this->request->getVar("state")),
    ]);

    session()->setFlashdata("status", "Usuario actualizado correctamente");
    return redirect("users")->with("status_icon", "success");
  }

  public function delete(string $id)
  {
    
    try {
      $model = model("UsersModel");
      $model->deleteUser($id);
    } catch (Exception $e) {
      echo $e;
    }

    session()->setFlashdata("status", "usuario fue Eliminado correctamente");
    redirect("users")->with("status_icon", "success");
    return;
  }
}
