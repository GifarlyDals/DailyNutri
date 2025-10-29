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

        return view('dashboardUser/makananPlanner/makananPlannerHarian', $data);
    }



    public function mingguan()
    {
        $idUser = session()->idUser;

        // Ambil tanggal dari GET, default hari ini
        $tanggal = $this->request->getGet('tanggal') ?? date('Y-m-d');

        // Tentukan awal & akhir minggu (Senin–Minggu)
        $weekStart = date('Y-m-d', strtotime('monday this week', strtotime($tanggal)));
        $weekEnd   = date('Y-m-d', strtotime('sunday this week', strtotime($tanggal)));

        $planModel   = new MPlanMakan();
        $detailModel = new MDetailPM();

        // Ambil plan yang ada dalam minggu tersebut
        $plans = $planModel->where('idUser', $idUser)
                            ->where('tanggal >=', $weekStart)
                            ->where('tanggal <=', $weekEnd)
                            ->findAll();

        $rekap = [];

        // Untuk perhitungan total mingguan
        $totalKaloriMinggu = 0;
        $totalPorsiMinggu  = 0;
        $jumlahHariTerisi  = 0;

        for ($i = 0; $i < 7; $i++) {

            $hari = date('Y-m-d', strtotime("$weekStart +$i day"));

            // cari plan untuk hari itu
            $plan = null;
            foreach ($plans as $p) {
                if ($p['tanggal'] === $hari) {
                    $plan = $p;
                    break;
                }
            }

            // Ambil detail makanan jika plan ada
            if ($plan) {

                $detail = [
                    'sarapan' => $detailModel->getByKategori($plan['idPlanMakan'], 'sarapan'),
                    'siang'   => $detailModel->getByKategori($plan['idPlanMakan'], 'siang'),
                    'malam'   => $detailModel->getByKategori($plan['idPlanMakan'], 'malam'),
                    'camilan' => $detailModel->getByKategori($plan['idPlanMakan'], 'camilan'),
                ];

                // Hitung total hari itu
                $hariKal = 0;
                $hariPor = 0;

                foreach ($detail as $items) {
                    foreach ($items as $item) {
                        $hariKal += $item['kalori'];
                        $hariPor += $item['porsi'];
                    }
                }

                if ($hariKal > 0 || $hariPor > 0) {
                    $jumlahHariTerisi++;
                }

                $totalKaloriMinggu += $hariKal;
                $totalPorsiMinggu  += $hariPor;

            } else {
                // Tidak ada plan
                $detail = [
                    'sarapan' => [],
                    'siang'   => [],
                    'malam'   => [],
                    'camilan' => [],
                ];
            }

            $rekap[] = [
                'tanggal' => $hari,
                'detail'  => $detail
            ];
        }

        // Kirim ke view — lengkap agar tidak undefined
        $data = [

            // Bagian harian dibuat default kosong agar view tidak error
            'tanggal'  => $tanggal,
            'plan'     => [
                'totalKalori' => 0,
                'totalPorsi'  => 0,
                'idPlanMakan' => 0,
            ],
            'sarapan'  => [],
            'siang'    => [],
            'malam'    => [],
            'camilan'  => [],

            // Data Mingguan Asli
            'weekStart' => $weekStart,
            'weekEnd'   => $weekEnd,
            'rekap'     => $rekap,

            // Ringkasan Mingguan
            'totalKaloriMinggu' => $totalKaloriMinggu,
            'totalPorsiMinggu'  => $totalPorsiMinggu,
            'jumlahHariTerisi'  => $jumlahHariTerisi,
        ];

        return view('dashboardUser/makananPlanner/makananPlannerMingguan', $data);
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

    public function bulanan()
    {
        $idUser = session()->idUser;

        // Ambil bulan yg dipilih atau bulan sekarang (format: Y-m)
        $bulan = $this->request->getGet('bulan') ?? date('Y-m');

        $firstDay = $bulan . "-01";
        $lastDay  = date("Y-m-t", strtotime($firstDay));

        $planModel   = new MPlanMakan();
        $detailModel = new MDetailPM();

        // Ambil semua plan dalam bulan
        $plans = $planModel->where('idUser', $idUser)
                            ->where('tanggal >=', $firstDay)
                            ->where('tanggal <=', $lastDay)
                            ->findAll();

        // ================================
        //  ✅ Hitung Statistik Bulanan
        // ================================

        $hariData = [];

        $totalMenu = 0;         // total semua detail makanan
        $totalKaloriBulan = 0;  // total kalori 1 bulan
        $hariTerisi = 0;        // jumlah hari yang ada data

        foreach ($plans as $p) {

            $details = $detailModel->where('idPlanMakan', $p['idPlanMakan'])->findAll();

            $totalKal = array_sum(array_column($details, 'kalori'));
            $totalPorsi = array_sum(array_column($details, 'porsi'));

            $menuCount = count($details);
            $totalMenu += $menuCount;
            $totalKaloriBulan += $totalKal;

            if ($menuCount > 0) {
                $hariTerisi++;
            }

            // Tentukan status warna kalender
            if ($totalKal >= 1200) {
                $status = "full"; // hijau
            } elseif ($totalKal >= 500) {
                $status = "half"; // kuning
            } else {
                $status = "empty"; // abu
            }

            $hariData[$p['tanggal']] = [
                "kalori" => $totalKal,
                "porsi"  => $totalPorsi,
                "menu"   => $menuCount,
                "status" => $status
            ];
        }

        $avgKalori = $hariTerisi > 0 ? round($totalKaloriBulan / $hariTerisi) : 0;

        // Kirim ke view
        $data = [
            "bulan"            => $bulan,
            "firstDay"         => $firstDay,
            "hariData"         => $hariData,

            // ✅ statistik bulanan
            "totalMenu"        => $totalMenu,
            "totalKaloriBulan" => $totalKaloriBulan,
            "avgKalori"        => $avgKalori,
            "hariTerisi"       => $hariTerisi,
        ];

        return view("dashboardUser/makananPlanner/makananPlannerBulanan", $data);
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
