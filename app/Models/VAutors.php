<?php

namespace App\Models;

use App\Entities\Autor;
use CodeIgniter\Model;
use Exception;

class AutorsModel extends Model
{
  protected $table            = 'v_autores';
  protected $primaryKey       = 'id_autor';
  protected $useAutoIncrement = true;


  protected $returnType       = Autor::class;
  protected $useSoftDeletes   = false;

  protected $allowedFields    = ["primer_nombre", "segundo_nombre", "primer_apellido", "segundo_apellido", "seudonimo", "direccion", "pais", "estado"];

  // Dates
  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';


  public function getAutors($state)
  {
    return $this->select("*")->where("estado", $state)->orderBy("v_autores.id_autor", "DESC");
  }

  public function getAutorBy($field, $search, $state)
  {
    return $this
      ->select("*")
      ->like("v_autores.$field", $search, "after")
      ->where("v_autores.estado", $state)
      ->orderBy("v_autores.id_autor", "DESC");
  }


  // obtener los nombres de los campos de la tabla
  public function getFields()
  {
    try {
      $q = "CALL obtener_nombre_campos('v_autores')";
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

  public function countAutors($state = 1)
  {
    $sql = 'SELECT contar_autores_activos(?)';
    $res = $this->query($sql, $state)->getRow();
    $temp =  get_object_vars($res);
    return ($temp["contar_autores_activos(1)"]);
  }


}
