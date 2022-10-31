<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'hrm_users';
    protected $primaryKey       = 'user_id';
    protected $useAutoIncrement = true;
    protected $protectFields    = true;
    protected $allowedFields    = ['user_id', 'user_name', 'user_password', 'user_role','user_statut', 'user_image', 'user_email', 'user_signature'];
}
