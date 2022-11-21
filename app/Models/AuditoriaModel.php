<?php

namespace App\Models;

use CodeIgniter\Model;

class AuditoriaModel extends Model
{
    protected $table            = 'auditoria_tipo2';
    protected $primaryKey       = 'id_auditoria';

    protected $returnType       = "object";
    protected $useSoftDeletes   = false;

    protected $allowedFields    = ["fecha_cambio","tipo", "tabla", "id_user", "old_info", "new_info"];

    // Dates
    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

 
}