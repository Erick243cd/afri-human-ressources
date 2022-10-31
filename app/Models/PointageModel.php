<?php

namespace App\Models;

use CodeIgniter\Model;

class PointageModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'hrm_pointages';
    protected $primaryKey       = 'taillyId';

    protected $allowedFields    = ['taillyId','employeId', 'annee_scolaire',
        'taillyYear', 'taillyMonth', 'taillyDate', 'taillyHour', 'taillyMotif', 'taillyStatus', 'taillyPoint', 'userId'];
}
