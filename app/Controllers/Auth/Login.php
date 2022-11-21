<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;


class Login extends BaseController
{
  public function index()
  {
    if(!session()->is_logged){
      return view("Auth/Login");
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

    // $email = trim($this->request->getVar("email"));
    // $password = trim($this->request->getVar("password"));

    // $model = model("UsersModel");
    // if(!$user = $model->getUserBy("email", $email)) {
    //   return redirect()->back()->with("msg", [
    //     "type" => "is-danger",
    //     "body" => "Este usuario no se encuentra registrado"
    //   ]);
    // }

    // if(!password_verify($password, $user->password)){
    //   return redirect()->back()->with("msg", [
    //     "type" => "is-danger",
    //     "body" => "Credenciales invalidas"
    //   ]);
    // }

    session()->set([
      "id_user" => $this->request->getVar("email"),
      "username" => $this->request->getVar("email"),
      "is_logged" => true
    ]);

    return redirect()->route("home")->with("msg", [
      "type" => "is-success",
      "body" => "Bienvendo" 
    ]);


  }

  public function signout(){
    session()->destroy();
    return redirect()->route("login");
  }
}
