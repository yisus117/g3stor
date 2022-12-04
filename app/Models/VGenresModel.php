<?php

namespace App\Models;

use App\Entities\Editorial;
use CodeIgniter\Model;

class VGenresModel extends Model
{
  protected $table            = 'v_genero';
  protected $primaryKey       = 'id_dparam';
  protected $useAutoIncrement = true;


  protected $returnType       = "object";
  protected $useSoftDeletes   = false;

  protected $allowedFields    = ["id_param", "nombre", "abreviado", "estado"];

  // Dates
  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';


  public function getGenres($state)
  {
    return $this
      ->select("*")->where("estado" , $state)->get();
  }

}

