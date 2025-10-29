<?php

namespace App\Models;

use CodeIgniter\Model;

class MPlanMakan extends Model
{
    protected $table = 'plan_makan';
    protected $primaryKey = 'idPlanMakan';
    protected $allowedFields = [
        'idUser', 'tanggal', 'type', 'totalKalori', 'totalPorsi'
    ];

    public function getPlanByDate($idUser, $tanggal)
    {
        return $this->where('idUser', $idUser)
                    ->where('tanggal', $tanggal)
                    ->first();
    }

    public function getWeekPlan($idUser, $weekStart, $weekEnd)
    {
        return $this->where('idUser', $idUser)
                    ->where('tanggal >=', $weekStart)
                    ->where('tanggal <=', $weekEnd)
                    ->orderBy('tanggal', 'ASC')
                    ->findAll();
    }


    public function updateTotal($idPlanMakan)
    {
        $detailModel = new \App\Models\MPlanMakan();

        $totalKalori = $detailModel->where('idPlanMakan', $idPlanMakan)->selectSum('kalori')->first()['kalori'] ?? 0;
        $totalPorsi  = $detailModel->where('idPlanMakan', $idPlanMakan)->selectSum('porsi')->first()['porsi'] ?? 0;

        $this->update($idPlanMakan, [
            'totalKalori' => $totalKalori,
            'totalPorsi'  => $totalPorsi
        ]);
    }
}
