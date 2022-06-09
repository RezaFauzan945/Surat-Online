<?php

namespace App\Controllers;

use App\Models\SuratMasuk_model;
use App\Models\SuratKeluar_model;
use App\Models\PengajuanSurat_model;
use App\Models\SuratKeterangan_model;

// defined('BASEPATH') or exit('No direct script access allowed');

class Surat extends BaseController
{
    protected $PengajuanSurat_model;
    protected $SuratMasuk_model;
    protected $SuratKeluar_model;
    protected $SuratKeterangan_model;
    
    public function __construct()
    {
        // parent::__construct();
        $this->PengajuanSurat_model = new PengajuanSurat_model;
        $this->SuratMasuk_model = new SuratMasuk_model;
        $this->SuratKeluar_model = new SuratKeluar_model;
        $this->SuratKeterangan_model = new SuratKeterangan_model;
    }

    public function surat_masuk()
    {
        $data = [
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
            'title' => 'Management Surat',
            'sub_title' => 'Surat Masuk',
            'data' => $this->SuratMasuk_model->findAll(),
        ];

        echo view('templates/header', $data);
        echo view('surat/masuk', $data);
        echo view('templates/footer', $data);
    }

    public function tambah_surat_masuk()
    {

        $data = [
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
            'title' => 'Management Surat',
            'sub_title' => 'Tambah Surat Masuk',
            'validation' => \Config\Services::validation(),
        ];

        echo view('templates/header', $data);
        echo view('surat/tambah_surat_masuk');
        echo view('templates/footer');
    }

    public function edit_surat_masuk($id)
    {

        $data = [
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
            'title' => 'Management Surat',
            'sub_title' => 'Edit Surat Masuk',
            'validation' => \Config\Services::validation(),
            'surat_masuk' => $this->SuratMasuk_model->where('id_surat_masuk', $id)->first(),
        ];

        echo view('templates/header', $data);
        echo view('surat/edit_surat_masuk');
        echo view('templates/footer');
    }
    
    public function create_surat_masuk()
    {
        if(!$this->validate([
            'nama_surat' => 'trim|required',
            'tanggal_surat' => 'trim|required',
            'keterangan_surat' => 'trim|required',
            'file_surat' => 'uploaded[file_surat]|ext_in[file_surat,pdf,doc,docx]'
        ]))
        {
            $validation = \Config\Services::validation();
            return redirect()->to('/surat/tambah_surat_masuk')->withInput();
        }
        else {
            $file = $this->request->getFile('file_surat');
            $data = [
                'nama_surat_masuk' => $this->request->getPost("nama_surat"),
                'tanggal_surat_masuk' => date('Y-m-d', strtotime($this->request->getPost("tanggal_surat"))),
                'keterangan_surat_masuk' => $this->request->getPost("keterangan_surat"),
                'file_surat_masuk' => $file->getName()
            ];
            $this->SuratMasuk_model->insert($data);
            $file->move('assets/uploads/surat/surat_masuk');
            session()->setFlashdata('success', 'Berhasil Ditambahkan!');
            return redirect()->to('/surat/tambah_surat_masuk');
        }
    }

    public function hapus_surat_masuk($id)
    {
        $data = $this->SuratMasuk_model->where('id_surat_masuk' , $id)->first();
        $this->SuratMasuk_model->delete($id);
        // unlink('/assets/uploads/surat/surat_masuk/'.$data['file_surat_masuk']);
        session()->setFlashdata('success', 'Berhasil Dihapus!');
        return redirect()->to('/surat_masuk')->withInput();
    }

