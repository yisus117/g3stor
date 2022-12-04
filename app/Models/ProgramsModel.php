<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgramsModel extends Model
{
    protected $table            = 'programas';
    protected $primaryKey       = 'id_programa';

    protected $returnType       = "object";
    protected $useSoftDeletes   = false;

    protected $allowedFields    = ["nombre","resumen", "estado"];

    // Dates
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';


    public function getPrograms($state)
    {
      return $this
        ->select("*")->where("estado" , $state)->get();
    }
}