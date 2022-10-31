<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        if (isLoggedIn()) return redirect()->to('dashboard');

        $data = ['title' => 'Human Ressources Manager  | Login'];

        return view('pages/login', $data);
    }

    public function dashboard()
    {
        if (!isLoggedIn()) return redirect()->to('/');

        $data = [
            'title' => 'Human Ressources Manager | Dashboard',
            'page'=>'dashboard',
            'categories'=> count($this->categoryModel->findAll()),
            'services'=> count($this->serviceModel->findAll()),
            'users'=> count($this->userModel->findAll()),
            'employees'=> count($this->employeeModel->findAll()),
            'men'=> count($this->employeeModel->where('gender', 'M')->findAll()),
            'women'=> count($this->employeeModel->where('gender', 'F')->findAll()),
            'sess_data' => session()->get('user_data')
        ];

        return view('pages/dashboard', $data);
    }
}
