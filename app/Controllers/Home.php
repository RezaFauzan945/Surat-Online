<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        echo view('frontend/header');
        echo view('frontend/home');
        echo view('frontend/footer');
    }
}
