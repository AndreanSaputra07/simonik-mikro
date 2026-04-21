<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\RealisasiController;
use App\Http\Controllers\ActivityLogController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\TargetMarketingController;

/*
|--------------------------------------------------------------------------
| AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', fn() => redirect('/login'));

Route::get('/login', [AuthController::class,'showLogin'])->name('login');
Route::post('/login', [AuthController::class,'login']);
Route::post('/logout', [AuthController::class,'logout'])->middleware('auth');


/*
|--------------------------------------------------------------------------
| MANAGER ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:manager'])
    ->prefix('manager')
    ->group(function () {

        // Dashboard Manager
        Route::get('/dashboard', [DashboardController::class,'manager'])->name('manager.dashboard');

        // Monitoring
        Route::get('/monitoring', [DashboardController::class,'managerMonitoring'])->name('manager.monitoring');

        Route::get('/manager/export-pengajuan',
            [DashboardController::class,'exportPengajuanExcel']
        )->name('manager.export.pengajuan');

        Route::get('/manager/export-datalist',
            [DashboardController::class,'exportDataListExcel']
        )->name('manager.export.datalist');

        // Target Marketing
        Route::get('/target', [DashboardController::class,'managerTargetProgress'])->name('manager.target');

        // 🔥 TAMBAHAN CRUD TARGET
        Route::get('/target/edit/{id}', [TargetMarketingController::class,'edit'])->name('target.edit');
        Route::put('/target/update/{id}', [TargetMarketingController::class,'update'])->name('target.update');
        Route::delete('/target/delete/{id}', [TargetMarketingController::class,'destroy'])->name('target.delete');

        // Laporan
        Route::get('/laporan', [LaporanController::class,'index'])->name('manager.laporan');
        Route::get('/laporan/statistik', [LaporanController::class,'statistik'])->name('manager.laporan.statistik');
        Route::get('/laporan/export', [LaporanController::class,'exportPDF'])->name('manager.laporan.export');

        // Activity log
        Route::get('/activity', [ActivityLogController::class,'index'])->name('manager.activity');
});


/*
|--------------------------------------------------------------------------
| MARKETING ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:marketing'])
    ->prefix('marketing')
    ->group(function () {

        // Dashboard Marketing
        Route::get('/dashboard', [DashboardController::class,'marketing'])->name('marketing.dashboard');

        // Pengajuan CRUD
        Route::get('/pengajuan', [PengajuanController::class,'index'])->name('pengajuan.index');
        Route::get('/pengajuan/create', [PengajuanController::class,'create'])->name('pengajuan.create');
        Route::post('/pengajuan', [PengajuanController::class,'store'])->name('pengajuan.store');
        Route::get('/pengajuan/{id}/edit', [PengajuanController::class,'edit'])->name('pengajuan.edit');
        Route::put('/pengajuan/{id}', [PengajuanController::class,'update'])->name('pengajuan.update');
        Route::delete('/pengajuan/{id}', [PengajuanController::class,'destroy'])->name('pengajuan.destroy');

        // Target Progress Marketing
        Route::get('/target-progress', [DashboardController::class,'targetProgress'])->name('target.progress');
});


/*
|--------------------------------------------------------------------------
| ANALYST ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth','role:analyst'])
    ->prefix('analyst')
    ->group(function () {

        // Dashboard
        Route::get('/dashboard', [DashboardController::class,'analyst'])
            ->name('analyst.dashboard');

        /*
        |---------------------------------
        | ANALISIS
        |---------------------------------
        */

        // List data pending untuk dianalisis
        Route::get('/analisis', [AnalisisController::class,'analisisList'])
            ->name('analyst.analisis');

        // Form analisis
        Route::get('/analisis/{id}', [AnalisisController::class,'create'])
            ->name('analyst.analisis.create');

        // Simpan analisis
        Route::post('/analisis/store', [AnalisisController::class,'store'])
            ->name('analyst.analisis.store');


        /*
        |---------------------------------
        | APPROVAL
        |---------------------------------
        */

        // List yang sudah dianalisis
        Route::get('/approval', [AnalisisController::class,'approvalList'])
            ->name('analyst.approval');

        Route::get('/approve/{id}', [AnalisisController::class,'approve'])
            ->name('analyst.approve');

        Route::get('/reject/{id}', [AnalisisController::class,'reject'])
            ->name('analyst.reject');


        /*
        |---------------------------------
        | SURVEY
        |---------------------------------
        */

        // List data diterima untuk disurvey
        Route::get('/survey', [SurveyController::class,'index'])
            ->name('analyst.survey');

        Route::get('/survey/{id}', [SurveyController::class,'create'])
            ->name('analyst.survey.create');

        Route::post('/survey/store', [SurveyController::class,'store'])
            ->name('analyst.survey.store');


        /*
        |---------------------------------
        | REALISASI
        |---------------------------------
        */

        Route::get('/realisasi', [RealisasiController::class,'index'])
            ->name('analyst.realisasi');

        Route::get('/realisasi/create/{id}', [RealisasiController::class,'create'])
            ->name('analyst.realisasi.create');

        Route::post('/realisasi/store', [RealisasiController::class,'store'])
            ->name('analyst.realisasi.store');
           Route::post('/analyst/realisasi/{id}/proses',
    [RealisasiController::class, 'proses']
)->name('analyst.realisasi.proses');


});



