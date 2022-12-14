<?php

namespace App\Models;

use App\Entities\Student;
use CodeIgniter\Model;
use Exception;

class VStudents extends Model
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
    return $this->select("*")->where("activo", $state)
    ->orderBy("v_estudiantes.id_estudiante", "DESC");
  }

  public function countStudents($state = 1)
  {
    $sql = 'SELECT contar_estudiantes_activos(?)';
    $res = $this->query($sql, $state)->getRow();
    $temp =  get_object_vars($res);
    return $temp["contar_estudiantes_activos(1)"];
  }

  public function getStudentsByName($field, $search, $state)
  {
    return $this
      ->select("*")
      ->like("v_estudiantes.$field", $search, "after")
      ->where("v_estudiantes.activo", $state)
      ->orderBy("v_estudiantes.id_estudiante", "DESC");
  }

  public function getStudentsByDoc( $search, $state)
  {
    return $this
      ->select("*")
      ->like("v_estudiantes.documento", $search, "both")
      ->where("v_estudiantes.activo", $state);
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

    return array_filter(
      array_column($query, "COLUMN_NAME"),
      function ($a) {
        return (!strpos($a, "abv"));
      }
    );
  }
}
