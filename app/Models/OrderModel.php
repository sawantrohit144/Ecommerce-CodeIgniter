<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table = 'order';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id',
                                'address',
                                'city',
                                'pincode',
                                'payment_type',
                                'total_price',
                                'payment_status',
                                'order_status', 
                                'added_on'];
}
