<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerUsersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'password'];
}
