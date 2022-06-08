<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Penduduk extends Model
{
    protected $table = 'penduduk';
    protected $primaryKey = 'nik' ;
    protected $allowedFields = [
        'nik',
        'nama',
        'no_hp',
        'tmpt_lhr',
        'tgl_lhr',
        'pekerjaan',
        'alamat',
        'rt',
        'rw'
    ];
    // function search_nik($nik){
    //     $this->db->like('nik', $nik , 'both');
    //     $this->db->order_by('nik', 'ASC');
    //     $this->db->limit(10);
    //     return $this->db->get('penduduk')->result();
    // }

    // public function cek_penduduk($nik)
    // {
    //     return $this->db->get_where('penduduk', array('nik' => $nik));
    // }

}
