<?php

namespace App\Entities;
use CodeIgniter\Entity;

class User extends Entity {
  protected $datos = ["created_at", "updated_at"];

  

  public function getRole() {
    $model = model("GroupsModel");
    return  ($model->where("id_grupo", $this->id_grupo)->first());
  }

  public function getEditLine($id)
  {
    return base_url(route_to("users_edit", $id));
  }




}

