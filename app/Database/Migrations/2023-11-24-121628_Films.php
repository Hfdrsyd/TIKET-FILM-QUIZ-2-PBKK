<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Films extends Migration
{
    public function up()
    {
        // Foreign Key user
        $this->forge->addField([
            'id'          => [
                'type'       => 'VARCHAR',
                'constraint' => '36'
            ],
            'title'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'description'       => [
                'type'       => 'TEXT'
            ],
            'price'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'stock'       => [
                'type'       => 'INTEGER',
                'constraint' => '10',
            ],
            'author'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'publisher'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'genre'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'cover'       => [
                'type'       => 'VARCHAR',
                'constraint' => '500',
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
        $this->forge->createTable('films');
        $this->db->query('ALTER TABLE films MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
    }

    public function down()
    {
        $this->forge->dropTable('films');
    }
}
