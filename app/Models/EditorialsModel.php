<?php

namespace App\Models;

use App\Entities\Editorial;
use CodeIgniter\Model;
use Exception;

class EditorialsModel extends Model
{
  protected $table            = 'editoriales';
  protected $primaryKey       = 'id_editorial';
  protected $useAutoIncrement = true;


  protected $returnType       = Editorial::class;
  protected $useSoftDeletes   = false;

  protected $allowedFields    = ["Nombre", "id_pais", "estado"];

  // Dates
  protected $useTimestamps = false;
  protected $createdField  = 'created_at';
  protected $updatedField  = 'updated_at';


// Events parameters
  protected $afterInsert = ["afterInsert"];
  protected $afterUpdate = ["afterUpdated"];

  public $oldInfo;

  protected function afterUpdated($data)
  {
    $model = model("auditoriaModel");
    $old = $this->oldInfo;
    if ($data["data"]["estado"] == 0) {
      array_pop($old);
      $datos = [
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


  public function insertEditorial($name, $country)
  {
    $q = "CALL insertar_editorial('$name', $country)";
    $query = $this->query($q);
    return $query;
  }

  public function updateEditorial($id,$name, $country, $state)
  {
    $q = "CALL actualizar_editorial($id,'$name', $country, $state)";
    $query = $this->query($q);
    return $query;
  }

  public function deleteEditorial($id)
  {
    $this->update($id, ["estado" => 0]);
    return;
  }

}
