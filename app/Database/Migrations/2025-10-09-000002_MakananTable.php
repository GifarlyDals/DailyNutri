<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateMakananTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idMakanan' => [
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
            'namaMakanan' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
                'null' => false,
            ],
            'kalori' => [
                'type' => 'INT',
                'null' => false,
            ],
            'deskripsi' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'tags' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
                'null' => true,
            ],
        ]);
        $this->forge->addKey('idMakanan', true);
        $this->forge->addForeignKey('idUser', 'user', 'idUser', 'CASCADE', 'CASCADE');
        $this->forge->createTable('makanan');
    }

    public function down()
    {
        $this->forge->dropTable('makanan');
    }
}
