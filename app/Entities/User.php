<?php

namespace App\Entities;
use CodeIgniter\Entity;

class User extends Entity {
  protected $datos = ["created_at", "updated_at"];

  protected function setPassword(string $password){
    $this->attributes["password"] = password_hash($password, PASSWORD_DEFAULT);
  }

  public function generateUsername(){
    $this-> attributes["username"] = explode(" " , $this-> name)[0] . explode(" ", $this->surname)[0];
  }

  public function getRole() {
    $model = model("GroupsModel");
    return  ($model->where("id_grupo", $this->id_grupo)->first());
  }


}

