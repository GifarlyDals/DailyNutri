<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class CAdmin extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
        return redirect()->to('/login');
        }
        if (session()->get('role') !== 'admin') {
            session()->setFlashdata('error', 'Akses ditolak! Hanya admin yang boleh membuka halaman ini.');
            return redirect()->to('/dashboard');
        }
        return view('dashboardAdmin/dashboard');
    }
}
