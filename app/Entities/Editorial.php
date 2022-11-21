<?php

namespace App\Entities;

use CodeIgniter\Entity;


class Editorial extends Entity
{

  public function getEditLine($id)
  {
    return base_url(route_to("editorial_edit", $id));
  }

  public function getDeleteLine($id)
  {
    return base_url(route_to("editorial_delete", $id));
  }

  public function __toString()
  {
    return $this->id_editorial . "|" . $this->nombre . "|" . $this->id_pais . "|" . $this->estado;
  }
}
