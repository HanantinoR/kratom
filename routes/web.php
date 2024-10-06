<?php

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PPBEController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\HPLPSController;
use App\Http\Controllers\PerijinanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LsController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\Security\RolePermission;
use App\Http\Controllers\Security\RoleController;
use App\Http\Controllers\Security\PermissionController;
use App\Http\Controllers\InatradeController;
use App\Http\Controllers\BcopsController;
use App\Http\Controllers\MasterCompanyController;
use Illuminate\Support\Facades\Artisan;
// Packages
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

require __DIR__.'/auth.php';

Route::get('/storage', function () {
    Artisan::call('storage:link');
});

//UI Pages Routs
Route::get('/', [HomeController::class, 'uisheet'])->name('uisheet');

Route::group(['middleware' => 'auth'], function () {
    // Permission Module
    Route::get('/role-permission',[RolePermission::class, 'index'])->name('role.permission.list');
    Route::resource('permission',PermissionController::class);
    Route::resource('role', RoleController::class);

    // Dashboard Routes
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    // PPBE Module
    route::resource('ppbe', PPBEController::class);
    route::group(['prefix'=>'ppbe'],function(){
        Route::post('draft',[PPBEController::class,'save_draft'])->name('ppbe.draft');
        Route::get('verify/{id}',[PPBEController::class,'verify_ppbe'])->name('ppbe.verify');
        Route::get('export/{id}',[PPBEController::class,'ppbe'])->name('ppbe.export');
        Route::get('pdf_export/{id}',[PPBEController::class,'pdf_export'])->name('ppbe.pdf');
        Route::get('ls/{id}', [PPBEController::class, 'ls_pdf'])->name('ppbe.ls_pdf');
        // Route::get('export/{id}', function(){
        //     return view('ppbe.export');
        // });
    });

    //penugasan Module
    Route::group(['prefix' => 'penugasan'],function(){
        route::get('index',[PenugasanController::class,'index'])->name('penugasan.index');
        // route::get('surat-tugas',[PenugasanController::class,'surat_tugas'])->name('penugasan.surat_tugas');
        Route::post('save',[PenugasanController::class,'save'])->name('penugasan.save');
        Route::get('data_ppbe/{id}',[PenugasanController::class,'getDataPpbe'])->name('ppbe.assignment');
        route::get('surat-tugas',[PenugasanController::class,'surat_tugas'])->name('penugasan.surat_tugas');
        route::get('surat-penugasan',[PenugasanController::class,'surat_penugasan'])->name('penugasan.surat-penugasan');
    });


    Route::group(['prefix' => 'pemeriksaan'], function(){
        route::get('daftar', [HPLPSController::class,'index'])->name('hplps.daftar');
        route::get('edit/{id}', [HPLPSController::class,'edit'])->name('hplps.edit');
        route::post('save', [HPLPSController::class,'save'])->name('hplps.save');
        route::get('verify/{id}',[HPLPSController::class,'verify'])->name('hplps.verify');
        route::put('update/{id}',[HPLPSController::class,'update'])->name('hplps.update');
        route::get('{state}/{id}',[HPLPSController::class,'show'])->name('hplps.detail');
        Route::post('/upload', [HPLPSController::class, 'uploadFile'])->name('hplps.upload');
    });

    Route::group(['prefix'=>'pengajuan'],function(){
        Route::get('pdf_export/{id}',[PengajuanController::class,'pdf_export'])->name('pengajuan.pdf');
        // Route::get('ppbe/{id}', [PengajuanController::class, 'ppbe'])->name('pengajuan.ppbe');
    });

    route::group(['prefix' => 'ls' ], function(){
        Route::get('index',[LsController::class,'index'])->name('ls.daftar');
        Route::post('save',[LsController::class,'save'])->name('ls.save');
    });

    // Users Module
    Route::resource('users', UserController::class);

    //perijinan Module
    Route::resource('perijinan',PerijinanController::class);
    route::post('update/pe/{id}',[PerijinanController::class,'modal_update'])->name('perijinan.update_pe');
    Route::get('data_company/{id}',[MasterCompanyController::class,'getCompany'])->name('data.company');
    //Inatrade Module
    Route::group(['prefix' => 'inatrade'], function(){
        Route::get('daftar', [InatradeController::class, 'daftar'])->name('inatrade.daftar');
        Route::get('edit', [InatradeController::class, 'edit'])->name('inatrade.edit');
        Route::post('store', [InatradeController::class, 'store'])->name('inatrade.store');
    });
    //BCOPS MODULE
    Route::group(['prefix' => 'bcops'], function(){
        Route::get('daftar', [BcopsController::class, 'daftar'])->name('bcops.daftar');
        Route::post('tambah', [BcopsController::class, 'tambah'])->name('bcops.tambah');
    });

    //Master
    Route::group(['prefix' => 'master'], function(){
        Route::get('kota_cabang', [MasterDataController::class, 'kota_cabang'])->name('master.kota_cabang');
        Route::get('mata_uang', [MasterDataController::class, 'mata_uang'])->name('master.mata_uang');
        Route::get('negara', [MasterDataController::class, 'negara'])->name('master.negara');
        Route::get('pelabuhan_muat', [MasterDataController::class, 'pelabuhan_muat'])->name('master.pelabuhan_muat');
        Route::get('pelabuhan_tujuan', [MasterDataController::class, 'pelabuhan_tujuan'])->name('master.pelabuhan_tujuan');
        Route::get('analisis_pemeriksaan', [MasterDataController::class, 'analisis_pemeriksaan'])->name('master.analisis_pemeriksaan');
        Route::get('kesimpulan_pemeriksaan', [MasterDataController::class, 'kesimpulan_pemeriksaan'])->name('master.kesimpulan_pemeriksaan');
        Route::get('provinsi', [MasterDataController::class, 'provinsi'])->name('master.provinsi');
        Route::get('kota_kabupaten', [MasterDataController::class, 'kabupaten_kota'])->name('master.kabupaten_kota');
    });
});

