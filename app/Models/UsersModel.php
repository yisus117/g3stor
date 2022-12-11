<?php

namespace App\Models;

use App\Entities\User;
use CodeIgniter\Model;

class UsersModel extends Model {

   protected $table      = 'usuarios';
    protected $primaryKey = 'id_usuario';

    protected $useAutoIncrement = true;

    protected $returnType     = User::class;
    protected $useSoftDeletes = false;

    protected $allowedFields = ['primer_nombre', 'segundo_nombre','primer_apellido', 'segundo_apellido', 'correo', 'contrasena', 'id_grupo', "activo"];

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

    protected function addGroup($data){
      $data["data"]["group"] = $this->assignGroup;
      return $data;
    }


    public function withGroup(string $group){
      $row = $this->db->table("grupos")->where("nombre_grupo",$group)->where("activo != ", 0)->get()->getFirstRow();


      if($row !== null) {
        $this->assignGroup = $row->id_group;
      }

    }


    public function getUserBy(string $column, string $value){
      return ($this->where($column, $value)->first());
    }

}