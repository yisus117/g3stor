<?php

namespace App\Models;

use App\Entities\Book;
use CodeIgniter\Model;

class BooksModel extends Model
{
  protected $table            = 'libros';
  protected $primaryKey       = 'id_libros';
  protected $useAutoIncrement = true;


  protected $returnType       = Book::class;
  protected $useSoftDeletes   = false;

  protected $allowedFields    = ["nombre", "id_editorial", "edicion", "paginas", "activo"];

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
      "tabla" => "libros",
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
    if ($data["data"]["activo"] == 0) {
      array_pop($old);
      $datos = [
        "tipo" => "DELETE",
        "tabla" => "libros",
        "id_user" => config("G3stor")->currentUserId,
        "old_info" => implode("|", $this->oldInfo),
        "new_info" => implode("|", $old)  . "|" . "0"
      ];
    } else {
      $datos = [
        "tipo" => "UPDATE",
        "tabla" => "libros",
        "id_user" => config("G3stor")->currentUserId,
        "old_info" => implode("|", $this->oldInfo),
        "new_info" => strval($data["id"][0]) . "|" . implode("|", $data["data"])
      ];
    }
    $model->insert($datos);
  }


  public function getBooks($state)
  {
    return $this
      ->select("id_libros, libros.nombre, e.nombre AS editorial, libros.edicion, libros.paginas, libros.activo")
      ->join("editoriales as e", "e.id_editorial = libros.id_editorial")
      ->where("libros.activo", $state)
      ->orderBy("libros.nombre");
  }

  public function getBooksByName($name, $state = 1)
  {
    return $this
      ->select("id_libros, libros.nombre, e.nombre AS editorial, libros.edicion, libros.paginas, libros.activo")
      ->join("editoriales as e", "e.id_editorial = libros.id_editorial")
      ->like("libros.nombre", $name, "after")
      ->where("libros.activo", $state)
      ->orderBy("libros.nombre");
  }

  public function deleteBook($id)
  {
    return $this->update($id, ["activo" => 0]);
  }


  public function countBooks($state = 1)
  {
    $sql = 'SELECT contar_libros_activos(?)';
    $res = $this->query($sql, $state)->getRow();
    return get_object_vars($res);
  }
}
