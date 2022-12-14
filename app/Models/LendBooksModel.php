<?php

namespace App\Models;


use CodeIgniter\Model;
use App\Entities\LendBook;
use Exception;

class LendBooksModel extends Model
{
    protected $table      = 'prestamos_enc';

    protected $primaryKey = 'id_prestamo';


    protected $returnType     = LendBook::class;  
    protected $useSoftDeletes = false; 

    protected $allowedFields = ['id_estudiante', 'fecha_prestamo', 'fecha_devolucion', 'usuario_creador', 'estado']; 

    protected $useTimestamps = true; 
    protected $createdField  = ''; 
    protected $updatedField  = ''; 


    protected $afterInsert = ["afterInsert"];

    
    protected $idLibro;

    protected function afterInsert($data)
    {
        
        $model = model("LendBooksDetModel");
        $Bmodel = model("BooksModel");
        if ($libro = $Bmodel->where("id_libro", $this->idLibro)->find()) {

            $prestamosDet = [
                "id_prestamo" => $data["id"],
                "id_libro" => $this->idLibro,
                "costo" => $libro->costo
            ];
            $model->insert($prestamosDet);
        }
    }

    public function getLend($state)
    {
        return $this->select("prestamos_enc.id_prestamo,fecha_prestamo,e.primer_nombre, e.segundo_nombre, e.primer_apellido, e.segundo_apellido,prestamos_enc.estado, lb.nombre as libro")
        ->join("estudiantes as e", "e.id_estudiante = prestamos_enc.id_estudiante")
        ->join("prestamos_det as pd", "pd.id_dprestamo = prestamos_enc.id_prestamo")
        ->join("libros as lb", "lb.id_libros = pd.id_libro")
        ->where("prestamos_enc.estado", $state);

    }
    public function getLendBy($state)
    {
        $this->select('*,e.primer_nombre, e.segundo_nombre, e.primer_apellido, e.segundo_apellido');
        $this->join('estudiantes as e', 'e.id_estudiante=prestamos_enc.id_estudiante');
        $this->where('prestamos_enc.estado', $state);

        $res = $this->findAll(); 
        return $res;
    }

    public function countLend($state = 1)
    {
      $sql = 'SELECT contar_prestamos_activos(?)';
      $res = $this->query($sql, $state)->getRow();
      $temp =  get_object_vars($res);
      return $temp["contar_prestamos_activos(1)"];
    }

    public function getFields()
    {
      try {
        $q = "CALL obtener_nombre_campos('prestamos_enc')";
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
