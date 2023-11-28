<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class BioskopRelations extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'bioskop_id'       => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'film_id' => [
                'type' => 'VARCHAR',
                'constraint' => '36'
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
        $this->forge->addForeignKey('bioskop_id', 'bioskops', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('film_id', 'films', 'id', 'CASCADE', 'CASCADE');
        $this->forge->createTable('BioskopRelations');
        $this->db->query('ALTER TABLE BioskopRelations MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
    }

    public function down()
    {
        $this->forge->dropTable('BioskopRelations');
    }
}
