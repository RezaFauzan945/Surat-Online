<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'username' => 'admin',
                'password' => 'AdminSuratOnline',
                'level'    => 'administrator',
            ],

            [
                'username' => 'pegawai',
                'password' => 'PegawaiSuratOnline',
                'level'    => 'pegawai',
            ],
        ];

        // Simple Queries
        // $this->db->query('INSERT INTO users (username, email) VALUES(:username:, :email:)', $data);

        // Using Query Builder
        $this->db->table('user')->insert($data);
    }
}
