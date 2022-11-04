<?php

namespace App\Validations;

use App\Models\TauxTransportModel;
use App\Models\UserModel;

class CustomRules
{
    private $userModel;
    private $tauxTransportModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->tauxTransportModel = new TauxTransportModel();
    }

    function check_date(string $str, string &$error = null): bool
    {
        $month = date('m', strtotime($str));
        $year = date('Y', strtotime($str));

        if ($year < date('Y')) {
            return false;
        } else {
            return true;
        }
    }

    function check_pwd(string $str, string &$error = null): bool
    {
        $data = $this->userModel->asObject()
            ->where('user_email', $_POST['email_adress'])
            ->first();
        if (empty($data)) {
            return false;
        } elseif (password_verify($str, $data->user_password)) {
            return true;
        } else {
            return false;
        }
    }

    //check month and your before saving taux
    function check_month(string $str, string &$error = null): bool
    {
        $data = $this->tauxTransportModel->where(['tauxMonth' => $_POST['month_name'], 'yearId' => $_POST['year_id']])->findAll();

        if (empty($data)) {
            return true;
        } else {
            return false;
        }
    }
}

  