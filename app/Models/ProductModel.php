<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductModel extends Model
{
	protected $table = 'products';

	protected $primaryKey = 'id';

	protected $allowedFields = ['title', 'image','description'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

}

?>