<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class PengajuanSurat extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'VARCHAR',
            ],
            'NIK' => [
                'type' => 'VARCHAR',
            ],
            'jenis_surat' => [
                'type' => 'VARCHAR',
            ],
            'tanggal' => [
                'type' => 'DATE',
            ],
            'file' => [
                'type' => 'VARCHAR',
            ],
            'status' => [
                'type' => 'VARCHAR',
            ],
        ]);

        $this->forge->addKey('id', true);
        $this->forge->createTable('pengajuan_surat');
    }

    public function down()
    {
        $this->forge->dropTable('pengajuan_surat');
    }
}
