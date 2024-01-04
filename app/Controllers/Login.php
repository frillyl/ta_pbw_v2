<?php

namespace App\Controllers;

use App\Models\ModelLogin;

class Login extends BaseController
{
    public function __construct()
    {
        helper('form');
        $this->ModelLogin = new ModelLogin();
    }

    public function index()
    {
        $data = [
            'title' => 'Lembaga Penelitian UG',
            'sub'   => 'Masuk'
        ];
        return view('admin/v_login', $data);
    }

    public function cek_login()
    {
        if ($this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib di Isi!',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib di Isi!',
                ]
            ],
        ])) {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $cek_user = $this->ModelLogin->login_user($email);
            if ($cek_user != '') {
                if (password_verify($password, $cek_user['password'])) {
                    session()->set('id_user', $cek_user['id_user']);
                    session()->set('nm_user', $cek_user['nm_user']);
                    session()->set('email', $cek_user['email']);
                    session()->set('role', $cek_user['role']);

                    return redirect()->to(base_url('admin/dashboard'));
                } else {
                    session()->setFlashdata('pesan', 'Gagal Login. Email atau Password yang Anda Masukkan Salah!');
                    return redirect()->to(base_url('login'));
                }
            } else {
                session()->setFlashdata('pesan', 'Gagal Login. Akun Anda tidak ditemukan!');
                return redirect()->to(base_url('login'));
            }
        } else {
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('login'));
        }
    }

    public function logout()
    {
        session()->remove('log');
        session()->remove('id_user');
        session()->remove('nm_user');
        session()->remove('email');
        session()->remove('role');
        return redirect()->to(base_url('login'));
    }
}
