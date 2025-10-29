<?php

namespace App\Models;

use CodeIgniter\Model;

class MDetailPM extends Model
{
    protected $table = 'detail_plan_makan';
    protected $primaryKey = 'idDetail';

    protected $allowedFields = [
        'idPlanMakan', 'makanan', 'kategori', 'porsi', 'waktu', 'kalori'
    ];

    public function getByKategori($idPlanMakan, $kategori)
    {
        return $this->where('idPlanMakan', $idPlanMakan)
                    ->where('kategori', $kategori)
                    ->findAll();
    }
}
