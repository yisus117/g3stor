<?php

namespace App\Entities;
use CodeIgniter\Entity;


class Student extends Entity
{
  public function getEditLine($id)
  {
    return base_url(route_to("student_edit", $id));
  }

  public function getDeleteLine($id)
  {
    return base_url(route_to("student_delete", $id));
  }

 
}
