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
}
