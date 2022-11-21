<?php

namespace App\Entities;

use CodeIgniter\Entity;


class Autor extends Entity
{

  public function getEditLine($id)
  {
    return base_url(route_to("autors_edit", $id));
  }

  public function getDeleteLine($id)
  {
    return base_url(route_to("autors_delete", $id));
  }

  public function __toString()
  {
    return $this->id_autor . "|" . $this->nombre . "|" . $this->id_pais . "|" . $this->estado;
  }
}
