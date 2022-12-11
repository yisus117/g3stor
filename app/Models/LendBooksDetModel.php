<?php

namespace App\Models; 

use CodeIgniter\Model;

class LendBooksDetModel extends Model
{
    protected $table      = 'prestamos_det'; 

    protected $primaryKey = 'id_dprestamo';

    protected $useAutoIncrement = true; 

    protected $returnType     = 'array'; 
    protected $useSoftDeletes = false; 

    protected $allowedFields = ['id_libro', 'item', 'costo', 'estado'];

    protected $useTimestamps = true; 
    protected $createdField  = ''; 
    protected $updatedField  = ''; 
  


    // public function getPrestamos($activo)
    // {
    //     $this->select('prestamos_det.*');
    //     //$this->join('estudiantes as e', 'e.id_estudiante=prestamos_enc.id_estudiante');
    //     $this->where('prestamos_det.estado', $activo);
    //     $datoss = $this->findAll();  // nos trae todos los registros que cumplan con una condicion dada 
    //     return $datoss;
    // }
}