    public function update_surat_masuk($id)
    {
        if(!$this->validate([
            'nama_surat' => 'trim|required',
            'tanggal_surat' => 'trim|required',
            'keterangan_surat' => 'trim|required',
            'file_surat' => 'uploaded[file_surat]|ext_in[file_surat,pdf,doc,docx]'
        ]))
        {
            $validation = \Config\Services::validation();
            return redirect()->to('/surat/edit_surat_masuk/'.$id)->withInput();
        }
        else {
            $file = $this->request->getFile('file_surat');
            $data = [
                'id_surat_masuk' => $id,
                'nama_surat_masuk' => $this->request->getPost("nama_surat"),
                'tanggal_surat_masuk' => date('Y-m-d', strtotime($this->request->getPost("tanggal_surat"))),
                'keterangan_surat_masuk' => $this->request->getPost("keterangan_surat"),
                'file_surat_masuk' => $file->getName(),
                'surat_masuk' => $this->SuratMasuk_model->where('id_surat_masuk', $id)->first(),
            ];
            // unlink('/assets/uploads/surat/surat_masuk/'.$data['surat_masuk']['file_surat_masuk']);
            $this->SuratMasuk_model->save($data);
            $file->move('assets/uploads/surat/surat_masuk');
            session()->setFlashdata('success', 'Berhasil DiUpdate!');
            return redirect()->to('/surat/edit_surat_masuk/'.$id);
        }
    }
    // public function hapusSuratMasuk($id)
    // {

    //     $data = $this->db->get_where('surat_masuk', ['id_surat_masuk' => $id])->row_array();

        // unlink("./uploads/surat_masuk/" . $data['file_surat_masuk']);

    //     $this->db->where(['id_surat_masuk' => $id]);

    //     $this->db->delete('surat_masuk');

    //     $this->session->set_flashdata('success', 'Berhasil Dihapus!');

    //     redirect(base_url('surat/surat_masuk'));
    // }

    // public function editSuratMasuk($id)
    // {

    //     $this->form_validation->set_rules('nama_surat', 'Nama Surat', 'required');
    //     $this->form_validation->set_rules('tanggal_surat', 'Keterangan', 'required');
    //     $this->form_validation->set_rules('keterangan_surat', 'Keterangan', 'required');
    //     // $this->form_validation->set_rules('file_surat', 'Keterangan', 'required');

    //     if ($this->form_validation->run() == FALSE) {
    //         $judul = [
    //             'title' => 'Management Surat',
    //             'sub_title' => 'Surat Masuk'
    //         ];
    //         $data['surat_masuk'] = $this->db->get_where('surat_masuk', ['id_surat_masuk' => $id])->row_array();

    //         echo view('templates/header', $judul);
    //         echo view('surat/edit_surat_masuk', $data);
    //         echo view('templates/footer');
    //     } else {
    //         $nama_surat =  $this->input->post("nama_surat", TRUE);
    //         $tanggal_surat =  $this->input->post("tanggal_surat", TRUE);
    //         $keterangan_surat =  $this->input->post("keterangan_surat", TRUE);
    //         // $file_surat =  $this->input->post("file_surat", TRUE);

    //         $config['upload_path']          = './uploads/surat_masuk';
    //         $config['allowed_types']        = 'pdf|doc|docx';
    //         $this->load->library('upload', $config);

    //         if ($this->upload->do_upload('file_surat')) {
    //             $data = $this->db->get_where('surat_masuk', ['id_surat_masuk' => $id])->row_array();
                // unlink("./uploads/surat_masuk/" . $data['file_surat_masuk']);

    //             $data = array('upload_data' => $this->upload->data());
    //             $file_surat = $data['upload_data']['file_name'];

    //             $update = [
    //                 'nama_surat_masuk' => $nama_surat,
    //                 'tanggal_surat_masuk' => date('Y-m-d', strtotime($tanggal_surat)),
    //                 'keterangan_surat_masuk' => $keterangan_surat,
    //                 'file_surat_masuk' => $file_surat
    //             ];

    //             $this->db->where('id_surat_masuk', $id);
    //             $this->db->update('surat_masuk', $update);
    //             $this->session->set_flashdata('success', 'Berhasil Diedit!');
    //             redirect(base_url("surat/surat_masuk"));
    //         } else {

    //             $update = [
    //                 'nama_surat_masuk' => $nama_surat,
    //                 'tanggal_surat_masuk' => date('Y-m-d', strtotime($tanggal_surat)),
    //                 'keterangan_surat_masuk' => $keterangan_surat,
    //             ];

