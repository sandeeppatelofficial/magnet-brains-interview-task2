<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
	protected $table = 'orders';

	protected $primaryKey = 'id';

	protected $allowedFields = ['order_code', 'user_id','cart_total','product_ids','trans_id','payment_status'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}

?>