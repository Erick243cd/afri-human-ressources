<?php

namespace App\Models;

use CodeIgniter\Model;

class CategoryModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'hrm_categories';
    protected $primaryKey       = 'categoryId';
    protected $useAutoIncrement = true;

    protected $allowedFields    = ['categoryId', 'categoryName', 'shortName', 'createdAt'];
}
