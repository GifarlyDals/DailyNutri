<?php

namespace App\Models;

use CodeIgniter\Model;

class MAuth extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'idUser ';
    protected $allowedFields    = ['username', 'email', 'password', 'role'];
}
