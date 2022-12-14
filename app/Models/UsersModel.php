<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;
use Exception;

class UsersModel extends Model
{

  protected $table      = 'usuarios';
  protected $primaryKey = 'id_usuario';

  protected $useAutoIncrement = true;

  protected $returnType     = User::class;
  protected $useSoftDeletes = false;

  protected $allowedFields = ['primer_nombre', 'segundo_nombre', 'primer_apellido', 'segundo_apellido', 'correo', 'contrasena', 'id_grupo', "activo"];

  protected $useTimestamps = false;


  protected $beforeInsert = ["addGroup"];
  // protected $afterInsert = ["storeUserInfo"];

  protected $assignGroup;
  protected $infoUser;

  // protected function storeUserInfo($data){
  //   $this->infoUser->id_user = $data["id"];
  //   $model = model("UsersInfoModel");
  //   $model->insert($this->infoUser);
  // }

  public function getUsers()
  {
    return $this->select("id_usuario,primer_nombre, segundo_nombre, primer_apellido,segundo_apellido, correo, contrasena, usuarios.id_grupo, g.nombre_grupo as grupo, activo")
      ->join("grupos as g", "g.id_grupo = usuarios.id_grupo")
      ->where("usuarios.activo !=", 0)
      ->orderBy("usuarios.id_usuario", "DESC");
  }

  public function getUserByEmail( $email,$state)
  {
    return $this
      ->select("id_usuario,primer_nombre, segundo_nombre, primer_apellido,segundo_apellido, correo, contrasena, usuarios.id_grupo, g.nombre_grupo as grupo, activo")
      ->join("grupos as g", "g.id_grupo = usuarios.id_grupo")
      ->where("usuarios.correo", $email)
      ->where("usuarios.activo", $state);
  }

  public function insertUser($pn, $sn, $pa, $sa, $cor, $pass, $rol)
  {
    $q = "CALL insertar_usuario('$pn', '$sn','$pa', '$sa', '$cor','$pass', $rol)";
    $query = $this->query($q);
    return $query;
  }


  protected function addGroup($data)
  {
    $data["data"]["group"] = $this->assignGroup;
    return $data;
  }


  public function withGroup(string $group)
  {
    $row = $this->db->table("grupos")->where("nombre_grupo", $group)->where("activo != ", 0)->get()->getFirstRow();
    if ($row !== null) {
      $this->assignGroup = $row->id_group;
    }
  }

  public function countUsers()
  {
    $sql = 'SELECT contar_usuarios()';
    $res = $this->query($sql)->getRow();
    $temp =  get_object_vars($res);
    return ($temp["contar_usuarios()"]);
  }

  // obtener los nombres de los campos de la tabla
  public function getFields()
  {
    try {
      $q = "CALL obtener_nombre_campos('usuarios')";
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


  public function getUserBy(string $column, string $value)
  {
    return ($this->where($column, $value)->first());
  }

  
  public function deleteUser($id)
  {
    $this->update($id, ["activo" => 0]);
    return;
  }

}
