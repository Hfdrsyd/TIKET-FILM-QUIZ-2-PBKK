<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Bioskops extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nama'       => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'lokasi' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'fasilitas' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'lokasi' => [
                'type' => 'VARCHAR',
                'constraint' => '50'
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '100'
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('bioskops');
        $this->db->query('ALTER TABLE bioskops MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
    }

    public function down()
    {
        $this->forge->dropTable('bioskops');
    }
}
