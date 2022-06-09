<?php

namespace App\Controllers;

use App\Models\Galery_model;
use App\Models\M_Penduduk;
use App\Models\Pengajuan_track_model;

// defined('BASEPATH') or exit('No direct script access allowed');

class SuratOnline extends BaseController
{
    protected $galeryModel;
    protected $Pengajuan_track_model;
    protected $M_Penduduk;

    public function __construct()
    {
        // parent::__construct();
        $this->galeryModel = new Galery_model();
        $this->Pengajuan_track_model = new Pengajuan_track_model;
        $this->M_Penduduk = new M_Penduduk;
        helper('form');
    }

    public function index()
    {
        // $data = $this->dashboard->user();
        $data = [
            'profil' => $this->galeryModel->first(),
            'title' => 'Pengajuan Surat Online',
            'sub_title' => '',
            'options' => [
                null => 'Pilih',
                'Surat Pengantar:' => [
                    'SPKK' => 'Kartu Keluarga',
                    'SPNA' => 'Nikah(N.A)',
                ],
                'Surat Keterangan:' => [
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
                ],
                'Rekomendasi Surat:' => [
                    'SITU' => 'Izin Tempat Usaha',
                    'SIMB' => 'Izin Mendirikan Bangunan',
                ],
            ],
            'validation' => \Config\Services::validation()
        ];
        
        echo view('frontend/header2', $data);
        echo view('frontend/s_online', $data);
        echo view('frontend/footer2', $data);
    }

    public function ajukan()
    {
        $status = [
            1 => 1,  // Pending
            2 => 2,  // Diterima dan Dilanjutkan
            3 => 3,  // Sudah Diketik dan Diparaf
            4 => 4,  // Sudah Ditandatangani Lurah dan Selesai
        ];

        $nama        = $this->request->getPost('nama');
        $nik         = $this->request->getPost('nik');
        $no_hp       = $this->request->getPost('no_hp');
        $jenis_surat = $this->request->getPost('jenis_surat');

        $ceknik = $this->M_Penduduk->where('nik',$nik)->countAllResults();

        if ($ceknik <= 0) {
            $save = [
                'nik' => $nik,
                'nama' => $nama,
                'no_hp' => $no_hp,
            ];

            $this->M_Penduduk->insert($save);
            // $this->session->set_flashdata('success', '<div class="alert alert-warning alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-cross"></i> Maaf!</h5> NIK Anda tidak Terdaftar!</div>');
            // redirect(base_url("suratonline"));
        }

        //Output a v4 UUID 
        $rid = uniqid($jenis_surat, TRUE);
        $rid2 = str_replace('.', '', $rid);
        $rid3 = substr(str_shuffle($rid2), 0, 3);
        
        $cc = $this->Pengajuan_track_model->countAllResults() + 1;
        $count = str_pad($cc, 3, STR_PAD_LEFT);
        $id = $jenis_surat . "-";
        $d = date('d');
        $y = date('y');
        $mnth = date("m");
        $s = date('s');
        $randomize = $d + $y + $mnth + $s;
        $id = $id . $rid3 . $randomize . $count . $y;

        if(!$this->validate([
            'nik'  =>[
                'rules' => 'required|trim|is_natural_no_zero|min_length[16]',
                'errors' =>[
                    'required' => '{field} Harus diisi!',
                    'is_natural_no_zero' => '{field} Tolong hanya isi dengan angka Yang Benar!',
                    'min_length'=> '{field} minimal 16 Angka'
                ],
            ],
            'nama'  =>[
                'rules' => 'required|trim|alpha_space',
                'errors' =>[
                    'required' => '{field} harus diisi!',
                    'alpha_space' => '{field} Tolong Isi hanya dengan huruf dan nama yang benar'
                ],
            ],
            'no_hp'  =>[
                'rules' => 'required|trim|is_natural|min_length[10]',
                'errors' =>[
                    'required' => 'No Handphone harus diisi!',
                    'is_natural' => 'No Handphone Tolong hanya isi dengan angka Yang Benar!',
                    'min_length'=> 'No Handphone minimal 10 Angka'
                ],
            ],
            'jenis_surat'  =>[
                'rules' => 'required|trim',
                'errors' =>[
                    'required' => 'Jenis Surat harus dipilih!'
                ],
            ],
            'file' => [
                'rules' => 'uploaded[file]|max_size[file,5120]',
                'errors' => [
                    'uploaded' => '{field} harus diunggah dan pastikan sesuai dengan persyaratan sesuai jenis surat!',
                    'max_size' => '{field} melebihi 5MB!'
                ],
            ],   
        ]))
        {
            return redirect()->to('/surat_online')->withInput();
        }
        else
        {
            $file = $this->request->getFile('file');
            $namafile = substr($file->getName(), -7);
            $fileName = $jenis_surat . uniqid() . $namafile;
            if ($file->getName() == null) {
                $fileName = '-';
            }
            $data = [
                'id' => $id,
                'NIK' => $nik,
                'nama' => $nama,
                'no_hp' => $no_hp,
                'jenis_surat' => $jenis_surat,
                'file' => $fileName,
                'tanggal' => date('Y-m-d'),
                'status' => $status[1]
            ];
            $this->Pengajuan_track_model->insert($data);
            $file->move('assets/uploads/berkas/' , $fileName);
            session()->setFlashdata('success', '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><h5><i class="icon fas fa-check"></i> Selamat!</h5> Berhasil Mengajukan Surat! Berikut <b>ID</b> anda: <b>' . $id . '</b></div>');
            return redirect()->to('/surat_online');
        }
    }
}
