<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InfoUsers extends Migration
{
    public function up()
    {
        $this->db->disableForeignKeyChecks();
        $this->forge->addField([
            'id_user' => [
                'type'           => 'INT',
                'constraint'     => 12,
                'unsigned'       => true,
                'auto_increment' => true,
                'null'           => false

            ],
            'name' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null'           => false
            ],
            'surname' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
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
        ]);
        $this->forge->addKey('id_user', true);
        $this->forge->addForeignKey("id_user", "users", "id", "CASCADE", "CASCADE" );
        $this->forge->createTable('users_info');
        $this->db->enableForeignKeyChecks();
    }

    public function down()
    {
        $this->forge->dropTable('users_info');
        
    }
}
