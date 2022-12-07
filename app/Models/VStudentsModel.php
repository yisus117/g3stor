<?php

namespace App\Models;

use App\Entities\Student;
use CodeIgniter\Model;
use Exception;

class VStudentsModel extends Model
{
  protected $table            = 'v_estudiantes';
  protected $primaryKey       = 'id_estudiante';
  protected $useAutoIncrement = true;


  protected $returnType       = Student::class;
  protected $useSoftDeletes   = false;

  protected $allowedFields    = ["tipo_documento_abv", "tipo_documento", "documento", "primer_nombre", "segundo_nombre", "primer_apellido", "segundo_apellido", "sexo", "sexo_abv", "direccion", "estado_civil", "estado_civil_abv", "correo", "programa", "activo"];

  // Dates
  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';

  public function getStudents($state)
  {
    return $this->select("*")->where("activo", $state);
  }

  public function countStudents($state = 1)
  {
    $sql = 'SELECT contar_estudiantes_activos(?)';
    $res = $this->query($sql, $state)->getRow();
    return get_object_vars($res);
  }

  public function getFields()
  {
    try {
      $q = "CALL obtener_nombre_campos('v_estudiantes')";
      $query = $this->query($q)->getResult();
      array_shift($query);
    
    } catch (Exception $e) {
      echo $e;
    }

   $temp = array_filter(
      array_column($query, "COLUMN_NAME"),
      function ($a) {
        return (!strpos($a, "abv")) ;
      }
    );
   

    return $temp;




  }
  public function getStudentsByName($field,$search, $state)
  {
    return $this
    ->select("*")
      ->like("v_estudiantes.$field", $search, "after")
      ->where("v_estudiantes.activo", $state)
      ->orderBy("v_estudiantes.primer_nombre");
  }
}
