<?php

namespace App\Controllers;

use App\Models\Galery_model;
use \App\Models\GaleryModel;  
class Home extends BaseController
{
    protected $galeryModel;
    public function __construct()
    {
        // parent::__construct();
        // $this->load->model('galery_model','galery');
        $this->galeryModel = new Galery_model();

        // $this->load->helper(array('form', 'url','Cookie', 'String'));
        // $this->load->library('form_validation');
    }

    public function index()
    {
        // $data['profil'] = $this->galery->profil();
        $data['profil'] = $this->galeryModel->findAll();
        $judul = [
            'title' => 'Home - Kantor Desa',
            'sub_title' => ''
        ];

        echo view('frontend/header',$judul);
        echo view('frontend/home',$data);
        echo view('frontend/footer',$data);
    }
}