//App Details Page => 'Dashboard'], function() {
Route::group(['prefix' => 'menu-style'], function() {
    //MenuStyle Page Routs
    Route::get('horizontal', [HomeController::class, 'horizontal'])->name('menu-style.horizontal');
    Route::get('dual-horizontal', [HomeController::class, 'dualhorizontal'])->name('menu-style.dualhorizontal');
    Route::get('dual-compact', [HomeController::class, 'dualcompact'])->name('menu-style.dualcompact');
    Route::get('boxed', [HomeController::class, 'boxed'])->name('menu-style.boxed');
    Route::get('boxed-fancy', [HomeController::class, 'boxedfancy'])->name('menu-style.boxedfancy');
});

//App Details Page => 'special-pages'], function() {
Route::group(['prefix' => 'special-pages'], function() {
    //Example Page Routs
    Route::get('billing', [HomeController::class, 'billing'])->name('special-pages.billing');
    Route::get('calender', [HomeController::class, 'calender'])->name('special-pages.calender');
    Route::get('kanban', [HomeController::class, 'kanban'])->name('special-pages.kanban');
    Route::get('pricing', [HomeController::class, 'pricing'])->name('special-pages.pricing');
    Route::get('rtl-support', [HomeController::class, 'rtlsupport'])->name('special-pages.rtlsupport');
    Route::get('timeline', [HomeController::class, 'timeline'])->name('special-pages.timeline');
});

//Widget Routs
Route::group(['prefix' => 'widget'], function() {
    Route::get('widget-basic', [HomeController::class, 'widgetbasic'])->name('widget.widgetbasic');
    Route::get('widget-chart', [HomeController::class, 'widgetchart'])->name('widget.widgetchart');
    Route::get('widget-card', [HomeController::class, 'widgetcard'])->name('widget.widgetcard');
});

//Maps Routs
Route::group(['prefix' => 'maps'], function() {
    Route::get('google', [HomeController::class, 'google'])->name('maps.google');
    Route::get('vector', [HomeController::class, 'vector'])->name('maps.vector');
});

//Auth pages Routs
Route::group(['prefix' => 'auth'], function() {
    Route::get('signin', [HomeController::class, 'signin'])->name('auth.signin');
    Route::get('signup', [HomeController::class, 'signup'])->name('auth.signup');
    Route::get('confirmmail', [HomeController::class, 'confirmmail'])->name('auth.confirmmail');
    Route::get('lockscreen', [HomeController::class, 'lockscreen'])->name('auth.lockscreen');
    Route::get('recoverpw', [HomeController::class, 'recoverpw'])->name('auth.recoverpw');
    Route::get('userprivacysetting', [HomeController::class, 'userprivacysetting'])->name('auth.userprivacysetting');
});

//Error Page Route
Route::group(['prefix' => 'errors'], function() {
    Route::get('error404', [HomeController::class, 'error404'])->name('errors.error404');
    Route::get('error500', [HomeController::class, 'error500'])->name('errors.error500');
    Route::get('maintenance', [HomeController::class, 'maintenance'])->name('errors.maintenance');
});


//Forms Pages Routs
Route::group(['prefix' => 'forms'], function() {
    Route::get('element', [HomeController::class, 'element'])->name('forms.element');
    Route::get('wizard', [HomeController::class, 'wizard'])->name('forms.wizard');
    Route::get('validation', [HomeController::class, 'validation'])->name('forms.validation');
});


//Table Page Routs
Route::group(['prefix' => 'table'], function() {
    Route::get('bootstraptable', [HomeController::class, 'bootstraptable'])->name('table.bootstraptable');
    Route::get('datatable', [HomeController::class, 'datatable'])->name('table.datatable');
});

//Icons Page Routs
Route::group(['prefix' => 'icons'], function() {
    Route::get('solid', [HomeController::class, 'solid'])->name('icons.solid');
    Route::get('outline', [HomeController::class, 'outline'])->name('icons.outline');
    Route::get('dualtone', [HomeController::class, 'dualtone'])->name('icons.dualtone');
    Route::get('colored', [HomeController::class, 'colored'])->name('icons.colored');
});

//Extra Page Routs
Route::get('privacy-policy', [HomeController::class, 'privacypolicy'])->name('pages.privacy-policy');
Route::get('terms-of-use', [HomeController::class, 'termsofuse'])->name('pages.term-of-use');
