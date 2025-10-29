<?php

namespace App\Models;

use CodeIgniter\Model;

class MPlanMinum extends Model
{
    protected $table            = 'minum_planner';
    protected $primaryKey       = 'idPlanMinum';
    protected $allowedFields    = [
        'idUser',
        'targetML',
        'currentML',
        'tanggal'
    ];

    protected $useTimestamps    = false;

    public function getToday($idUser)
    {
        $today = date('Y-m-d');

        $row = $this->where([
            'idUser'  => $idUser,
            'tanggal' => $today
        ])->first();

        if (!$row) {
            // buat default
            $this->insert([
                'idUser'    => $idUser,
                'targetML'  => 2000,
                'currentML' => 0,
                'tanggal'   => $today
            ]);

            // ambil lagi
            $row = $this->where([
                'idUser'  => $idUser,
                'tanggal' => $today
            ])->first();
        }

        return $row;
    }
    public function getWeeklyRecap($idUser)
    {
        $start = date('Y-m-d', strtotime('monday this week'));
        $end   = date('Y-m-d', strtotime('sunday this week'));

        return $this->where('idUser', $idUser)
                    ->where('tanggal >=', $start)
                    ->where('tanggal <=', $end)
                    ->findAll();
    }

    public function getMonthlyRecap($idUser)
    {
        $start = date('Y-m-01');
        $end   = date('Y-m-t');

        return $this->where('idUser', $idUser)
                    ->where('tanggal >=', $start)
                    ->where('tanggal <=', $end)
                    ->findAll();
    }


    public function addWater($idPlanMinum, $amount)
    {
        $plan = $this->find($idPlanMinum);
        if (!$plan) return false;

        $newTotal = $plan['currentML'] + $amount;

        return $this->update($idPlanMinum, [
            'currentML' => $newTotal
        ]);
    }

    public function resetToday($idPlanMinum)
    {
        return $this->update($idPlanMinum, [
            'currentML' => 0
        ]);
    }

    public function updateTarget($idPlanMinum, $target)
    {
        return $this->update($idPlanMinum, [
            'targetML' => $target
        ]);
    }

    public function getHistory($idUser, $filter)
    {
        if ($filter === 'day') {
            return [$this->getToday($idUser)];
        }

        if ($filter === 'week') {
            $date = date('Y-m-d', strtotime('-6 days'));
            return $this->where('idUser', $idUser)
                        ->where('tanggal >=', $date)
                        ->orderBy('tanggal', 'ASC')
                        ->findAll();
        }

        if ($filter === 'month') {
            $date = date('Y-m-d', strtotime('-30 days'));
            return $this->where('idUser', $idUser)
                        ->where('tanggal >=', $date)
                        ->orderBy('tanggal', 'ASC')
                        ->findAll();
        }

        return [];
    }
}
