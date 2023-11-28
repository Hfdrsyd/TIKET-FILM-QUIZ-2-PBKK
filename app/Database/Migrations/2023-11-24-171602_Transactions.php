<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Transactions extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'          => [
                'type'       => 'VARCHAR',
                'constraint' => '36'
            ],
            'user_id'       => [
                'type' => 'VARCHAR',
                'constraint' => '36'
            ],
            'film_id'       => [
                'type' => 'VARCHAR',
                'constraint' => '36'
            ],
            'jadwal_id'       => [
                'type' => 'INT',
                'unsigned' => true,
            ],
            'total_price'       => [
                'type'       => 'DECIMAL',
                'constraint' => '10,2',
            ],
            'count'       => [
                'type'       => 'INTEGER',
                'constraint' => '10',
            ],
            'address'       => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'payment_method'       => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
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
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('film_id', 'films', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('jadwal_id', 'schedules', 'id', 'CASCADE', 'CASCADE');

        $this->forge->createTable('transactions');
        $this->db->query('ALTER TABLE transactions MODIFY created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP');
    }

    public function down()
    {
        $this->forge->dropTable('transactions');
    }
}
