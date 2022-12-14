<?php

namespace App\Entities;
use CodeIgniter\Entity;

class LendBook extends Entity {

  protected $datos = ["created_at", "updated_at"];
  public function getSeeMoreLine($id)
  {
    return base_url(route_to("lend_details", $id));
  }
  

}