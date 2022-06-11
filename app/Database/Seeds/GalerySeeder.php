<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class GallerySeeder extends Seeder
{
    public function run()
    {
        $data = [
            'profile'     => 'Secara Historis Desa Meliau Hilir merupakan Desa yang diresmikan pada tanggal 8 maret 1987 berdasarkan  Perda No.123/Pem/Sanggau/2006 dahulunya nama Meliau Hilir berasal dari  asal Bahasa  melayu yang merupakan bahasa sehari-hari yang ditujukan kepada orang yang sudah tua (lanjut usia) dimana anak cucu keturunannya dikatakan Layau/Melawa/Pikun. Karena orang tua tersebut dianggap  memiliki nilai sejarah lama diambilah kata melayu layau tersebut disingkat dengan  kata melayau. Untuk mudah mengucapkannya menjadi meliyau dan disempurnakan menjadi meliau. Kata hilir sendiri karena letaknya  dihilir sungai kapuas makanya dikenal dengan nama meliau hilir',
            's_kelurahan' => 'Struktur_1.png',
            's_lpm'       => '',
            's_linmas'    => '',
            's_pemuda'    => '',
            'k_rtrw'      => '',
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        $this->db->table('gallery')->insert($data);
    }
}
