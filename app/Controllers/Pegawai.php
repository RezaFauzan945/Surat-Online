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
        if(session()->get('level') != 'administrator')
        {
            return redirect()->to('/dashboard');
        }
        else
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
            'foto' =>   'uploaded[foto]|is_image[foto]|max_size[foto,2048]|max_dims[foto,1024,768]'
        ]))
        {
            $validation = \Config\Services::validation();
            return redirect()->to('/pegawai/tambah')->withInput();
        }
        else
        {
            $foto = $this->request->getFile('foto');
            $data = [
                'nama' => $this->request->getPost("nama"),
                'nip' => $this->request->getPost("nip"),
                'tempat_lahir' => $this->request->getPost("tempat_lahir"),
                'tanggal_lahir' => $this->request->getPost("tanggal_lahir"),
                'alamat' => $this->request->getPost("alamat"),
                'no_hp' => $this->request->getPost("no_hp"),
                'jabatan' => $this->request->getPost("jabatan"),
                'pendidikan' =>$this->request->getPost("pendidikan"),
                'foto' => $foto->getName() 
            ];
            
            $this->M_Pegawai->insert($data);
            $foto->move('assets/uploads/foto/');
            session()->setFlashdata('success', 'Berhasil Ditambahkan!');
            return redirect()->to('/pegawai/tambah');

            
        }
    }

    public function edit($id)
    {
        $data = [
            'title' => 'Pegawai',
            'sub_title' => 'Edit Pegawai',
            'validation' => \Config\Services::validation(),
            'pegawai' => $this->M_Pegawai->find($id),
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
        ];

       echo view('templates/header', $data);
       echo view('pegawai/edit', $data);
       echo view('templates/footer'); 
    }

    public function update($id)
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
            return redirect()->to('/penduduk/edit/'.$id)->withInput()->with('validation',$validation);
        }else {
            // $data = $this->db->get_where('pegawai', ['id_pegawai' => $id])->row_array();
            // unlink("./uploads/foto/" . $data['foto']);
            $data = [
                'id_pegawai'    => $id,
                'nama'          => $this->request->getPost('nama'),
                'nip'           => $this->request->getPost('nip') ,
                'tempat_lahir'  => $this->request->getPost('tempat_lahir') ,
                'tanggal_lahir' => $this->request->getPost('tanggal_lahir') ,
                'alamat'        => $this->request->getPost('alamat') ,
                'no_hp'         => $this->request->getPost('no_hp') ,
                'jabatan'       => $this->request->getPost('jabatan') ,
                'pendidikan'    => $this->request->getPost('pendidikan') ,
                
            ];
            $this->M_Pegawai->save($data);
            session()->setFlashdata('success', 'Berhasil Diupdate!');
            return redirect()->to('pegawai/edit/'.$id);

            // $config['upload_path']          = './uploads/foto';
            // $config['allowed_types']        = 'png|jpg|jpeg';
            // $this->load->library('upload', $config);

            // if ($this->upload->do_upload('foto')) {
            //     $data = $this->db->get_where('pegawai', ['id_pegawai' => $id])->row_array();
            //     unlink("./uploads/foto/" . $data['foto']);

            //     $data = array('upload_data' => $this->upload->data());
            //     $foto = $data['upload_data']['file_name'];

            //     $update = [
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

            //     $this->db->where('id_pegawai', $id);
            //     $this->db->update('pegawai', $update);

            //     $this->session->set_flashdata('success', 'Berhasil Diupdate!');
            //     redirect(base_url("pegawai"));
            // } else {
            //     $update = [
            //         'nama' => $nama,
            //         'nip' => $nip,
            //         'tempat_lahir' => $tempat_lahir,
            //         'tanggal_lahir' => date('Y-m-d', strtotime($tanggal_lahir)),
            //         'alamat' => $alamat,
            //         'no_hp' => $no_hp,
            //         'jabatan' => $jabatan,
            //         'pendidikan' => $pendidikan

            //     ];

            //     $this->db->where('id_pegawai', $id);
            //     $this->db->update('pegawai', $update);

            //     $this->session->set_flashdata('success', 'Berhasil Diupdate!');
            //     redirect(base_url("pegawai"));
            // }
        }
    }

    public function delete($id)
    {
        $data = $this->M_Pegawai->find($id);
        unlink("assets/uploads/foto/" . $data['foto']);
        $this->M_Pegawai->delete($id);
        session()->setFlashdata('success', 'Berhasil Dihapus!');
        return redirect()->to('/pegawai')->withInput();
    }
}
