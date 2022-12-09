<?php

namespace App\Models;

use App\Entities\Student;
use CodeIgniter\Model;

class StudentsModel extends Model
{
  protected $table            = 'estudiantes';
  protected $primaryKey       = 'id_estudiante';
  protected $useAutoIncrement = true;


  protected $returnType       = Student::class;
  protected $useSoftDeletes   = false;

  protected $allowedFields    = ["tipo_documento", "documento", "primer_nombre", "segundo_nombre", "primer_apellido", "segundo_apellido", "sexo", "estado_civil", "direccion", "correo", "id_programa", "activo"];

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
      "tabla" => "estudiantes",
      "id_user" => config("G3stor")->currentUserId,
      "old_info" => null,
      "new_info" => strval($data["id"]) . "|" . implode("|", $data["data"]) . "|" . "1"
    ];
    $model->insert($datos);
  }



  public function insertStudent($pn, $sn, $pa, $sa, $td, $doc, $sx, $ec, $dir, $cor, $pro, $tel)
  {
    $q = "CALL insertar_estudiante('$pn', '$sn','$pa', '$sa', $td, '$doc', $sx, $ec, '$dir', '$cor', '$pro', '$tel')";
    $query = $this->query($q);
    return $query;
  }

  public function updateStudent($id, $pn, $sn, $pa, $sa, $td, $doc, $sx, $ec, $dir, $cor, $pro, $tel, $act)
  {
    $q = "CALL actualizar_estudiante($id, '$pn', '$sn','$pa', '$sa', $td, '$doc', $sx, $ec, '$dir', '$cor', '$pro', '$tel','$act')";
    $query = $this->query($q);
    return $query;
  }


  public function deleteStudent($id)
  {

    $this->update($id, ["activo" => 0]);
    return;
  }

  public function countStudents($state = 1)
  {
    $sql = 'SELECT contar_estudiantes_activos(?)';
    $res = $this->query($sql, $state)->getRow();
    return get_object_vars($res);
  }
}
