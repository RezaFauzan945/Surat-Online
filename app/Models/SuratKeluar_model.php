<?php

namespace App\Models;

use CodeIgniter\Model;

class SuratKeluar_model extends Model
{
    protected $table = 'surat_keluar';
    protected $primaryKey = 'id_surat_keluar' ;
    protected $useTimestamps = true;

    // public function cek_pengguna($where)
    // {
    //     return Auth_model->get_where("user", $where);
    // }

    // public function cek_akun($where)
    // {
    //     return $this->db->get_where("user", $where);
    // }

}