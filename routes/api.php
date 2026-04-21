<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Pengajuan;
use App\Models\Realisasi;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


/*
|--------------------------------------------------------------------------
| API Statistik Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/statistik/total-pengajuan', function () {
    return response()->json([
        'total' => Pengajuan::count()
    ]);
});

Route::get('/statistik/total-realisasi', function () {
    return response()->json([
        'total' => Realisasi::count()
    ]);
});

Route::get('/statistik/nominal-realisasi', function () {
    return response()->json([
        'total_nominal' => Realisasi::sum('nominal_disetujui')
    ]);
});
