<?php

namespace App\Models;

use App\Entities\Autor;
use CodeIgniter\Model;

class AutorsModel extends Model
{
  protected $table            = 'autores';
  protected $primaryKey       = 'id_autor';
  protected $useAutoIncrement = true;


  protected $returnType       = Autor::class;
  protected $useSoftDeletes   = false;

  protected $allowedFields    = ["primer_nombre", "segundo_nombre", "primer_apellido", "segundo_apellido", "seudonimo", "direccion", "id_pais", "estado"];

  // Dates
  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';


  // Events parameters
  protected $afterInsert = ["afterInsert"];
  protected $afterUpdate = ["afterUpdated"];

  public $oldInfo;


  protected function afterInsert($data)
  {
    $model = model("auditoriaModel");
    $datos = [
      "tipo" => "INSERT",
      "tabla" => "autores",
      "id_user" => config("G3stor")->currentUserId,
      "old_info" => null,
      "new_info" => strval($data["id"]) . "|" . implode("|", $data["data"]) . "|" . "1"
    ];
    $model->insert($datos);
  }

  protected function afterUpdated($data)
  {
    $model = model("auditoriaModel");
    $old = $this->oldInfo;
    if ($data["data"]["estado"] == 0) {
     try {
      array_pop($old);
      $datos = [
        "tipo" => "DELETE",
        "tabla" => "autores",
        "id_user" => config("G3stor")->currentUserId,
        "old_info" => implode("|", $this->oldInfo),
        "new_info" => implode("|", $old)  . "|" . "0"
      ];
     } catch (\Throwable $th) {
      //throw $th;
     }
    } else {
      try {
        $datos = [
          "tipo" => "UPDATE",
          "tabla" => "autores",
          "id_user" => config("G3stor")->currentUserId,
          "old_info" => implode("|", $this->oldInfo),
          "new_info" => strval($data["id"][0]) . "|" . implode("|", $data["data"])
        ];
      } catch (\Throwable $th) {
        //throw $th;
      }
    }
    $model->insert($datos);
  }

  public function insertAutor($pn, $sn, $pa, $sa, $seu, $dir, $pais)
  {
    $q = "CALL insertar_autor($pn, $sn,$pa,$sa,$seu,$dir,$pais)";
    $query = $this->query($q);
    return $query;
  }

  public function updateAutor($id, $pn, $sn, $pa, $sa, $seu, $dir, $pais, $est)
  {
    $q = "CALL actualizar_autor($id, $pn, $sn,$pa,$sa,$seu,$dir,$pais, $est)";
    $query = $this->query($q);
    return $query;
  }

  public function deleteAutor($id)
  {
    $this->update($id, ["estado" => 0]);
    return;
  }
}