    //             $this->db->where('id_surat_masuk', $id);
    //             $this->db->update('surat_masuk', $update);
    //             $this->session->set_flashdata('success', 'Berhasil Diedit!');
    //             redirect(base_url("surat/surat_masuk"));
    //         }
    //     }
    // }

    public function surat_keluar()
    {
        $data = [
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
            'title' => 'Management Surat',
            'sub_title' => 'Surat Keluar',
            'data' => $this->SuratKeluar_model->findAll(),
        ];

        echo view('templates/header', $data);
        echo view('surat/keluar', $data);
        echo view('templates/footer');
    }

    public function tambah_surat_keluar()
    {

        $data = [
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
            'title' => 'Management Surat',
            'sub_title' => 'Tambah Surat Keluar',
            'validation' => \Config\Services::validation(),
        ];

        echo view('templates/header', $data);
        echo view('surat/tambah_surat_keluar');
        echo view('templates/footer');
    }

    public function create_surat_keluar()
    {
        if(!$this->validate([
            'nama_surat' => 'trim|required',
            'tanggal_surat' => 'trim|required',
            'keterangan_surat' => 'trim|required',
            'file_surat' => 'uploaded[file_surat]|ext_in[file_surat,pdf,doc,docx]'
        ]))
        {
            $validation = \Config\Services::validation();
            return redirect()->to('/surat/tambah_surat_keluar')->withInput();
        }
        else {
            $file = $this->request->getFile('file_surat');
            $data = [
                'nama_surat_keluar' => $this->request->getPost("nama_surat"),
                'tanggal_surat_keluar' => date('Y-m-d', strtotime($this->request->getPost("tanggal_surat"))),
                'keterangan_surat_keluar' => $this->request->getPost("keterangan_surat"),
                'file_surat_keluar' => $file->getName()
            ];
            $this->SuratKeluar_model->insert($data);
            $file->move('assets/uploads/surat/surat_keluar');
            session()->setFlashdata('success', 'Berhasil Ditambahkan!');
            return redirect()->to('/surat/tambah_surat_keluar');
        }
    }

    public function edit_surat_keluar($id)
    {

        $data = [
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
            'title' => 'Management Surat',
            'sub_title' => 'Edit Surat Keluar',
            'validation' => \Config\Services::validation(),
            'surat_keluar' => $this->SuratKeluar_model->where('id_surat_keluar', $id)->first(),
        ];

        echo view('templates/header', $data);
        echo view('surat/edit_surat_keluar');
        echo view('templates/footer');
    }

    public function update_surat_keluar($id)
    {
        if(!$this->validate([
            'nama_surat' => 'trim|required',
            'tanggal_surat' => 'trim|required',
            'keterangan_surat' => 'trim|required',
            'file_surat' => 'uploaded[file_surat]|ext_in[file_surat,pdf,doc,docx]'
        ]))
        {
            $validation = \Config\Services::validation();
            return redirect()->to('/surat/edit_surat_keluar/'.$id)->withInput();
        }
        else {
            $file = $this->request->getFile('file_surat');
            $data = [
                'id_surat_keluar' => $id,
                'nama_surat_keluar' => $this->request->getPost("nama_surat"),
                'tanggal_surat_keluar' => date('Y-m-d', strtotime($this->request->getPost("tanggal_surat"))),
                'keterangan_surat_keluar' => $this->request->getPost("keterangan_surat"),
                'file_surat_keluar' => $file->getName(),
                'surat_keluar' => $this->SuratKeluar_model->where('id_surat_keluar', $id)->first(),
            ];
            // unlink('/assets/uploads/surat/surat_keluar/'.$data['surat_keluar']['file_surat_keluar']);
            $this->SuratKeluar_model->save($data);
            $file->move('assets/uploads/surat/surat_keluar');
            session()->setFlashdata('success', 'Berhasil DiUpdate!');
            return redirect()->to('/surat/edit_surat_keluar/'.$id);
        }
    }
    
    
    public function hapus_surat_keluar($id)
    {
        $data = $this->SuratKeluar_model->where('id_surat_keluar' , $id)->first();
        $this->SuratKeluar_model->delete($id);
        // unlink('/assets/uploads/surat/surat_keluar/'.$data['file_surat_keluar']);
        session()->setFlashdata('success', 'Berhasil Dihapus!');
        return redirect()->to('/surat_keluar')->withInput();
    }

