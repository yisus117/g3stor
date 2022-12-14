<?php

namespace App\Entities;

use CodeIgniter\Entity;


class Book extends Entity
{
  public function getEditLine($id)
  {
    return base_url(route_to("books_edit", $id));
  }
  public function getDeleteLine($id)
  {
    return base_url(route_to("books_delete", $id));
  }

  public function getEditorial() {
    $model = model("EditorialsModel");
    return  $model->where("id_editorial", $this->id_editorial)->first();
  
  }

}
