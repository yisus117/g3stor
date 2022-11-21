<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Users extends Migration
{
    public function up()
    {

        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'auto_increment' => true,
                'null'           => false

            ],
            'fullname' => [
                'type'       => 'VARCHAR',
                'constraint' => '120',
                'null'           => false
            ],
            'email' => [
                'type'       => 'VARCHAR',
                'constraint' => '120',
                'null'           => false,
                'unique'      => true
            ],
            'password' => [
                'type'       => 'VARCHAR',
                'constraint' => '60',
                'null'           => false
            ],
            'group' => [
                'type'       => 'INT',
                'constraint' => '12',
                'unsigned'       => true,
                'null'           => false
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => false,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'deleted_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey("group", "groups", "id_group", "CASCADE", "CASCADE");
        $this->forge->createTable('users');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('users');
    }
}