    // public function tambah_surat_keluar()
    // {

    //     $this->form_validation->set_rules('nama_surat', 'Nama Surat', 'required');
    //     $this->form_validation->set_rules('tanggal_surat', 'Keterangan', 'required');
    //     $this->form_validation->set_rules('keterangan_surat', 'Keterangan', 'required');
    //     // $this->form_validation->set_rules('file_surat', 'Keterangan', 'required');

    //     if ($this->form_validation->run() == FALSE) {
    //         $judul = [
    //             'title' => 'Management Surat',
    //             'sub_title' => 'Surat Keluar'
    //         ];
    //         echo view('templates/header', $judul);
    //         echo view('surat/tambah_surat_keluar');
    //         echo view('templates/footer');
    //     } else {
    //         $nama_surat =  $this->input->post("nama_surat", TRUE);
    //         $tanggal_surat =  $this->input->post("tanggal_surat", TRUE);
    //         $keterangan_surat =  $this->input->post("keterangan_surat", TRUE);
    //         // $file_surat =  $this->input->post("file_surat", TRUE);

    //         $config['upload_path']          = './uploads/surat_keluar';
    //         $config['allowed_types']        = 'pdf|doc|docx';
    //         $this->load->library('upload', $config);

    //         if ($this->upload->do_upload('file_surat')) {

    //             $data = array('upload_data' => $this->upload->data());
    //             $file_surat = $data['upload_data']['file_name'];

    //             $save = [
    //                 'nama_surat_keluar' => $nama_surat,
    //                 'tanggal_surat_keluar' => date('Y-m-d', strtotime($tanggal_surat)),
    //                 'keterangan_surat_keluar' => $keterangan_surat,
    //                 'file_surat_keluar' => $file_surat
    //             ];

    //             $this->db->insert('surat_keluar', $save);
    //             $this->session->set_flashdata('success', 'Berhasil Ditambahkan!');
    //             redirect(base_url("surat/surat_keluar"));
    //         }
    //     }
    // }

    // public function hapusSuratKeluar($id)
    // {

    //     $data = $this->db->get_where('surat_keluar', ['id_surat_keluar' => $id])->row_array();

        // unlink("./uploads/surat_keluar/" . $data['file_surat_keluar']);

    //     $this->db->where(['id_surat_keluar' => $id]);

    //     $this->db->delete('surat_keluar');

    //     $this->session->set_flashdata('success', 'Berhasil Dihapus!');

    //     redirect(base_url('surat/surat_keluar'));
    // }

    // public function editSuratKeluar($id)
    // {

    //     $this->form_validation->set_rules('nama_surat', 'Nama Surat', 'required');
    //     $this->form_validation->set_rules('tanggal_surat', 'Keterangan', 'required');
    //     $this->form_validation->set_rules('keterangan_surat', 'Keterangan', 'required');
    //     // $this->form_validation->set_rules('file_surat', 'Keterangan', 'required');

    //     if ($this->form_validation->run() == FALSE) {
    //         $judul = [
    //             'title' => 'Management Surat',
    //             'sub_title' => 'Surat Keluar'
    //         ];
    //         $data['surat_keluar'] = $this->db->get_where('surat_keluar', ['id_surat_keluar' => $id])->row_array();

    //         echo view('templates/header', $judul);
    //         echo view('surat/edit_surat_keluar', $data);
    //         echo view('templates/footer');
    //     } else {
    //         $nama_surat =  $this->input->post("nama_surat", TRUE);
    //         $tanggal_surat =  $this->input->post("tanggal_surat", TRUE);
    //         $keterangan_surat =  $this->input->post("keterangan_surat", TRUE);
    //         // $file_surat =  $this->input->post("file_surat", TRUE);

    //         $config['upload_path']          = './uploads/surat_keluar';
    //         $config['allowed_types']        = 'pdf|doc|docx';
    //         $this->load->library('upload', $config);

