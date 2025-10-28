<?php

namespace App\Controllers;
use App\Controllers\BaseController;
use App\Models\Muser;

class CAuth extends BaseController
{
    public function index()
    {
        $data = [
            'title' => 'Halaman Login',
            'sub' => 'Silahkan Login !!',
        ];
        return view('auth/login',$data);
    }
    public function register()
    {
        $data = [
            'title' => 'Halaman Daftar',
            'sub' => 'Silahkan Daftar !!',
        ];
        return view('auth/register', $data);
    }
   public function prosesregister()
    {
        $user = new Muser();

        $username = $this->request->getPost('username');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $confirm  = $this->request->getPost('confirm');

        if ($password !== $confirm) {
            session()->setFlashdata('error', 'Password dan konfirmasi password tidak sama!');
            return redirect()->back()->withInput();
        }

        $existingUser = $user->where('username', $username)
                            ->orWhere('email', $email)
                            ->first();

        if ($existingUser) {
            session()->setFlashdata('error', 'Email sudah terdaftar!');
            return redirect()->back()->withInput();
        }


        $data = [
            'username' => $username,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role'     => 'user'
        ];

        $user->insert($data);

        session()->setFlashdata('tambah', 'Akun berhasil terdaftar!');
        return redirect()->to(base_url('/register'));
    }

    public function ceklogin() 
    {
        $user = new Muser();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        $cek = $user->where(['email' => $email])->first();

        if ($cek) {
            if (password_verify($password, $cek['password'])) {
                session()->set([
                    'username'  => $cek['username'],
                    'email'     => $cek['email'],
                    'idUser'    => $cek['idUser'],
                    'role'      => $cek['role'],
                    'logged_in' => true
                ]);
                if ($cek['role'] === 'admin') {
                    return redirect()->to('/admin/dashboard');
                } else {
                    return redirect()->to('/dashboard');
                }
            } else {
                session()->setFlashdata('error', 'Password salah!');
                return redirect()->to('/login');
            }
        } else {
            session()->setFlashdata('error', 'Akun tidak ditemukan!');
            return redirect()->to('/login');
        }
    }


    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }


}
