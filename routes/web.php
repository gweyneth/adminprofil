<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProfilSekolahController;
use App\Http\Controllers\Admin\OrganigramController;
use App\Http\Controllers\Admin\KontenController;
use App\Http\Controllers\Admin\GaleriController;
use App\Http\Controllers\Admin\AgendaController;
use App\Http\Controllers\Admin\SaranaController;
use App\Http\Controllers\Admin\PengumumanController;
use App\Http\Controllers\Admin\JurusanController;
use App\Http\Controllers\Admin\GuruController;
use App\Http\Controllers\Admin\EkstrakurikulerController;
use App\Http\Controllers\Admin\PostEkstrakurikulerController;
use App\Http\Controllers\Admin\TestimoniController;
use App\Http\Controllers\Admin\PrestasiController;
use App\Http\Controllers\Admin\AdminProfileController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute Halaman Awal (Publik)
Route::get('/', function () {
    return 'Ini Halaman Depan. Silakan akses <a href="/login">/login</a> untuk masuk.';
});


//=======================================================================
// RUTE UNTUK AUTENTIKASI (LOGIN & LOGOUT)
//=======================================================================
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.process');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


//=======================================================================
// RUTE UNTUK HALAMAN ADMIN YANG DILINDUNGI
//=======================================================================
Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    
    // Rute Dasbor
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

     // Rute untuk Kelola Profil Admin
     Route::get('/profil-admin', [AdminProfileController::class, 'index'])->name('profil_admin.index');
     Route::put('/profil-admin', [AdminProfileController::class, 'update'])->name('profil_admin.update');

    // --- Rute Manajemen Konten ---
    Route::get('/profil-sekolah', [ProfilSekolahController::class, 'index'])->name('profil.index');
    Route::post('/profil-sekolah', [ProfilSekolahController::class, 'storeOrUpdate'])->name('profil.storeOrUpdate');
    
    Route::get('/organigram', [OrganigramController::class, 'index'])->name('organigram.index');
    Route::post('/organigram', [OrganigramController::class, 'storeOrUpdate'])->name('organigram.storeOrUpdate');
    Route::delete('/organigram/hapus-gambar', [OrganigramController::class, 'destroyImage'])->name('organigram.destroyImage');
    
    Route::resource('konten', KontenController::class);
    Route::resource('agenda', AgendaController::class);
    Route::resource('pengumuman', PengumumanController::class);
    Route::resource('sarana', SaranaController::class);
    Route::resource('galeri', GaleriController::class)->except(['show']);
    Route::resource('testimoni', TestimoniController::class)->only(['index', 'show', 'destroy']);
    Route::patch('/testimoni/{testimoni}/toggle-status', [TestimoniController::class, 'toggleStatus'])->name('testimoni.toggleStatus');

    // --- Rute Manajemen Akademik ---
    Route::resource('jurusan', JurusanController::class);
    Route::resource('guru', GuruController::class);
    Route::resource('ekstrakurikuler', EkstrakurikulerController::class);
    Route::resource('post-ekstrakurikuler', PostEkstrakurikulerController::class);
    Route::resource('prestasi', PrestasiController::class);

});
