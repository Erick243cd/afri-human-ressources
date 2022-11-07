<?php

if (!function_exists('isLoggedIn')) {

    function isLoggedIn()
    {
        $userdata = session()->get('user_data');
        if ($userdata !== null) {
            return true;
        } else {
            return false;
        }
    }
}
//if (!function_exists('activeYear')){
//
//    function activeYear(){
//        $db   = \Config\Database::connect();
//        $builder = $db->table('ptech_academy_years');
//        $data = $builder->getWhere(['year_status'=>1])->getFirstRow();
//
//        if (!empty($data)){
//            return $data->year_id;
//        }else {
//            return false;
//        }
//    }
//}

if (!function_exists('systemUpdates')) {
    function systemUpdates()
    {
        $actualDate = date('Y-m-d');
        if ($actualDate >= '2022-10-01') {
            return false;
        } else {
            return true;
        }
    }
}

function dateToFrench($date, $format)
{
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('lundi', 'mardi', 'mercredi', 'jeudi', 'vendredi', 'samedi', 'dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('janvier', 'février', 'mars', 'avril', 'mai', 'juin', 'juillet', 'août', 'septembre', 'octobre', 'novembre', 'décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
}

function activeTransportIndemnity($employeType)
{
    $db = \Config\Database::connect();

    $builder = $db->table('hrm_tauxtransports');
    $data = $builder->getWhere(['status' => 1])->getFirstRow();
    if ($employeType === 'Manager') {
        return $data->amountManager;
    } else {
        return $data->amountSimpleEmployee;
    }
}