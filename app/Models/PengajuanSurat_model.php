<?php

namespace App\Models;

use CodeIgniter\Model;

class PengajuanSurat_model extends Model
{
    protected $table = 'pengajuan_surat';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'id',
        'NIK',
        'jenis_surat',
        'tanggal',
        'file',
        'status',
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
