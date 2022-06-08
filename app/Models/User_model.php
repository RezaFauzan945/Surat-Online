<?php

namespace App\Models;

use CodeIgniter\Model;

class User_model extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id_user' ; 
    protected $allowedFields = [
        'id_user',
        'username',
        'password',
        'level',
    ];
}
