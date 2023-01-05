<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AuthModel;
use Kint\Parser\ToStringPlugin;

class Auth extends BaseController
{
    protected $authModel;
    public function __construct()
    {
        helper(['form']);
        $this->cekLogin();
        $this->authModel = new AuthModel();
    }

    public function login()
    {
        if ($this->cekLogin()) {
            return redirect()->to('/dashboard');
        }
        return view('auth/login');
    }


    public function proses_login()
    {
        $validation =  \Config\Services::validation();
        helper('password');
        $email  = $this->request->getPost('email');
        $pass  = $this->request->getPost('password') ?: 'default';
        $data = [
            'email' => $email,
            'password' => $pass
        ];

        if (!$this->validate([
            'email'         => 'required|valid_email',
            'password'      => 'required'
        ])) {
            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to('/auth/login');
        } else {

            $cek_login = $this->authModel->where('email', $email)->limit(1)->get()->getRowArray();
            // email didapatkan
            if ($cek_login) {

                // jika email dan password cocok
                if (password_verify($pass, $cek_login['password'])) {

                    session()->set('email', $cek_login['email']);
                    session()->set('name', $cek_login['name']);
                    session()->set('level', $cek_login['level']);
                    session()->set('status', $cek_login['status']);

                    return redirect()->to('/dashboard');
                    // email cocok, tapi password salah
                } else {
                    session()->setFlashdata('errors', ['' => 'Password yang Anda masukan salah']);
                    return redirect()->to('/auth/login');
                }
            } else {
                // email tidak cocok / tidak terdaftar
                session()->setFlashdata('errors', ['' => 'Email yang Anda masukan tidak terdaftar']);
                return redirect()->to('/auth/login');
            }
        }
    }

    public function register()
    {
        if ($this->cekLogin() == TRUE) {
            return redirect()->to('/dashboard');
        }
        return view('auth/register');
    }

    public function proses_register()
    {
        $validation =  \Config\Services::validation();

        $data = [
            'email'             => $this->request->getPost('email'),
            'name'              => $this->request->getPost('name'),
            'username'          => $this->request->getPost('username'),
            'password'          => $this->request->getPost('password'),
            'confirm_password'  => $this->request->getPost('confirm_password')
        ];

        $password = $this->request->getPost('password') ?: '';
        if (!$this->validate(
            [
                'email'             => 'required|valid_email|is_unique[users.email]',
                'username'          => 'required|alpha_numeric|is_unique[users.username]|min_length[8]|max_length[35]',
                'name'              => 'required|alpha_numeric_space|min_length[3]|max_length[35]',
                'password'          => 'required|string|min_length[8]|max_length[35]',
                'confirm_password'  => 'required|string|matches[password]|min_length[8]|max_length[35]',
            ]
        )) {
            session()->setFlashdata('errors', $validation->getErrors());
            session()->setFlashdata('inputs', $this->request->getPost());
            return redirect()->to('/auth/register');
        } else {

            $datalagi = [
                'email'         => $this->request->getPost('email'),
                'name'          => $this->request->getPost('name'),
                'username'      => $this->request->getPost('username'),
                'password'      => password_hash($password, PASSWORD_DEFAULT),
                'status'        => "Active",
                'level'         => "Admin"
            ];

            $simpan = $this->authModel->db->table('users')->insert($datalagi);

            if ($simpan) {
                session()->setFlashdata('success_register', 'Register Successfully');
                return redirect()->to('/auth/login');
            }
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/auth/login');
    }
}