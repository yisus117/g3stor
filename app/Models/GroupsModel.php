<?php

namespace App\Models;

use CodeIgniter\Model;

class GroupsModel extends Model
{
    protected $table            = 'grupos';
    protected $primaryKey       = 'id_grupo';
    protected $allowedFields    = ["nombre_grupo", "estado"];
    protected $useTimestamps    = false;
    protected $returnType       = "object";

}