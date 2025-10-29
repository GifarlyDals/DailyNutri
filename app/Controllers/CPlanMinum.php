<?php

namespace App\Controllers;

use App\Models\MPlanMinum;

class CPlanMinum extends BaseController
{
    public function index()
    {
        $planModel = new MPlanMinum();
        $idUser = session()->get('idUser');

        $filter = $this->request->getGet('filter') ?? 'day';

        $today = $planModel->getToday($idUser);
        $history = $planModel->getHistory($idUser, $filter);

        $vals = array_column($history, 'currentML');

        $avg        = $vals ? round(array_sum($vals) / count($vals)) : 0;
        $best       = $vals ? max($vals) : 0;
        $successCnt = count(array_filter($history, fn($h) => $h['currentML'] >= $h['targetML']));

        $chartLabels = array_column($history, 'tanggal');
        $chartValues = array_column($history, 'currentML');

        $data = [
            "filter"        => $filter,
            "todayMl"       => $today['currentML'],
            "targetMl"      => $today['targetML'],
            "progress"      => round(($today['currentML'] / $today['targetML']) * 100),
            "history"       => $history,
            "avgMl"         => $avg,
            "bestDay"       => $best,
            "targetSuccess" => $successCnt,

            "chartLabels" => $chartLabels,
            "chartValues" => $chartValues,
        ];

        return view('dashboardUser/minumPlanner', $data);
    }

    public function add()
    {
        $planModel = new MPlanMinum();

        $ml = $this->request->getPost('ml');
        if (!$ml) return redirect()->back();

        $idUser = session()->get('idUser');
        $today  = $planModel->getToday($idUser);

        $planModel->addWater($today['idPlanMinum'], $ml);

        return redirect()->to('/planminum');
    }

    public function reset()
    {
        $planModel = new MPlanMinum();

        $idUser = session()->get('idUser');
        $today  = $planModel->getToday($idUser);

        $planModel->resetToday($today['idPlanMinum']);

        return redirect()->to('/planminum');
    }

    public function target()
    {
        $planModel = new MPlanMinum();

        $target = $this->request->getPost('target');
        if (!$target) return redirect()->back();

        $idUser = session()->get('idUser');
        $today  = $planModel->getToday($idUser);

        $planModel->updateTarget($today['idPlanMinum'], $target);

        return redirect()->to('/planminum');
    }
}