    //         if ($this->upload->do_upload('file_surat')) {
    //             $data = $this->db->get_where('surat_keluar', ['id_surat_keluar' => $id])->row_array();
                // unlink("./uploads/surat_keluar/" . $data['file_surat_keluar']);

    //             $data = array('upload_data' => $this->upload->data());
    //             $file_surat = $data['upload_data']['file_name'];

    //             $update = [
    //                 'nama_surat_keluar' => $nama_surat,
    //                 'tanggal_surat_keluar' => date('Y-m-d', strtotime($tanggal_surat)),
    //                 'keterangan_surat_keluar' => $keterangan_surat,
    //                 'file_surat_keluar' => $file_surat
    //             ];

    //             $this->db->where('id_surat_keluar', $id);
    //             $this->db->update('surat_keluar', $update);
    //             $this->session->set_flashdata('success', 'Berhasil Diedit!');
    //             redirect(base_url("surat/surat_keluar"));
    //         } else {

    //             $update = [
    //                 'nama_surat_keluar' => $nama_surat,
    //                 'tanggal_surat_keluar' => date('Y-m-d', strtotime($tanggal_surat)),
    //                 'keterangan_surat_keluar' => $keterangan_surat
    //             ];

    //             $this->db->where('id_surat_keluar', $id);
    //             $this->db->update('surat_keluar', $update);
    //             $this->session->set_flashdata('success', 'Berhasil Diedit!');
    //             redirect(base_url("surat/surat_keluar"));
    //         }
    //     }
    // }

    public function surat_keterangan()
    {
        $data = [
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
            'title' => 'Management Surat',
            'sub_title' => 'Surat Keterangan',
            'data' => $this->SuratKeterangan_model->findAll(),
        ];

        echo view('templates/header', $data);
        echo view('surat/keterangan', $data);
        echo view('templates/footer');
    }

    public function tambah_surat_keterangan()
    {

        $data = [
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
            'title' => 'Management Surat',
            'sub_title' => 'Tambah Surat Keterangan',
            'validation' => \Config\Services::validation(),
        ];

        echo view('templates/header', $data);
        echo view('surat/tambah_surat_keterangan');
        echo view('templates/footer');
    }

    public function create_surat_keterangan()
    {
        if(!$this->validate([
            'nama_surat' => 'trim|required',
            'tanggal_surat' => 'trim|required',
            'keterangan_surat' => 'trim|required',
            'file_surat' => 'uploaded[file_surat]|ext_in[file_surat,pdf,doc,docx]'
        ]))
        {
            $validation = \Config\Services::validation();
            return redirect()->to('/surat/tambah_surat_keterangan')->withInput();
        }
        else {
            $file = $this->request->getFile('file_surat');
            $data = [
                'nama_surat_keterangan' => $this->request->getPost("nama_surat"),
                'tanggal_surat_keterangan' => date('Y-m-d', strtotime($this->request->getPost("tanggal_surat"))),
                'keterangan_surat_keterangan' => $this->request->getPost("keterangan_surat"),
                'file_surat_keterangan' => $file->getName()
            ];
            $this->SuratKeterangan_model->insert($data);
            $file->move('assets/uploads/surat/surat_keterangan');
            session()->setFlashdata('success', 'Berhasil Ditambahkan!');
            return redirect()->to('/surat/tambah_surat_keterangan');
        }
    }

    public function edit_surat_keterangan($id)
    {

        $data = [
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
            'title' => 'Management Surat',
            'sub_title' => 'Edit Surat Keterangan',
            'validation' => \Config\Services::validation(),
            'surat_keterangan' => $this->SuratKeterangan_model->where('id_surat_keterangan', $id)->first(),
        ];

        echo view('templates/header', $data);
        echo view('surat/edit_surat_keterangan');
        echo view('templates/footer');
    }

