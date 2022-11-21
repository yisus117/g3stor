<?php

namespace App\Entities;
use CodeIgniter\Entity;


class Book extends Entity {


  public function getEditLine($id){
    return base_url(route_to("book_edit", $id));
  }
  public function getDeleteLine($id)
  {
    return base_url(route_to("book_delete", $id));
  }

}