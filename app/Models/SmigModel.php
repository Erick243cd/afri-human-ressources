<?php

namespace App\Models;

use CodeIgniter\Model;

class SmigModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'hrm_smigs';
    protected $primaryKey = 'smigId';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['smigId', 'smig_amount', 'currency', 'category_id', 'created_at', 'updated_at'];
}
