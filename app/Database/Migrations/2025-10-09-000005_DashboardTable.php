<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateDashboardTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idDashboard' => [
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
            'totalKaloriHariIni' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'totalMakananHariIni' => [
                'type' => 'INT',
                'default' => 0,
            ],
            'tanggal' => [
                'type' => 'DATE',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('idDashboard', true);
        $this->forge->addForeignKey('idUser', 'user', 'idUser', 'CASCADE', 'CASCADE');
        $this->forge->createTable('dashboard');
    }

    public function down()
    {
        $this->forge->dropTable('dashboard');
    }
}
