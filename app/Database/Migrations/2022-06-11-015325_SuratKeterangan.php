<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratKeterangan extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_keterangan' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_surat_keterangan' => [
                'type' => 'VARCHAR',
            ],
            'tanggal_surat_keterangan' => [
                'type' => 'DATE',
            ],
            'keterangan_surat_keterangan' => [
                'type' => 'VARCHAR',
            ],
            'file_surat_keterangan' => [
                'type' => 'VARCHAR',
            ],
        ]);


        $this->forge->addKey('id', true);
        $this->forge->createTable('surat_keterangan');
    }

    public function down()
    {
        $this->forge->dropTable('surat_keterangan');
    }
}
