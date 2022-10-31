<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'hrm_services';
    protected $primaryKey       = 'serviceId';
    protected $useAutoIncrement = true;

    protected $allowedFields    = ['serviceId', 'serviceName'];
}
