<?php

namespace App\Models;

use CodeIgniter\Model;

class YearModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'hrm_years';
    protected $primaryKey = 'yearId';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['yearId', 'yearName'];
}
