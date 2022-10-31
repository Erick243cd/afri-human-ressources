<?php

namespace App\Models;

use CodeIgniter\Model;

class EmployeeModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'hrm_employees';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;

    protected $allowedFields = ['id', 'matricule', 'firstName', 'lastName',
        'phone', 'address', 'email', 'profilePicture', 'categoryId', 'serviceId', 'gender', 'dateEngagement'];


}
