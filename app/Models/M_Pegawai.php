<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Pegawai extends Model
{
    protected $table = 'pegawai';
    protected $primaryKey = 'id' ;
    protected $allowedFields = [        
        'id_pegawai',
        'nama',
        'nip',
        'tempat_lahir',
        'tanggal_lahir',
        'alamat',
        'foto',
        'no_hp',
        'jabatan',
        'pendidikan',
    ];

}
