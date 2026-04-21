<?php

namespace App\Http\Controllers;

use App\Models\Pengajuan;
use App\Models\Nasabah;
use App\Models\Realisasi;
use App\Models\TargetMarketing;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengajuanExport;
use App\Exports\DataListExport;


class DashboardController extends Controller
{
    // ================= MANAGER =================
   public function manager()
{
    $pengajuans = Pengajuan::with('nasabah','user','realisasi')->get();

    $totalNasabah = Nasabah::count();
    $totalPengajuan = Pengajuan::count();
    $totalPencairan = Pengajuan::where('status','pencairan')
    ->sum('jumlah');

    $marketingStats = User::where('role','marketing')
        ->withSum('pengajuans','jumlah')
        ->get();

    $marketingNames = $marketingStats->pluck('name'); // nama marketing
    $marketingTotals = $marketingStats->pluck('pengajuans_sum_jumlah'); // total pengajuan per marketing

    // =================== Chart Bulanan ===================
    $year = date('Y'); // tahun sekarang
    $statuses = ['pending'=>'Pending','survey'=>'Survey','analisis'=>'Analisis','realisasi'=>'Realisasi','pencairan'=>'Pencairan'];
    $monthlyChart = [];

    foreach($statuses as $key => $label) {
        $monthlyData = [];
        for($m=1; $m<=12; $m++){
            $monthlyData[] = Pengajuan::where('status',$key)
                ->whereYear('created_at',$year)
                ->whereMonth('created_at',$m)
                ->count();
        }
        $monthlyChart[] = [
            'label'=>$label,
            'data'=>$monthlyData
        ];
    }

    // =================== Chart Tahunan ===================
    $years = range($year-4,$year); // 5 tahun terakhir
    $annualChart = [];
    foreach($statuses as $key => $label) {
        $annualData = [];
        foreach($years as $y){
            $annualData[] = Pengajuan::where('status',$key)
                ->whereYear('created_at',$y)
                ->count();
        }
        $annualChart[] = [
            'label'=>$label,
            'data'=>$annualData
        ];
    }

    return view('manager.dashboard', compact(
    'totalNasabah',
    'totalPengajuan',
    'totalPencairan', // 🔥 ganti
    'marketingNames',
    'marketingTotals',
    'monthlyChart',
    'annualChart',
    'year',
    'years'
));
    


    }

    // ================= MANAGER TARGET =================
   public function managerTargetProgress()
{
    $tahun = now()->year;

    // 🔥 ambil target asli dari tabel target_marketing
    $targets = TargetMarketing::with('user')->get();

    // hitung progress per target
    foreach ($targets as $t) {

        $totalSelesai = Pengajuan::where('user_id', $t->user_id)
            ->where('status', 'pencairan')
            ->sum('jumlah');

        $t->tercapai = $totalSelesai;
        $t->sisa = $t->target_nominal - $totalSelesai;

        $t->percent = $t->target_nominal > 0
            ? round(($totalSelesai / $t->target_nominal) * 100, 1)
            : 0;
    }

    // ===== progress keseluruhan =====
    $totalTarget = $targets->sum('target_nominal');
    $totalSelesai = Pengajuan::where('status','pencairan')->sum('jumlah');
    $remainingTarget = $totalTarget - $totalSelesai;

    $progressPercent = $totalTarget > 0
        ? round(($totalSelesai / $totalTarget) * 100, 1)
        : 0;

    return view('manager.target', compact(
        'targets',
        'totalTarget',
        'totalSelesai',
        'remainingTarget',
        'progressPercent'
    ));

}


    public function managerMonitoring()
{
    // ================= Semua Data Pengajuan =================
    $pengajuans = Pengajuan::with('nasabah','user')
        ->orderBy('created_at','desc')
        ->get();

    // ================= Data List (Nasabah Potensial) =================
    // Kriteria: sudah realisasi dan tidak bermasalah
    $dataList = Pengajuan::with('nasabah','user')
        ->where('status','realisasi')
        ->get();

    return view('manager.monitoring', compact(
        'pengajuans',
        'dataList'
    ));
}
public function exportPengajuanExcel()
{
    return Excel::download(new PengajuanExport, 'pengajuan_nasabah.xlsx');
}

public function exportDataListExcel()
{
    return Excel::download(new DataListExport, 'data_list.xlsx');
}


public function exportPDF()
{
    $data = Pengajuan::with('nasabah','user')->get();

    $pdf = \PDF::loadView('manager.laporan_pdf', compact('data'));
    return $pdf->download('laporan_kredit.pdf');
}


