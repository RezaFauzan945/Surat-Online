<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Penduduk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'nik' => [
                'type' => 'VARCHAR',
            ],
            'nama' => [
                'type' => 'VARCHAR',
            ],
            'no_hp' => [
                'type' => 'VARCHAR',
            ],
            'tmpt_lhr' => [
                'type' => 'VARCHAR',
            ],
            'tgl_lhr' => [
                'type' => 'DATE',
            ],
            'pekerjaan' => [
                'type' => 'VARCHAR',
            ],
            'alamat' => [
                'type' => 'VARCHAR',
            ],
            'rt' => [
                'type' => 'INT',
            ],
            'rw' => [
                'type' => 'INT',
            ],

        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('penduduk');
    }

    public function down()
    {
        $this->forge->dropTable('penduduk');
    }
}
