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



  public $oldInfo;




  public function getBooks($state)
  {
    return $this
      ->select("*")
      ->where("libros.activo !=", 0)
      ->orderBy("libros.nombre");
  }

  public function getBooksForLend()
  {
    return $this
      ->select("*")
      ->where("libros.activo =", 1)
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

  public function borrowBook($id,$state)
  {
    return $this->update($id, ["activo" => $state]);
  }


  public function countBooks($state = 1)
  {
    $sql = 'SELECT contar_libros_activos(?)';
    $res = $this->query($sql, $state)->getRow();
    $temp =  get_object_vars($res);
    return $temp["contar_libros_activos(1)"];
  }

  public function getBookByISBN( $search, $state)
  {
    return $this
      ->select("*")
      ->like("libros.isbn", $search, "both")
      ->where("libros.activo", $state);
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
