<?php

namespace App\Models;

use CodeIgniter\Model;

class ContactModel extends Model
{
    protected $table = 'contact_us'; // Change 'contacts' to your actual table name
    protected $primaryKey = 'id';
    protected $allowedFields = ['name', 'email', 'mobile', 'comment', 'added_on'];
}
