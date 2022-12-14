<?php

namespace App\Models;

use App\Entities\Book;
use CodeIgniter\Model;
use Exception;

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


  public function getBooks()
  {
    return $this
      ->select("*")
      ->where("libros.activo !=", 0)
      ->orderBy("libros.nombre");
  }

  public function getBooksBy($field, $search)
  {
    return $this
      ->select("*")
      ->like("libros.$field", $search, "after")
      ->where("libros.activo !=", 0)
      ->orderBy("libros.id_libros", "DESC");
  }

  public function deleteBook($id)
  {
    return $this->update($id, ["activo" => 0]);
  }


  public function countBooks($state = 1)
  {
    $sql = 'SELECT contar_libros_activos(?)';
    $res = $this->query($sql, $state)->getRow();
    $temp =  get_object_vars($res);
    return $temp["contar_libros_activos(1)"];
  }

    // obtener los nombres de los campos de la tabla
    public function getFields()
    {
      try {
        $q = "CALL obtener_nombre_campos('libros')";
        $query = $this->query($q)->getResult();
        array_shift($query);
      } catch (Exception $e) {
        echo $e;
      }
  
      return array_filter(
        array_column($query, "COLUMN_NAME"),
        function ($a) {
          return (!strpos($a, "contrasena"));
        }
      );
    }

    public function insertBook($isbn,$nom,$edi,$edition,$pages,$cost)
    {
      $q = "CALL insertar_libro('$isbn','$nom',$edi,'$edition',$pages,$cost)";
      $query = $this->query($q);
      return $query;
    }
  
}
