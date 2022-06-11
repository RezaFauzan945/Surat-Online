<?php

namespace App\Models;

use CodeIgniter\Model;

class Pengajuan_track_model extends Model
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
    // public function insert_p_surat($data)
    // {
    //     $query= $this->db->insert('pengajuan_surat',$data);
    //     if($query){
    //         return true;
    //         return $query;
    //     }else{
    //         return false;
    //     }
    // }

    // public function findById($id)
    // {
    //     $query = $this->db->get_where('pengajuan_surat', ['id' => $id])->row_array();
    //     return $query;
    // }

    // public function showById($id)
    // {
    //     $this->db->select('*');
    //     $this->db->join('penduduk','penduduk.nik=pengajuan_surat.NIK');
    //     $query = $this->db->get_where('pengajuan_surat', ['id' => $id])->row_array();
    //     return $query;
    // }
}
