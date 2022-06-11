<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SuratMasuk extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_surat_masuk' => [
                'type'           => 'INT',
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'nama_surat_masuk' => [
                'type' => 'VARCHAR',
            ],
            'tanggal_surat_masuk' => [
                'type' => 'DATE',
            ],
            'keterangan_surat_masuk' => [
                'type' => 'VARCHAR',
            ],
            'file_surat_masuk' => [
                'type' => 'VARCHAR',
            ],
        ]);


        $this->forge->addKey('id', true);
        $this->forge->createTable('surat_masuk');
    }

    public function down()
    {
        $this->forge->dropTable('surat_masuk');
    }
}
