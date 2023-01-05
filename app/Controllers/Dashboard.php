<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $data =
            [
                'title' => 'Dashboard'
            ];
        if ($this->cekLogin() == FALSE) {
            session()->setFlashdata('error_login', 'Silahkan login terlebih dahulu untuk mengakses data');
            return redirect()->to('/auth/login');
        }
        return view('dashboard', $data);
    }
    public function __construct()
    {
        $this->cekLogin();
    }
}