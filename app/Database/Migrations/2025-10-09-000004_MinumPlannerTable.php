<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMinumPlannerTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idPlanMinum' => [
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
            'targetML' => [
                'type' => 'INT',
                'default' => 2000,
            ],
            'currentML' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('idPlanMinum', true);
        $this->forge->addForeignKey('idUser', 'user', 'idUser', 'CASCADE', 'CASCADE');
        $this->forge->createTable('minum_planner');
    }

    public function down()
    {
        $this->forge->dropTable('minum_planner');
    }
}
