<?php

namespace App\Models;

use CodeIgniter\Model;

class Muser extends Model
{
    protected $table            = 'user';
    protected $primaryKey       = 'idUser ';
    protected $allowedFields    = ['username', 'email', 'password', 'role'];

    public function Tampil_data()
    {
        return $this->db->table('user')
            ->orderBy('idUser', 'ASC')
            ->get()
            ->getResultArray();
    }
    public function searchAndFilter($search = null, $role = null)
    {
        $builder = $this->builder();

        if ($search) {
            $builder->groupStart()
                    ->like('username', $search)
                    ->orLike('email', $search)
                    ->groupEnd();
        }

        if ($role && $role !== 'all') {
            $builder->where('role', $role);
        }

        return $builder->get()->getResultArray();
    }

    public function getTotalUsers()
    {
        return $this->countAllResults();
    }
    
        public function editData($data) 
    {
        $this->db->table('user')
        ->where('idUser', $data['idUser'])
        ->update($data);
    }

    public function deleteData($data)
    {
        $this->db->table('user')
        ->where('idUser', $data['idUser'])
        ->delete($data);
    }
}
