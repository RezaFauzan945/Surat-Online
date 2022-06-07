<?php

namespace App\Models;

use CodeIgniter\Model;

class Galery_model extends Model
{
    protected $table = 'gallery';
    protected $primaryKey = 'id' ;
    protected $allowedFields = ['profile','s_kelurahan','s_lpm','s_linmas','s_pemuda','k_rtrw'];

}