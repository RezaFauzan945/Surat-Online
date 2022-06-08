<?php

namespace App\Controllers;

use App\Models\M_Penduduk;

// defined('BASEPATH') or ex9it('No direct script access allowed');

class Penduduk extends BaseController
{
    protected $M_Penduduk;
    public function __construct()
    {
        // parent::__construct();

        // $this->load->helper(array('form', 'url'));
        // $this->load->library('form_validation');

        $this->M_Penduduk = new M_Penduduk;
    }

    public function index()
    {
        $data = [
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
            'title' => 'Penduduk',
            'sub_title' => '',
        ];

        $data['data'] = $this->M_Penduduk->findALl();
        echo view('templates/header', $data);
        echo view('penduduk/index', $data);
        echo view('templates/footer');
    }

    public function tambah()
    {
       
            $data = [
                'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
                'title' => 'Penduduk',
                'sub_title' => 'Tambah Penduduk',
                'validation' => \Config\Services::validation(),
            ];
            echo view('templates/header', $data);
            echo view('penduduk/tambah');
            echo view('templates/footer');
    }

    public function edit($nik)
    {
        $data = [
            'title' => 'Penduduk',
            'sub_title' => 'Edit Penduduk',
            'validation' => \Config\Services::validation(),
            'penduduk' => $this->M_Penduduk->where('nik',$nik)->first(),
            'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
        ];
        echo view('templates/header', $data);
        echo view('penduduk/edit', $data);
        echo view('templates/footer');
    }

    public function create()
    {
        if(!$this->validate([
            'nik' => 'trim|required',
            'nama' => 'trim|required',
            'no_hp' => 'trim|required',
            'tmpt_lhr' => 'trim|required',
            'tgl_lhr' => 'trim|required',
            'pekerjaan' => 'trim|required',
            'alamat' => 'trim|required',
            'rt' => 'trim|required',
            'rw' => 'trim|required',
        ]))
        {
            $validation = \Config\Services::validation();
            return redirect()->to('/penduduk/tambah')->withInput()->with('validation',$validation);
        }
        else
        {       
            $data = [
                'nik'       => $this->request->getPost("nik",) ,
                'nama'      => $this->request->getPost("nama",) ,
                'tmpt_lhr'  => $this->request->getPost("tmpt_lhr",) ,
                'tgl_lhr'   => $this->request->getPost("tgl_lhr",) ,
                'alamat'    => $this->request->getPost("alamat",) ,
                'no_hp'     => $this->request->getPost("no_hp",) ,
                'pekerjaan' => $this->request->getPost("pekerjaan",) ,
                'rw'        => $this->request->getPost("rw",) ,
                'rt'        => $this->request->getPost("rt",)
            ];
            $this->M_Penduduk->insert($data);
            session()->setFlashdata('success', 'Berhasil Ditambahkan!');
            return redirect()->to('penduduk/tambah');
        }
    }

    public function delete($nik)
    {
        $this->M_Penduduk->delete($nik);
        session()->setFlashdata('success', 'Berhasil Dihapus!');
        return redirect()->to('/penduduk')->withInput();
    }

    public function update($nik)
    {
        if(!$this->validate([
            'nik' => 'trim|required',
            'nama' => 'trim|required',
            'no_hp' => 'trim|required',
            'tmpt_lhr' => 'trim|required',
            'tgl_lhr' => 'trim|required',
            'pekerjaan' => 'trim|required',
            'alamat' => 'trim|required',
            'rt' => 'trim|required',
            'rw' => 'trim|required',
        ]))
        {
            $validation = \Config\Services::validation();
            return redirect()->to('/penduduk/edit/'.$nik)->withInput()->with('validation',$validation);
        }else{
            $data = [
                'nik'       => $this->request->getPost('nik'),
                'nama'      => $this->request->getPost("nama") ,
                'tmpt_lhr'  => $this->request->getPost("tmpt_lhr") ,
                'tgl_lhr'   => $this->request->getPost("tgl_lhr") ,
                'alamat'    => $this->request->getPost("alamat") ,
                'no_hp'     => $this->request->getPost("no_hp") ,
                'pekerjaan' => $this->request->getPost("pekerjaan") ,
                'rw'        => $this->request->getPost("rw") ,
                'rt'        => $this->request->getPost("rt")
            ];
            $this->M_Penduduk->save($data);
            session()->setFlashdata('success', 'Berhasil Diupdate!');
            return redirect()->to('pegawai/edit/'.$nik);

        }
    }

    function get_autocomplete(){
        if (isset($_GET['term'])) {
            $result = $this->M_Penduduk->search_nik($_GET['term']);
            if (count($result) > 0) {
                foreach ($result as $row)
                    $arr_result[] = array(
                        'label'  => $row->nik,
                        'nama' => $row->nama,
                        'no_hp' => $row->no_hp,
                 );
                    echo json_encode($arr_result);
            }
        }
    }

}
