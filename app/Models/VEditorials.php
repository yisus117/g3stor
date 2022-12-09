<?php

namespace App\Models;

use App\Entities\Editorial;
use CodeIgniter\Model;
use Exception;

class VEditorials extends Model
{
  protected $table            = 'v_editoriales';
  protected $primaryKey       = 'id_editorial';
  protected $useAutoIncrement = true;


  protected $returnType       = Editorial::class;
  protected $useSoftDeletes   = false;

  protected $allowedFields    = ["nombre", "pais", "estado"];



  public function getEditorials($state)
  {
    return $this->select("*")->where("estado", $state)->orderBy("v_editoriales.id_editorial", "DESC");
  }

  public function getEditorialBy($field, $search, $state)
  {
    return $this
      ->select("*")
      ->like("v_editoriales.$field", $search, "after")
      ->where("v_editoriales.estado", $state)
      ->orderBy("v_editoriales.id_editorial", "DESC");
  }


  // obtener los nombres de los campos de la tabla
  public function getFields()
  {
    try {
      $q = "CALL obtener_nombre_campos('v_editoriales')";
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

  public function countEditorials($state = 1)
  {
    $sql = 'SELECT contar_editoriales_activos(?)';
    $res = $this->query($sql, $state)->getRow();
    $temp =  get_object_vars($res);
    return $temp["contar_editoriales_activos(1)"];
  }


  
}
