<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DataDikerjakanController;
use App\Http\Controllers\HardwareController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestUserController;
use App\Http\Controllers\SelesaiController;
use App\Http\Controllers\SoftwareController;
use App\Http\Controllers\TindakLanjutController;
use App\Models\TambahDataHardware;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PDFController;
use App\Http\Controllers\HistoryController;


Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/dikerjakan', function () {
        return view('pages.dikerjakan');
    })->name('dikerjakan');

    Route::get('/history_pekerjaan', function () {
        return view('pages.history_pekerjaan');
    })->name('history_pekerjaan');

    Route::get('/pekerjaan_selesai', function () {
        return view('pages.pekerjaan_selesai');
    })->name('pekerjaan_selesai');

    Route::get('/hardware', function () {
        return view('pages.hardware');
    })->name('hardware');

    Route::get('/form-software', function () {
        return view('pages.software');
    })->name('software');

    Route::get('/permintaan_perbaikan', function () {
        return view('pages.permintaan_perbaikan');
    })->name('permintaan_perbaikan');

    Route::get('/form-perbaikan', function () {
        return view('pages.form-perbaikan');
    })->name('form-perbaikan');

    Route::get('/tindaklanjut_perbaikan', function () {
        return view('pages.tindaklanjut_perbaikan');
    })->name('tindaklanjut_perbaikan');

    Route::get('/form-tindaklanjut', function () {
        return view('pages.form-tindaklanjut');
    })->name('form-tindaklanjut');

    Route::get('/form-hardware', function () {
        return view('pages.form-hardware');
    })->name('form-hardware');

});

// Menggunakan RequestUserController untuk rute request-user
    Route::get('/request-user', [RequestUserController::class, 'create'])->name('request-user');
    Route::post('/request-user', [RequestUserController::class, 'store'])->name('request-user-simpan');
    

    Route::get('/permintaan-masuk', [RequestUserController::class, 'index'])->name('permintaan-masuk');
    Route::resource('TambahDataHardware', HardwareController::class);

    Route::get('edit-data-hardware/{id}/edit', [HardwareController::class, 'edit'])->name('edit-data-hardware');
    Route::post('update-data-hardware/{id}',[HardwareController::class, 'update'])->name('update-data-hardware');
    Route::get('delete-data-hardware/{id}',[HardwareController::class, 'destroy'])->name('delete-data-hardware');
    Route::post('simpan-data-hardware',[HardwareController::class, 'store'])->name('simpan-data-hardware');
    // Route::post('/assign-technician/{request}', [RequestUserController::class, 'assignTechnician'])->name('assign-technician');

    // Route::resource('TambahDataHardware', HardwareController::class);
    //SOFTWARE
    Route::resource('TambahDataSoftware', SoftwareController::class);

    Route::get('edit-data-software/{id}/edit', [SoftwareController::class, 'edit'])->name('edit-data-software');
    Route::post('update-data-software/{id}',[SoftwareController::class, 'update'])->name('update-data-software');
    Route::get('delete-data-software/{id}',[SoftwareController::class, 'destroy'])->name('delete-data-software');
    Route::post('simpan-data-software',[SoftwareController::class, 'store'])->name('simpan-data-software');

    //PERBAIKAN
    Route::resource('Perbaikan', PerbaikanController::class);
    
    Route::get('edit-data-perbaikan/{id}/edit', [PerbaikanController::class, 'edit'])->name('edit-data-perbaikan');
    Route::post('update-data-perbaikan/{id}',[PerbaikanController::class, 'update'])->name('update-data-perbaikan');
    Route::get('delete-data-perbaikan/{id}',[PerbaikanController::class, 'destroy'])->name('delete-data-perbaikan');

    Route::resource('Tindaklanjut', TindakLanjutController::class);

    Route::post('/assign-technician/{id}', [RequestUserController::class, 'assignTechnician'])->name('assign.technician');
    Route::get('/dikerjakan/{id}', [RequestUserController::class, 'show'])->name('request_dikerjakan');
    Route::get('/data-dikerjakan', [DataDikerjakanController::class, 'index'])->name('data.dikerjakan');
    Route::post('/requests-dikerjakan/{id}', [RequestUserController::class, 'moveToDikerjakan'])->name('requests.dikerjakan');

    Route::get('/selesai/{id}', [DataDikerjakanController::class, 'show'])->name('request_dikerjakan');
    Route::post('/pekerjaan-selesai/{id}', [DataDikerjakanController::class, 'moveToSelesai'])->name('pekerjaan-selesai');


    Route::resource('DataDikerjakan', DataDikerjakanController::class);
    Route::resource('PekerjaanSelesai', SelesaiController::class);

    Route::get('/generate-pdf', [DataDikerjakanController::class, 'moveToSelesai'])->name('generate-pdf');

    Route::get('/generate-pdf', [PDFController::class, 'generatePDF']);

    Route::get('/request-user-print', [RequestUserController::class, 'printToPDF'])->name('request-user.print');
    Route::get('/data-dikerjakan-print', [DataDikerjakanController::class, 'printToPDF'])->name('data-dikerjakan.print');
    Route::get('/data-selesai-print', [SelesaiController::class, 'printToPDF'])->name('data-selesai.print');
    Route::get('/history', [HistoryController::class, 'index'])->name('history.indexx');
    Route::get('export-requests', [RequestUserController::class, 'exportToExcel'])->name('export.requests');
    Route::get('export-dikerjakan', [DataDikerjakanController::class, 'exportToExcel'])->name('export.dikerjakan');
    Route::get('export-selesai', [SelesaiController::class, 'exportToExcel'])->name('export.selesai');

    Route::get('/hardware-print', [HardwareController::class, 'printToPDF'])->name('hardware.print');
    Route::get('export-hardware', [HardwareController::class, 'exportToExcel'])->name('export.hardware');

    Route::get('/software-print', [SoftwareController::class, 'printToPDF'])->name('software.print');
    Route::get('export-software', [SoftwareController::class, 'exportToExcel'])->name('export.software');

    Route::get('delete-data-perbaikan/{id}',[PerbaikanController::class, 'destroy'])->name('delete-data-perbaikan');

    Route::get('edit-data-tindaklanjut/{id}/edit', [TindakLanjutController::class, 'edit'])->name('edit-data-tindaklanjut');
    Route::post('update-data-tindaklanjut/{id}',[TindakLanjutController::class, 'update'])->name('update-data-tindaklanjut');
    Route::get('delete-data-tindaklanjut/{id}',[TindakLanjutController::class, 'destroy'])->name('delete-data-tindaklanjut');

    Route::get('/perbaikan-print', [PerbaikanController::class, 'printToPDF'])->name('perbaikan.print');
    Route::get('export-perbaikan', [PerbaikanController::class, 'exportToExcel'])->name('export.perbaikan');

    Route::get('export-tindaklanjut', [TindakLanjutController::class, 'exportToExcel'])->name('export.tindaklanjut');
    Route::get('/tindaklanjut-print', [TindakLanjutController::class, 'printToPDF'])->name('tindaklanjut.print');

    // Route::get('/dashboard/data', [DashboardController::class, 'getData']);

require __DIR__.'/auth.php';
