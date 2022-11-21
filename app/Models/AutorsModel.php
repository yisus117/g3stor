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
      array_pop($old);
      $datos = [
        "tipo" => "DELETE",
        "tabla" => "autores",
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




  public function getAutors($state)
  {
    return $this
      ->select("id_autor, autores.primer_nombre,autores.segundo_nombre, autores.primer_apellido, autores.segundo_apellido, autores.seudonimo, autores.direccion, p.nombre AS pais, autores.estado")
      ->join("paises as p", "p.id_pais = autores.id_pais")
      ->where("autores.estado", $state)
      ->orderBy("autores.primer_nombre");
  }

  public function getAutorsByName($name, $state = 1)
  {
    return $this
      ->select("id_autor, autores.primer_nombre,autores.segundo_nombre, autores.primer_apellido, autores.segundo_apellido, autores.seudonimo, autores.direccion, p.nombre AS pais, autores.estado")
      ->join("paises as p", "p.id_pais = autores.id_pais")
      ->like("autores.primer_nombre", $name, "after")
      ->where("autores.estado", $state)
      ->orderBy("autores.primer_nombre");
  }

  public function deleteAutor($id)
  {
    return $this->update($id, ["estado" => 0]);
  }

  public function countAutors($state = 1)
  {
    $sql = 'SELECT contar_autores_activos(?)';
    $res = $this->query($sql, $state)->getRow();
    return get_object_vars($res);
  }
}
