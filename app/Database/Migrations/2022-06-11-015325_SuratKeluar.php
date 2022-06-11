<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratKeluar extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_keluar' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_surat_keluar' => [
                'type' => 'VARCHAR',
            ],
            'tanggal_surat_keluar' => [
                'type' => 'DATE',
            ],
            'keterangan_surat_keluar' => [
                'type' => 'VARCHAR',
            ],
            'file_surat_keluar' => [
                'type' => 'VARCHAR',
            ],
        ]);


        $this->forge->addKey('id', true);
        $this->forge->createTable('surat_keluar');
    }

    public function down()
    {
        $this->forge->dropTable('surat_keluar');
    }
}
