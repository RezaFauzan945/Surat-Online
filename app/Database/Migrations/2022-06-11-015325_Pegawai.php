<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Pegawai extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_pegawai' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],

            'nama' => [
                'type' => 'VARCHAR',
            ],

            'nip' => [
                'type' => 'VARCHAR',
            ],

            'tempat_lahir' => [
                'type' => 'DATE',
            ],

            'tanggal_lahir' => [
                'type' => 'VARCHAR',
            ],

            'alamat' => [
                'type' => 'VARCHAR',
            ],

            'foto' => [
                'type' => 'VARCHAR',
            ],

            'no_hp' => [
                'type' => 'VARCHAR',
            ],

            'jabatan' => [
                'type' => 'VARCHAR',
            ],

            'pendidikan' => [
                'type' => 'VARCHAR',
            ],


        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('pegawai');
    }

    public function down()
    {
        $this->forge->dropTable('pegawai');
    }
}
