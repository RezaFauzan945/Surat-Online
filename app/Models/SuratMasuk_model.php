<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratMasuk_model extends Model
{
    protected $table = 'surat_masuk';
    protected $primaryKey = 'id_surat_masuk' ;
    protected $allowedFields = [ 
    'id_surat_masuk',
    'nama_surat_masuk',
    'tanggal_surat_masuk',
    'keterangan_surat_masuk',
    'file_surat_masuk',
    ];

    // public function cek_pengguna($where)
    // {
    //     return Auth_model->get_where("user", $where);
    // }

    // public function cek_akun($where)
    // {
    //     return $this->db->get_where("user", $where);
    // }

}