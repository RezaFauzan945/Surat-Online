<?php

namespace App\Models;

use CodeIgniter\Model;

class Galery_model extends Model
{
    protected $table = 'gallery';
    protected $primaryKey = 'id' ;
    protected $useTimestamps = true;
}