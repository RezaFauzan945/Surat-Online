<?php

namespace App\Controllers;

use App\Models\M_Penduduk;
use App\Models\Galery_model;
use App\Models\Pengajuan_track_model;

// defined('BASEPATH') or exit('No direct script access allowed');

class Tracking extends BaseController
{
    protected $galeryModel;
    protected $Pengajuan_track_model;
    protected $M_Penduduk;
    public function __construct()
    {
        // parent::__construct();
        $this->galeryModel = new Galery_model;
        $this->Pengajuan_track_model = new Pengajuan_track_model;
        $this->M_Penduduk = new M_Penduduk;

        helper(array('form', 'url','Cookie', 'String'));
    }

    public function index()
    {
        // $data = $this->dashboard->user();
        $data =[
            'profil'=> $this->galeryModel->findAll(),
            'title' => 'Tracking',
            'sub_title' => '',
        ];

        // $data['sm'] = $this->db->get('surat_masuk')->row_array();
        // var_dump($data);
        echo view('frontend/header2', $data);
        echo view('frontend/tracking',$data);
        echo view('frontend/footer2',$data);
    }

    public function cari()
    {

        $id = $this->request->getPost('trackid');
        $row = $this->Pengajuan_track_model->find($id);

        $data = [ 
            'id' => $id,
            'row' => $row
        ];

        // var_dump($row);
        // die;

        if ($row === null) {
            session()->setFlashdata('message', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-bank"></i> Maaf!</h5> ID yang anda masukkan Salah! <b>ID: </b><b>'.$id.'</b> <i>tidak ditemukan</i></div>');
            return redirect()->to("/tracking")->withInput();
        }else {
            return redirect()->to("/tracking/tracked/".$id);
        }

    }

    public function tracked($id)
    {
        $data = [
            'title' => 'Tracking',
            'sub_title' => '',
            'row'      => $this->Pengajuan_track_model->select('*')->join('penduduk','penduduk.nik=pengajuan_surat.NIK')->find($id),
            'options' =>[
                'SPKK' => 'Kartu Keluarga',
                'SPNA' => 'Nikah(N.A)',
                'SKKL' => 'Kelahiran',
                'SKKM' => 'Kematian',
                'SKP' => 'Pindah',
                'SKD' => 'Datang',
                'SKBM' => 'Belum Menikah',
                'SKPH' => 'Penghasilan',
                'SKM' => 'Miskin',
                'SKU' => 'Usaha',
                'SKT' => 'Tanah',
                'SKGG' => 'Ganti Rugi',
                'SITU' => 'Izin Tempat Usaha',
                'SIMB' => 'Izin Mendirikan Bangunan',
            ],
        ];
        // $data['sm'] = $this->db->get('surat_masuk')->row_array();
        // var_dump($data);
        echo view('frontend/header2', $data);
        echo view('frontend/result',$data);
        echo view('frontend/footer2',$data);
    }

}
