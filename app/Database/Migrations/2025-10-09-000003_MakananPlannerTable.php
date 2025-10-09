<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMakananPlannerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idPlanMakan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'idUser' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'idMakanan' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'planMakan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => true,
            ],
            'totalKalori' => [
                'type' => 'INT',
                'null' => true,
            ],
            'totalPorsi' => [
                'type' => 'INT',
                'null' => true,
            ],
            'waktuMakan' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'type' => [
                'type' => 'VARCHAR',
                'constraint' => '50',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('idPlanMakan', true);
        $this->forge->addForeignKey('idUser', 'user', 'idUser', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('idMakanan', 'makanan', 'idMakanan', 'SET NULL', 'CASCADE');
        $this->forge->createTable('makanan_planner');
    }

    public function down()
    {
        $this->forge->dropTable('makanan_planner');
    }
}
