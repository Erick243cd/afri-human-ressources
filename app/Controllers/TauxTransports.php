<?php

namespace App\Controllers;

class TauxTransports extends BaseController
{
    public function index()
    {
        if (!isLoggedIn()) return redirect()->to('login');
        $data = [
            'title' => 'Fixation du taux de transport',
            'taux' => $this->TauxTransportModel->asObject()->findAll(),
        ];
        return view('transports/index', $data);
    }

    public function add()
    {

    }
}
