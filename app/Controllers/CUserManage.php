<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Muser; 

class CUserManage extends BaseController
{
    public function index()
    {
        $user = new Muser();
        // ambil input dari form (GET method)
        $search = $this->request->getGet('search');
        $role   = $this->request->getGet('role');

        $data = [
            'user' => $user->tampil_data(),
            'user' => $user->searchAndFilter($search, $role),
            'totalUsers' => $user->getTotalUsers()
        ];
        return view('dashboardAdmin/usermanage', $data);
    }

    public function tambahData()
    {
        $user = new Muser();

        $username = $this->request->getPost('username');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        $role = $this->request->getPost('role');

        $existingUser = $user->where('email', $email)
                            ->first();

        if ($existingUser) {
            session()->setFlashdata('error', 'Email sudah terdaftar!, Silahkan gunakan email lain.');
            return redirect()->back()->withInput();
        }


        $data = [
            'username' => $username,
            'email'    => $email,
            'password' => password_hash($password, PASSWORD_BCRYPT),
            'role'     => $role
        ];

        $user->insert($data);

        session()->setFlashdata('tambah', 'Akun berhasil ditambah!');
        return redirect()->to(base_url('usermanage'));
    }

    public function editData($idUser)
    {
        $user = new Muser();

        $username = $this->request->getPost('username');
        $email    = $this->request->getPost('email');
        $role     = $this->request->getPost('role');
        $password = $this->request->getPost('password'); 

        $existingUser = $user->where('email', $email)
                            ->where('idUser !=', $idUser)
                            ->first();

        if ($existingUser) {
            session()->setFlashdata('error', 'Email sudah digunakan oleh user lain!');
            return redirect()->back()->withInput();
        }

        $data = [
            'username' => $username,
            'email'    => $email,
            'role'     => $role
        ];

        if (!empty($password)) {
            $data['password'] = password_hash($password, PASSWORD_BCRYPT);
        }

        $user->update($idUser, $data);

        session()->setFlashdata('edit', 'Data user berhasil diperbarui!');
        return redirect()->to(base_url('usermanage'));
    }


    public function deleteData($idUser)
    {
        $user = new Muser();
        $data = [
            'idUser' => $idUser,
        ];
        $user->deleteData($data);
        session()->setFlashdata('hapus', 'Data berhasil Di Hapus !!');
        return redirect()->to(base_url('/usermanage'));
    }
}
