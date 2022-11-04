<?php

namespace App\Models;

use CodeIgniter\Model;

class TauxTransportModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'hrm_tauxtransports';
    protected $primaryKey = 'tauxId';
    protected $useAutoIncrement = true;

    protected $allowedFields = ['tauxId', 'yearId', 'tauxMonth', 'amountManager', 'amountSimpleEmployee', 'createdAt', 'userId','status'];
}
