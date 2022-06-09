<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKeterangan_model extends Model
{
    protected $table = 'surat_keterangan';
    protected $primaryKey = 'id_surat_keterangan' ;
    protected $allowedFields = [ 
        'id_surat_keterangan',
        'nama_surat_keterangan',
        'tanggal_surat_keterangan',
        'keterangan_surat_keterangan',
        'file_surat_keterangan',
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