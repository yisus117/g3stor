<?php

namespace App\Controllers\Auth;

use App\Controllers\BaseController;
use App\Entities\User;
use App\Entities\UserInfo;

class Register extends BaseController
{

  protected $configs;
  public function __construct()
  {
    $this->configs = config("Blog");
  }


  public function index()
  {
    $model = model("CountriesModel");
    

    return view("Auth/Register", [
      "countries" => $model->findAll()
    ]);
  }

  public function store()
  {
    
    $validation = service("validation");
    $validation->setRules([
      "name" => "required|alpha_space",
      "surname" => "required|alpha_space",
      "email" => "required|valid_email|is_unique[users.email]",
      "id_country" => "required|is_not_unique[countries.id_country]",
      "password" => "required|matches[c-password]"
    ]);

    if(!$validation->withRequest($this->request)->run()){
     

      return redirect()->back()->withInput()->with("errors", $validation->getErrors());
    }

    $user = new User($this->request->getPost());
    $user->generateUsername();

    $model = model("UsersModel");
    $model->withGroup($this->configs->defaultGroupUsers);


    // $userInfo = new UserInfo($this->request->getPost());
    // $model->addInfoUser($userInfo);

    $model->save($user);

    return redirect()->route("login")->with("msg", [
      "type" => "is-success",
      "body" => "Usuario registrado con exito"
    ]);
  }
}
