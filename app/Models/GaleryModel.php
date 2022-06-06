<?php

namespace App\Models;

use CodeIgniter\Model;

class GaleryModel extends Model
{
    protected $table = 'gallery';
    protected $primaryKey = 'id' ;
    protected $useTimestamps = true;
}