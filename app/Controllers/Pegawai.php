<?php

namespace App\Controllers;

use App\Models\M_Pegawai;

// defined('BASEPATH') or exit('No direct script access allowed');

class Pegawai extends BaseController
{
    protected $M_Pegawai;

    public function __construct()
    {
        $this->M_Pegawai = new M_Pegawai;
    }


    public function index()
    {

        $data = [
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
            'title' => 'Management Pegawai',
            'sub_title' => '',
            'data' => $this->M_Pegawai->findAll(),
        ];
        echo view('templates/header', $data);
        echo view('pegawai/index', $data);
        echo view('templates/footer');
    }

    public function tambah()
    {
        $data = [
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
            'title' => 'Management Pegawai',
            'sub_title' => 'Tambah Pegawai',
            'validation' => \Config\Services::validation(),
        ];

        echo view('templates/header', $data);
        echo view('pegawai/tambah');
        echo view('templates/footer');
    }

    public function create()
    {
        if(!$this->validate([
            'nama' => 'trim|required',
            'nip' => 'trim|required',
            'tempat_lahir' => 'trim|required',
            'tanggal_lahir' => 'trim|required',
            'alamat' => 'trim|required',
            'no_hp' => 'trim|required',
            'jabatan' => 'trim|required',
            'pendidikan' => 'trim|required',
            
        ]))
        {
            $validation = \Config\Services::validation();
            return redirect()->to('/pegawai/tambah')->withInput()->with('validation',$validation);
        }
        else
        {
            $data = [
                'nama' => $this->request->getPost("nama"),
                'nip' => $this->request->getPost("nip"),
                'tempat_lahir' => $this->request->getPost("tempat_lahir"),
                'tanggal_lahir' => $this->request->getPost("tanggal_lahir"),
                'alamat' => $this->request->getPost("alamat"),
                'no_hp' => $this->request->getPost("no_hp"),
                'jabatan' => $this->request->getPost("jabatan"),
                'pendidikan' =>$this->request->getPost("pendidikan") 
            ];

            $this->M_Pegawai->insert($data);
            session()->setFlashdata('success', 'Berhasil Ditambahkan!');
            return redirect()->to('/pegawai/tambah');

            // $config['upload_path']          = './uploads/foto';
            // $config['allowed_types']        = 'png|jpg|jpeg';
            // if ($this->upload->do_upload('foto')) {

            //     $data = array('upload_data' => $this->upload->data());
            //     $foto = $data['upload_data']['file_name'];

            //     $save = [
            //         'nama' => $nama,
            //         'nip' => $nip,
            //         'tempat_lahir' => $tempat_lahir,
            //         'tanggal_lahir' => date('Y-m-d', strtotime($tanggal_lahir)),
            //         'alamat' => $alamat,
            //         'foto' => $foto,
            //         'no_hp' => $no_hp,
            //         'jabatan' => $jabatan,
            //         'pendidikan' => $pendidikan

            //     ];
            // }
        }
    }

    public function edit($id)
    {

        $this->form_validation->set_rules('nama', 'Nama', 'required|trim');
        $this->form_validation->set_rules('nip', 'NIP', 'required|trim');
        $this->form_validation->set_rules('tempat_lahir', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('tanggal_lahir', 'Tanggal Lahir', 'required');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required|trim');
        $this->form_validation->set_rules('no_hp', 'No Hp', 'required|trim');
        $this->form_validation->set_rules('jabatan', 'Jabatan', 'required|trim');
        $this->form_validation->set_rules('pendidikan', 'Pendidikan', 'required|trim');


        if ($this->form_validation->run() == FALSE) {
            $judul = [
                'title' => 'Management User',
                'sub_title' => 'Surat Masuk'
            ];

            $data['pegawai'] = $this->db->get_where('pegawai', ['id_pegawai' => $id])->row_array();
            $this->load->view('templates/header', $judul);
            $this->load->view('pegawai/edit', $data);
            $this->load->view('templates/footer');
        } else {
            // $data = $this->db->get_where('pegawai', ['id_pegawai' => $id])->row_array();
            // unlink("./uploads/foto/" . $data['foto']);

            $nama =  $this->input->post("nama", TRUE);
            $nip =  $this->input->post("nip", TRUE);
            $tempat_lahir =  $this->input->post("tempat_lahir", TRUE);
            $tanggal_lahir =  $this->input->post("tanggal_lahir", TRUE);
            $alamat =  $this->input->post("alamat", TRUE);
            $no_hp =  $this->input->post("no_hp", TRUE);
            $jabatan =  $this->input->post("jabatan", TRUE);
            $pendidikan =  $this->input->post("pendidikan", TRUE);

            $config['upload_path']          = './uploads/foto';
            $config['allowed_types']        = 'png|jpg|jpeg';
            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto')) {
                $data = $this->db->get_where('pegawai', ['id_pegawai' => $id])->row_array();
                unlink("./uploads/foto/" . $data['foto']);

                $data = array('upload_data' => $this->upload->data());
                $foto = $data['upload_data']['file_name'];

                $update = [
                    'nama' => $nama,
                    'nip' => $nip,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => date('Y-m-d', strtotime($tanggal_lahir)),
                    'alamat' => $alamat,
                    'foto' => $foto,
                    'no_hp' => $no_hp,
                    'jabatan' => $jabatan,
                    'pendidikan' => $pendidikan

                ];

                $this->db->where('id_pegawai', $id);
                $this->db->update('pegawai', $update);

                $this->session->set_flashdata('success', 'Berhasil Diupdate!');
                redirect(base_url("pegawai"));
            } else {
                $update = [
                    'nama' => $nama,
                    'nip' => $nip,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => date('Y-m-d', strtotime($tanggal_lahir)),
                    'alamat' => $alamat,
                    'no_hp' => $no_hp,
                    'jabatan' => $jabatan,
                    'pendidikan' => $pendidikan

                ];

                $this->db->where('id_pegawai', $id);
                $this->db->update('pegawai', $update);

                $this->session->set_flashdata('success', 'Berhasil Diupdate!');
                redirect(base_url("pegawai"));
            }
        }
    }

    public function hapus($id)
    {

        $data = $this->db->get_where('pegawai', ['id_pegawai' => $id])->row_array();

        unlink("./uploads/foto/" . $data['foto']);

        $this->db->where(['id_pegawai' => $id]);
        $this->db->delete('pegawai');
        $this->session->set_flashdata('success', 'Berhasil Dihapus!');
        redirect(base_url('pegawai'));
    }
}
