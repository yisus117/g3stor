<?php

namespace App\Models;

use CodeIgniter\Model;

class CountriesModel extends Model
{
    protected $table            = 'paises';
    protected $primaryKey       = 'id_pais';

    protected $returnType       = "object";
    protected $useSoftDeletes   = false;

    protected $allowedFields    = ["nombre","cod_pais", "estado"];

    // Dates
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

 
}