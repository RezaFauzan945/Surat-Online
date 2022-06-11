<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Gallery extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'profile' => [
                'type'       => 'TEXT',
            ],
            's_kelurahan' => [
                'type' => 'VARCHAR',
            ],
            's_lpm' => [
                'type' => 'VARCHAR',
            ],
            's_linmas' => [
                'type' => 'VARCHAR',
            ],
            's_pemuda' => [
                'type' => 'VARCHAR',
            ],
            'k_rtrw' => [
                'type' => 'VARCHAR',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('gallery');
    }

    public function down()
    {
        $this->forge->dropTable('gallery');
    }
}
