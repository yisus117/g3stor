<?php

namespace App\Filters;

use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class Auth implements FilterInterface
{
  public function before(RequestInterface $request, $arguments = [])
  {
    session()->start();
    if (!session()->is_logged) {
      return redirect()->route("login")->with("msg", [
        "type" => "danger",
        "body" => "Para acceder al dashboard debes logearte"
      ]);
    }
    $model = model("UsersModel");
    if (!$user = $model->getUserBy("correo", session()->id_user)) {
      session()->destroy();
      return redirect()->route("login")->with("msg", [
        "type" => "danger",
        "body" => "El usuario actualmente no esta disponible"
      ]);
    }
    if (!in_array($user->getRole()->nombre_grupo, $arguments)) {
      throw PageNotFoundException::forPageNotFound();
    }
  }



  public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
  {
    // Do something here
  }
}
