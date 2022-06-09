<?php

namespace App\Controllers;

use App\Controllers\BaseController;


// defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends BaseController
{
    public function index()
    {
        if(session()->get('id_user') == null)
        {
            return redirect()->to('/login');
        }
        else
        {
            $data = [
                'title' => 'Dashboard',
                'sub_title' => '',
                'user' => $this->auth->where('id_user', session()->get('id_user'))->first(),
                'jumlah_user' => $this->auth->countAll(),
                'jumlah_surat_masuk' => $this->suratMasuk->countAll(),
                'jumlah_surat_keluar' => $this->suratKeluar->countAll(),
                'jumlah_surat_keterangan' => $this->suratKeterangan->countAll(),
            ];

            $januari   = $this->suratMasuk->where('month(tanggal_surat_masuk)','1')->countAllResults();
            $februari  = $this->suratMasuk->where('month(tanggal_surat_masuk)','2')->countAllResults() ;
            $maret     = $this->suratMasuk->where('month(tanggal_surat_masuk)','3')->countAllResults() ;
            $april     = $this->suratMasuk->where('month(tanggal_surat_masuk)','4')->countAllResults() ;
            $mei       = $this->suratMasuk->where('month(tanggal_surat_masuk)','5')->countAllResults() ;
            $juni      = $this->suratMasuk->where('month(tanggal_surat_masuk)','6')->countAllResults() ;
            $juli      = $this->suratMasuk->where('month(tanggal_surat_masuk)','7')->countAllResults() ;
            $agustus   = $this->suratMasuk->where('month(tanggal_surat_masuk)','8')->countAllResults() ;
            $september = $this->suratMasuk->where('month(tanggal_surat_masuk)','9')->countAllResults() ;
            $oktober   = $this->suratMasuk->where('month(tanggal_surat_masuk)','10')->countAllResults() ;
            $november  = $this->suratMasuk->where('month(tanggal_surat_masuk)','11')->countAllResults() ;
            $desember  = $this->suratMasuk->where('month(tanggal_surat_masuk)','12')->countAllResults() ;
    
            $data['masuk'] = [$januari, $februari, $maret, $april, $mei, $juni, $juli, $agustus, $september, $oktober, $november, $desember];
    
            $januari1   = $this->suratKeluar->where('month(tanggal_surat_keluar)','1')->countAllResults();
            $februari1  = $this->suratKeluar->where('month(tanggal_surat_keluar)','2')->countAllResults();
            $maret1     = $this->suratKeluar->where('month(tanggal_surat_keluar)','3')->countAllResults();
            $april1     = $this->suratKeluar->where('month(tanggal_surat_keluar)','4')->countAllResults();
            $mei1       = $this->suratKeluar->where('month(tanggal_surat_keluar)','5')->countAllResults();
            $juni1      = $this->suratKeluar->where('month(tanggal_surat_keluar)','6')->countAllResults();
            $juli1      = $this->suratKeluar->where('month(tanggal_surat_keluar)','7')->countAllResults();
            $agustus1   = $this->suratKeluar->where('month(tanggal_surat_keluar)','8')->countAllResults();
            $september1 = $this->suratKeluar->where('month(tanggal_surat_keluar)','9')->countAllResults();
            $oktober1   = $this->suratKeluar->where('month(tanggal_surat_keluar)','10')->countAllResults();
            $november1  = $this->suratKeluar->where('month(tanggal_surat_keluar)','11')->countAllResults();
            $desember1  = $this->suratKeluar->where('month(tanggal_surat_keluar)','12')->countAllResults();
    
            $data['keluar'] = [$januari1, $februari1, $maret1, $april1, $mei1, $juni1, $juli1, $agustus1, $september1, $oktober1, $november1, $desember1];
    
            $januari2   =$this->suratKeterangan->where('month(tanggal_surat_keterangan)','1')->countAllResults(); 
            $februari2  =$this->suratKeterangan->where('month(tanggal_surat_keterangan)','2')->countAllResults(); 
            $maret2     =$this->suratKeterangan->where('month(tanggal_surat_keterangan)','3')->countAllResults(); 
            $april2     =$this->suratKeterangan->where('month(tanggal_surat_keterangan)','4')->countAllResults(); 
            $mei2       =$this->suratKeterangan->where('month(tanggal_surat_keterangan)','5')->countAllResults(); 
            $juni2      =$this->suratKeterangan->where('month(tanggal_surat_keterangan)','6')->countAllResults(); 
            $juli2      =$this->suratKeterangan->where('month(tanggal_surat_keterangan)','7')->countAllResults(); 
            $agustus2   =$this->suratKeterangan->where('month(tanggal_surat_keterangan)','8')->countAllResults(); 
            $september2 =$this->suratKeterangan->where('month(tanggal_surat_keterangan)','9')->countAllResults(); 
            $oktober2   =$this->suratKeterangan->where('month(tanggal_surat_keterangan)','10')->countAllResults(); 
            $november2  =$this->suratKeterangan->where('month(tanggal_surat_keterangan)','11')->countAllResults(); 
            $desember2  =$this->suratKeterangan->where('month(tanggal_surat_keterangan)','12')->countAllResults(); 
    
            $data['keterangan'] = [$januari2, $februari2, $maret2, $april2, $mei2, $juni2, $juli2, $agustus2, $september2, $oktober2, $november2, $desember2];
    
            $data2['sm'] = $this->suratMasuk->orderBy('tanggal_surat_masuk','DESC')->limit(1);
    
            $data2['sk'] = $this->suratMasuk->orderBy('tanggal_surat_keluar','DESC')->limit(1);
    
            $data2['sket'] = $this->suratMasuk->orderBy('tanggal_surat_keterangan','DESC')->limit(1);
    
            if ($data2['sm'] == null) {
                $data2['sm'] = 0;
            }
            if($data2['sk'] == null){
                $data2['sk'] = 0;
            }
            if($data2['sket'] == null){
                $data2['sket'] = 0;
            }
            
            echo view('templates/header',$data);
            echo view('dashboard/index', $data2);
            echo view('templates/footer', $data);
        }
    }
}
