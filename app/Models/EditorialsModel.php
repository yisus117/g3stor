<?php

namespace App\Models;

use App\Entities\Editorial;
use CodeIgniter\Model;

class EditorialsModel extends Model
{
  protected $table            = 'editoriales';
  protected $primaryKey       = 'id_editorial';
  protected $useAutoIncrement = true;


  protected $returnType       = Editorial::class;
  protected $useSoftDeletes   = false;

  protected $allowedFields    = ["nombre", "id_pais", "estado"];

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
      "id_editorial" => null,
      "tipo" => "INSERT",
      "tabla" => "editoriales",
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
      array_pop($old);
      $datos = [
        "id_editorial" => null,
        "tipo" => "DELETE",
        "tabla" => "editoriales",
        "id_user" => config("G3stor")->currentUserId,
        "old_info" => implode("|", $this->oldInfo),
        "new_info" => implode("|", $old)  . "|" . "0"
      ];
    } else {
      $datos = [
        "id_editorial" => null,
        "tipo" => "UPDATE",
        "tabla" => "editoriales",
        "id_user" => config("G3stor")->currentUserId,
        "old_info" => implode("|", $this->oldInfo),
        "new_info" => strval($data["id"][0]) . "|" . implode("|", $data["data"])
      ];
    }
    $model->insert($datos);
  }


  public function getEditorials($state)
  {
    return $this
      ->select("id_editorial, editoriales.nombre, p.nombre AS pais, editoriales.estado")
      ->join("paises as p", "p.id_pais = editoriales.id_pais")
      ->where("editoriales.estado", $state)
      ->orderBy("editoriales.nombre");
  }


  public function getEditorialByName($name, $state = 1)
  {
    return $this
      ->select("id_editorial, editoriales.nombre, p.nombre AS pais, editoriales.estado")
      ->join("paises as p", "p.id_pais = editoriales.id_pais")
      ->like("editoriales.nombre", $name, "after")
      ->where("editoriales.estado", $state)
      ->orderBy("editoriales.nombre");
  }


  public function deleteEditorial($id)
  {
    return $this->update($id, ["estado" => 0]);
  }


  public function countEditorials($state = 1)
  {
    $sql = 'SELECT contar_editoriales_activos(?)';
    $res = $this->query($sql, $state)->getRow();
    return get_object_vars($res);
  }


  public function getEditorialBy(string $column, string $value)
  {
    return $this->where($column, $value)->first();
  }
}