    public function update_surat_keterangan($id)
    {
        if(!$this->validate([
            'nama_surat' => 'trim|required',
            'tanggal_surat' => 'trim|required',
            'keterangan_surat' => 'trim|required',
            'file_surat' => 'uploaded[file_surat]|ext_in[file_surat,pdf,doc,docx]'
        ]))
        {
            $validation = \Config\Services::validation();
            return redirect()->to('/surat/edit_surat_keterangan/'.$id)->withInput();
        }
        else {
            $file = $this->request->getFile('file_surat');
            $data = [
                'id_surat_keterangan' => $id,
                'nama_surat_keterangan' => $this->request->getPost("nama_surat"),
                'tanggal_surat_keterangan' => date('Y-m-d', strtotime($this->request->getPost("tanggal_surat"))),
                'keterangan_surat_keterangan' => $this->request->getPost("keterangan_surat"),
                'file_surat_keterangan' => $file->getName(),
                'surat_keterangan' => $this->SuratKeterangan_model->where('id_surat_keterangan', $id)->first(),
            ];
            // unlink('/assets/uploads/surat/surat_keterangan/'.$data['surat_keterangan']['file_surat_keterangan']);
            $this->SuratKeterangan_model->save($data);
            $file->move('assets/uploads/surat/surat_keterangan');
            session()->setFlashdata('success', 'Berhasil DiUpdate!');
            return redirect()->to('/surat/edit_surat_keterangan/'.$id);
        }
    }

    public function hapus_surat_keterangan($id)
    {
        $data = $this->SuratKeterangan_model->where('id_surat_keterangan' , $id)->first();
        $this->SuratKeterangan_model->delete($id);
        // unlink('/assets/uploads/surat/surat_keterangan/'.$data['file_surat_keterangan']);
        session()->setFlashdata('success', 'Berhasil Dihapus!');
        return redirect()->to('/surat_keterangan')->withInput();
    }

