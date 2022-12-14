<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
$hash = \Config\Services::hash();

class Login extends BaseController
{
  public function index()
  {
    if (!session()->is_logged) {
      return view("auth/login");
    }

    return redirect()->route("home");
  }

  public function signin()
  {
    if (!$this->validate([
      "email" => "required|valid_email",
      "password" => "required"
    ])) {
      return redirect()->back()->with("errors", $this->validator->getErrors())->withInput();
    }

    $email = trim($this->request->getVar("email"));
    $password = trim($this->request->getVar("password"));

    $model = model("UsersModel");
    if (!$user = $model->getUserBy("correo", $email)) {
      session()->setFlashdata("status_text", "El correo ingresado no se encuentra registrado");
      return redirect()->back()->withInput()->with("status_icon", "error")
        ->with("status", 'Disculpe, revise la informacion ingresada')->with("errors", $this->validator->getErrors());
    }

    // if(!password_verify($password, $user->contrasena)){
    if(!($password === $user->contrasena)){
      session()->setFlashdata("status_text", "La contraseña es incorrecta");
      return redirect()->back()->withInput()->with("status_icon", "error")
        ->with("status", 'Disculpe, revise la informacion ingresada')->with("errors", $this->validator->getErrors());
    }


    session()->set([
      "id_user" => $this->request->getVar("email"),
      "user_name" => $user->primer_nombre ." ".$user->primer_apellido,
      "is_logged" => true,
      "user_role" => $user->getRole()->nombre_grupo,
      "id" => $user->id_usuario
    ]);

    session()->setFlashdata("status", "Bienvenido nuevamente");
    return redirect("home")->with("status_icon", "success");
  }

  public function signout()
  {
    session()->destroy();
    return redirect()->route("login");
  }
}
