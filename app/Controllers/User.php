<?php

namespace App\Controllers;

use App\Models\User_model;


// defined('BASEPATH') or exit('No direct script access allowed');

class User extends BaseController
{
    protected $User_model;

    public function __construct()
    {
        // parent::__construct();
        $this->User_model = new User_model;
    }

    public function index()
    {

        $data = [
            'title' => 'Management User',
            'sub_title' => '',
            'data' => $this->User_model->findAll(),
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
        ];
        echo view('templates/header', $data);
        echo view('user/index', $data);
        echo view('templates/footer');
    }

    public function hapus($id)
    {
        $this->db->where(['id_user' => $id]);
        $this->db->delete('user');
        $this->session->set_flashdata('success', 'Berhasil Dihapus!');
        redirect(base_url('user'));
    }

    public function tambah()
    {
        $data = [
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
            'title' => 'Management User',
            'sub_title' => 'Tambah User',
            'validation' => \Config\Services::validation(),
        ];

        echo view('templates/header', $data);
        echo view('user/tambah');
        echo view('templates/footer');

    }

    public function create()
    {
        if(!$this->validate([
            'username'  => 'required|min_length[8]|trim|is_unique[user.username]',
            'password'  => 'required|trim|min_length[8]|matches[password2]',
            'password2' => 'required|trim|min_length[8]|matches[password]',
            'level'     => 'required',
        ]))
        {
            $validation = \Config\Services::validation();
            return redirect()->to('/user/tambah')->withInput();
        } 
        else {

            $data = [
                'username' =>  $this->request->getPost("username"),
                'password' =>  $this->request->getPost("password"),
                'level'    =>  $this->request->getPost("level"),
            ];
            
            $this->User_model->insert($data);

            session()->setFlashdata('success', 'Berhasil Ditambahkan!');
            return redirect()->to('/user/tambah');
        }
        // $this->form_validation->set_rules('file_surat', 'Keterangan', 'required');
    }

    public function edit($id)
    {
        $data = [
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
            'userdata' => $this->auth->where('id_user', $id)->first(),
            'title' => 'Management User',
            'sub_title' => 'Edit User',
            'validation' => \Config\Services::validation(),

        ];

        echo view('templates/header', $data);
        echo view('user/edit');
        echo view('templates/footer');
        // $this->form_validation->set_rules('file_surat', 'Keterangan', 'required');    
    }

    public function update($id)
    {
        if(!$this->validate([
            'username'  => 'required|min_length[8]|trim|is_unique[user.username]',
            'password'  => 'required|trim|min_length[8]|matches[password2]',
            'password2' => 'required|trim|min_length[8]|matches[password]',
            'level'     => 'required',
        ]))
        {
            $validation = \Config\Services::validation();
            return redirect()->to('/user/edit/'.$id)->withInput();
        } 
        else {

            $data = [
                'id_user'  => $id,
                'username' =>  $this->request->getPost("username"),
                'password' =>  $this->request->getPost("password"),
                'level'    =>  $this->request->getPost("level"),
            ];
            
            $this->User_model->save($data);

            session()->setFlashdata('success', 'Berhasil DiUpdate!');
            return redirect()->to('/user/edit/'.$id);
        }
    }
    public function delete($id)
    {
        $this->User_model->delete($id);
        session()->setFlashdata('success', 'Berhasil Dihapus!');
        return redirect()->to('/user')->withInput();
    }
}