    public function editSuratKeterangan($id)
    {

        $this->form_validation->set_rules('nama_surat', 'Nama Surat', 'required');
        $this->form_validation->set_rules('tanggal_surat', 'Keterangan', 'required');
        $this->form_validation->set_rules('keterangan_surat', 'Keterangan', 'required');
        // $this->form_validation->set_rules('file_surat', 'Keterangan', 'required');

        if ($this->form_validation->run() == FALSE) {
            $judul = [
                'title' => 'Management Surat',
                'sub_title' => 'Surat Keterangan'
            ];
            $data['surat_keterangan'] = $this->db->get_where('surat_keterangan', ['id_surat_keterangan' => $id])->row_array();

            echo view('templates/header', $judul);
            echo view('surat/edit_surat_keterangan', $data);
            echo view('templates/footer');
        } else {
            $nama_surat =  $this->input->post("nama_surat", TRUE);
            $tanggal_surat =  $this->input->post("tanggal_surat", TRUE);
            $keterangan_surat =  $this->input->post("keterangan_surat", TRUE);
            // $file_surat =  $this->input->post("file_surat", TRUE);

            $config['upload_path']          = './uploads/surat_keterangan';
            $config['allowed_types']        = 'pdf|doc|docx';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('file_surat')) {
                $data = $this->db->get_where('surat_keterangan', ['id_surat_keterangan' => $id])->row_array();
                // unlink("./uploads/surat_keterangan/" . $data['file_surat_keterangan']);

                $data = array('upload_data' => $this->upload->data());
                $file_surat = $data['upload_data']['file_name'];

                $update = [
                    'nama_surat_keterangan' => $nama_surat,
                    'tanggal_surat_keterangan' => date('Y-m-d', strtotime($tanggal_surat)),
                    'keterangan_surat_keterangan' => $keterangan_surat,
                    'file_surat_keterangan' => $file_surat
                ];

                $this->db->where('id_surat_keterangan', $id);
                $this->db->update('surat_keterangan', $update);
                $this->session->set_flashdata('success', 'Berhasil Diedit!');
                redirect(base_url("surat/surat_keterangan"));
            } else {

                $update = [
                    'nama_surat_keterangan' => $nama_surat,
                    'tanggal_surat_keterangan' => date('Y-m-d', strtotime($tanggal_surat)),
                    'keterangan_surat_keterangan' => $keterangan_surat,
                ];

                $this->db->where('id_surat_keterangan', $id);
                $this->db->update('surat_keterangan', $update);
                $this->session->set_flashdata('success', 'Berhasil Diedit!');
                redirect(base_url("surat/surat_keterangan"));
            }
        }
    }

    public function pengajuan()
    {
        $data = [
            'user'      => $this->auth->where('id_user', session()->get('id_user'))->first(),
            'title'     => 'Management Surat',
            'sub_title' => 'Pengajuan Surat',
            'data'      => $this->PengajuanSurat_model->select('*')->join('penduduk','penduduk.nik=pengajuan_surat.NIK')->orderBy("tanggal", "DESC")->findAll(),
            'status'    => [
                1 => 'Pending',
                2 => 'Syarat Tidak Terpenuhi',
                3 => 'Diterima dan Dilanjutkan',
                4 => 'Sudah Diketik dan Diparaf',
                5 => 'Ditandatangani Kepala Desa/<b>Selesai</b>',
            ],
            'options'  => [
                'SPKK' => 'Kartu Keluarga',
                'SPNA' => 'Nikah(N.A)',
                'SKKL' => 'Kelahiran',
                'SKKM' => 'Kematian',
                'SKP'  => 'Pindah',
                'SKD'  => 'Datang',
                'SKBM' => 'Belum Menikah',
                'SKPH' => 'Penghasilan',
                'SKM'  => 'Miskin',
                'SKU'  => 'Usaha',
                'SKT'  => 'Tanah',
                'SKGG' => 'Ganti Rugi',
                'SITU' => 'Izin Tempat Usaha',
                'SIMB' => 'Izin Mendirikan Bangunan',
            ]
        ];
       
        echo view('templates/header', $data);
        echo view('surat/pengajuan_surat', $data);
        echo view('templates/footer');
    }


    // public function updateStatus($id)
    // {
    //     $options = [
    //         'SPKK' => 'Kartu Keluarga',
    //         'SPNA' => 'Nikah(N.A)',
    //         'SKKL' => 'Kelahiran',
    //         'SKKM' => 'Kematian',
    //         'SKP' => 'Pindah',
    //         'SKD' => 'Datang',
    //         'SKBM' => 'Belum Menikah',
    //         'SKPH' => 'Penghasilan',
    //         'SKM' => 'Miskin',
    //         'SKU' => 'Usaha',
    //         'SKT' => 'Tanah',
    //         'SKGG' => 'Ganti Rugi',
    //         'SITU' => 'Izin Tempat Usaha',
    //         'SIMB' => 'Izin Mendirikan Bangunan',
    //     ];

    //     $status = $this->input->post('status');

    //     // var_dump($status);
    //     // die;

    //     if ($status == 5) {
    //         $pSurat = $this->db->get_where('pengajuan_surat', ['id' => $id])->row_array();
    //         $pndk = $this->db->get_where('penduduk', ['nik' => $pSurat['NIK']])->row_array();
    //         $dateNow = date('Y-m-d');
    //         // var_dump($pSurat);
    //         // die;

    //         $save = [
    //             'nama_surat_keluar' => '['.$pndk['nama'].'-'.$pndk['nik'].']-Surat '.$options[$pSurat['jenis_surat']],
    //             'tanggal_surat_keluar' => date('Y-m-d', strtotime($dateNow)),
    //             'keterangan_surat_keluar' => 'ID: '.$pSurat['id']
    //         ];

    //         $this->db->insert('surat_keluar', $save);
    //     };

    //     $this->db->set('status', $status);

    //     $this->db->where(['id' => $id]);
    //     $this->db->update('pengajuan_surat');


    //     $this->session->set_flashdata('success', 'Status Pengajuan ID: ' . $id . ' Telah Diupdate!');

    //     redirect(base_url('surat/pengajuan'));
    // }

    // public function hapusPengajuan($id)
    // {

    //     $data = $this->db->get_where('pengajuan_surat', ['id' => $id])->row_array();

        // unlink("./uploads/berkas/" . $data['file']);

    //     $this->db->where(['id' => $id]);

    //     $this->db->delete('pengajuan_surat');

    //     $this->session->set_flashdata('success', 'Pengajuan ID: ' . $id . ' Telah Dihapus!');
    //     redirect(base_url('surat/pengajuan'));
    // }
}