    // ================= MARKETING =================
   public function marketing()
{
    $user = auth()->user();
    $tahun = now()->year;

    $pengajuans = Pengajuan::where('user_id', $user->id)
        ->with('nasabah','realisasi')
        ->get();

    $totalPengajuan = $pengajuans->sum('jumlah');
    $totalPencairan = $pengajuans->where('status','pencairan')->sum('jumlah');

    // 🔥 ambil target
    $target = TargetMarketing::where('user_id',$user->id)
        ->where('tahun',$tahun)
        ->first();

    $targetNominal = $target ? $target->target_nominal : 0;

    // 🔥 progress target
    $progressPercent = $targetNominal > 0
        ? round(($totalPencairan/$targetNominal)*100,1)
        : 0;

    // 🔥 alert target
    if($progressPercent >= 100){
        $alert = ['type'=>'success','msg'=>'Target tercapai 🎉'];
    } elseif($progressPercent >= 70){
        $alert = ['type'=>'warning','msg'=>'Target hampir tercapai 🔥'];
    } else{
        $alert = ['type'=>'danger','msg'=>'Target masih jauh ⚠️'];
    }

    return view('marketing.dashboard', compact(
        'pengajuans',
        'totalPengajuan',
        'totalPencairan',
        'targetNominal',
        'progressPercent',
        'alert'
    ));

    }

    // ================= MARKETING TARGET PROGRESS =================
    public function targetProgress()
{
    $user = auth()->user();
    $tahun = now()->year;

    // target
    $target = TargetMarketing::where('user_id', $user->id)
        ->where('tahun', $tahun)
        ->first();

    $targetNominal = $target ? $target->target_nominal : 0;

    // 🔥 TOTAL PENCAIRAN (langsung dari pengajuan)
    $totalRealisasi = Pengajuan::where('user_id', $user->id)
        ->where('status','pencairan')
        ->sum('jumlah');

    // 🔥 DATA BULANAN BERDASARKAN PENCAIRAN
    $monthly = Pengajuan::select(
            DB::raw('MONTH(updated_at) as bulan'),
            DB::raw('SUM(jumlah) as total')
        )
        ->where('user_id', $user->id)
        ->where('status','pencairan')
        ->whereYear('updated_at',$tahun)
        ->groupBy('bulan')
        ->pluck('total','bulan');

    return view('marketing.target_progress', compact(
        'targetNominal',
        'totalRealisasi',
        'monthly',
        'tahun'
    ));
}

    

    // ================= ANALYST =================
    public function analyst()
{
    $year = date('Y');

    // 🔥 Hitung statistik
    $survey = Pengajuan::where('status','survey')->count();
    $analisis = Pengajuan::where('status','analisis')->count();
    $approved = Pengajuan::where('status','diterima')->count();
    $realisasi = Pengajuan::where('status','realisasi')->count();

    // ================= Chart =================
    $statuses = [
        'analisis' => 'Analisis',
        'diterima' => 'Approved',
        'survey' => 'Survey',
        'realisasi' => 'Realisasi',
        'pencairan' => 'Pencairan'
    ];

    $chartData = [];

    foreach($statuses as $statusKey => $statusLabel) {

        $monthly = [];

        for($month=1; $month<=12; $month++) {

            $count = Pengajuan::where('status', $statusKey)
                ->whereYear('created_at', $year)
                ->whereMonth('created_at', $month)
                ->count();

            $monthly[] = $count;
        }

        $chartData[] = [
            'label' => $statusLabel,
            'data' => $monthly,
        ];
    }

    return view('analyst.dashboard', compact(
        'chartData',
        'year',
        'survey',
        'analisis',
        'approved',
        'realisasi'
    ));
}
}
