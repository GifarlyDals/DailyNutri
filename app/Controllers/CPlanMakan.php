<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MPlanMakan;
use App\Models\MDetailPM;

class CPlanMakan extends BaseController
{
    public function index()
    {
        $idUser  = session()->idUser;
        
        // ✅ Tanggal dinamis (bisa pindah-pindah)
        $tanggal = $this->request->getGet('tanggal') ?? date('Y-m-d');

        $planModel   = new MPlanMakan();
        $detailModel = new MDetailPM();

        // ✅ Ambil plan berdasarkan tanggal & user
        $plan = $planModel->getPlanByDate($idUser, $tanggal);

        // ✅ Jika belum ada → buat plan baru otomatis
        if (!$plan) {
            $planModel->insert([
                'idUser'  => $idUser,
                'tanggal' => $tanggal,
                'type'    => 'harian'
            ]);
            $plan = $planModel->getPlanByDate($idUser, $tanggal);
        }

        $idPlan = $plan['idPlanMakan'];

        $data = [
            'tanggal'  => $tanggal,
            'plan'     => $plan,
            'sarapan'  => $detailModel->getByKategori($idPlan, 'sarapan'),
            'siang'    => $detailModel->getByKategori($idPlan, 'siang'),
            'malam'    => $detailModel->getByKategori($idPlan, 'malam'),
            'camilan'  => $detailModel->getByKategori($idPlan, 'camilan'),
        ];

        return view('dashboardUser/makananPlanner', $data);
    }

    public function detail($idPlanMakan)
    {
        $planModel   = new MPlanMakan();
        $detailModel = new MDetailPM();

        $plan = $planModel->find($idPlanMakan);

        if (!$plan) {
            return redirect()->to('/planmakan')->with('error', 'Plan tidak ditemukan.');
        }

        $data = [
            'plan'     => $plan,
            'sarapan'  => $detailModel->getByKategori($idPlanMakan, 'sarapan'),
            'siang'    => $detailModel->getByKategori($idPlanMakan, 'siang'),
            'malam'    => $detailModel->getByKategori($idPlanMakan, 'malam'),
            'camilan'  => $detailModel->getByKategori($idPlanMakan, 'camilan'),
        ];

        return view('dashboardUser/makananPlanner', $data);
    }


    public function tambah()
    {
        $detailModel = new MDetailPM();
        $planModel   = new MPlanMakan();

        $idPlan = $this->request->getPost('idPlanMakan');

        $data = [
            'idPlanMakan' => $idPlan,
            'makanan'     => $this->request->getPost('makanan'),
            'kategori'    => $this->request->getPost('kategori'),
            'porsi'       => $this->request->getPost('porsi'),
            'waktu'       => $this->request->getPost('waktu'),
            'kalori'      => $this->request->getPost('kalori')
        ];

        $detailModel->insert($data);

        // ✅ Update total
        $all = $detailModel->where('idPlanMakan', $idPlan)->findAll();
        $planModel->update($idPlan, [
            'totalKalori' => array_sum(array_column($all, 'kalori')),
            'totalPorsi'  => array_sum(array_column($all, 'porsi'))
        ]);

        return redirect()->to('planmakan?tanggal=' . $planModel->find($idPlan)['tanggal']);
    }


    public function hapus($idDetail, $idPlanMakan)
    {
        $detailModel = new MDetailPM();
        $planModel   = new MPlanMakan();

        $detailModel->delete($idDetail);

        // ✅ Recalculate totals
        $all = $detailModel->where('idPlanMakan', $idPlanMakan)->findAll();

        $planModel->update($idPlanMakan, [
            'totalKalori' => array_sum(array_column($all, 'kalori')),
            'totalPorsi'  => array_sum(array_column($all, 'porsi')),
        ]);

        // ✅ Redirect kembali ke hari yang sama
        $tanggal = $planModel->find($idPlanMakan)['tanggal'];

        return redirect()->to('planmakan?tanggal=' . $tanggal);
    }
}
