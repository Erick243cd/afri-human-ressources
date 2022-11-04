<?php

namespace App\Models;

use CodeIgniter\Model;

class PaymentModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'hrm_payments';
    protected $primaryKey = 'paymentId';
    protected $useAutoIncrement = true;
    protected $allowedFields = ['paymentId', 'employeId', 'daysWorked',
        'paymentDate', 'updatedAt', 'payementMonth', 'paymentYear', 'baseSalary',
        'primes', 'advantages', 'baseSalaryRequired', 'locationIndemnity', 'transportIndemnity',
        'bruteRemuneration', 'cnssQpo', 'cnssQpp', 'inpp', 'onem', 'ipr', 'netSalary'];

}
