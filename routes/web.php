<?php

// Controllers
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PPBEController;
use App\Http\Controllers\PenugasanController;
use App\Http\Controllers\HPLPSController;
use App\Http\Controllers\PerijinanController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LsController;
use App\Http\Controllers\LHPController;
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
Route::get('/', [HomeController::class, 'landing_page'])->name('web.landing_page');
Route::get('/log-in', [HomeController::class, 'login_page'])->name('web.login_page');

// dd(auth)
Route::group(['middleware'=>'auth'],function() {
     // PPBE Module
     Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

    Route::group(['middleware' => ['auth','role:admin,koordinator_cabang,user,surveyor']],function(){
        route::resource('ppbe', PPBEController::class);
    });
    route::group(['prefix'=>'ppbe','middleware' => ['auth','role:admin,koordinator_cabang,user,surveyor']],function(){
        Route::post('draft',[PPBEController::class,'save_draft'])->name('ppbe.draft');
        Route::get('destination/{id}',[PPBEController::class,'getDestination'])->name('ppbe.destination_id');
        Route::get('city/{id}',[PPBEController::class,'getcity'])->name('ppbe.city_id');
        Route::get('verify/{id}',[PPBEController::class,'verify_ppbe'])->name('ppbe.verify');
        Route::get('export/{id}',[PPBEController::class,'ppbe'])->name('ppbe.export');
        Route::get('pdf_export/{id}',[PPBEController::class,'pdf_export'])->name('ppbe.pdf');
        Route::get('draft_pdf/{id}',[PPBEController::class,'draft_pdf'])->name('ppbe.pdf_draft');
        Route::get('detail/{id}',[PPBEController::class,'detail_ppbe'])->name('ppbe.detail');
        Route::post('cancel/{id}',[PPBEController::class,'cancel_ppbe'])->name('ppbe.cancel');
    });

    //penugasan Module
    Route::group(['prefix' => 'penugasan','middleware' => ['auth','role:admin,koordinator_cabang,surveyor']],function(){
        route::get('index',[PenugasanController::class,'index'])->name('penugasan.index');
        // route::get('surat-tugas',[PenugasanController::class,'surat_tugas'])->name('penugasan.surat_tugas');
        Route::post('save',[PenugasanController::class,'save'])->name('penugasan.save');
        Route::get('data_ppbe/{id}',[PenugasanController::class,'getDataPpbe'])->name('ppbe.assignment');
        route::get('surat-tugas/{id}',[PenugasanController::class,'surat_tugas'])->name('penugasan.surat_tugas');
        route::get('surat-penugasan/{id}',[PenugasanController::class,'surat_penugasan'])->name('penugasan.surat-penugasan');
    });

    Route::group(['prefix' => 'pemeriksaan','middleware' => ['auth','role:admin,koordinator_cabang,surveyor']], function(){
        route::get('daftar', [HPLPSController::class,'index'])->name('hplps.daftar');
        route::get('edit/{id}', [HPLPSController::class,'edit'])->name('hplps.edit');
        route::post('save', [HPLPSController::class,'save'])->name('hplps.save');
        route::get('verify/{id}',[HPLPSController::class,'verify'])->name('hplps.verify');
        route::put('update/{id}',[HPLPSController::class,'update'])->name('hplps.update');
        route::get('{state}/{id}',[HPLPSController::class,'show'])->name('hplps.detail');
        Route::post('/upload', [HPLPSController::class, 'uploadFile'])->name('hplps.upload');
        Route::get('booking/data/{id}',[HPLPSController::class, 'data_request_booking'])->name('hplps.data_booking');
        Route::post('booking/request',[HPLPSController::class, 'request_alokasi_booking'])->name('hplps.booking');
        Route::post('lab/data',[HPLPSController::class,'data_lab'])->name('hplps.check_lab');
        Route::get('lab/detail/{id}',[HPLPSController::class,'detail_lab'])->name('hplps.detail_lab');
    });

    route::group(['prefix' => 'ls','middleware' => ['auth','role:admin,koordinator_cabang,surveyor']], function(){
        Route::get('index',[LsController::class,'index'])->name('ls.daftar');
        Route::get('detail/{id}',[LsController::class,'show'])->name('ls.detail');
        Route::post('save',[LsController::class,'save'])->name('ls.save');
        Route::get('cetak/{code_above}', [LsController::class, 'export_pdf'])->name('ls.sertifikat');
    });

    route::group(['prefix' => 'lhp','middleware' => ['auth','role:admin,koordinator_cabang,surveyor']],function(){
        Route::get('index',[LHPController::class,'index'])->name('lhp.daftar');
        Route::get('detail/{id}',[LHPController::class,'show'])->name('lhp.detail');
        Route::get('cetak/{code_above_lhp}', [LHPController::class, 'export_pdf'])->name('lhp.sertifikat');
    });

    // Users Module
    Route::resource('users', UserController::class);

    //perijinan Module
    Route::resource('perijinan',PerijinanController::class);
    route::post('update/pe/{id}',[PerijinanController::class,'modal_update'])->name('perijinan.update_pe');
    Route::get('data_company/{id}',[MasterCompanyController::class,'getCompany'])->name('data.company');
    Route::post('check/et_pe',[MasterCompanyController::class,'check_et_pe'])->name('perijinan.et_pe');
    Route::get('pe/{id}/detail',[PerijinanController::class,'detail_pe'])->name('perijinan.pe_detail');
    Route::get('check/pe/hs/{id}/{company}',[PerijinanController::class,'check_hs_pe'])->name('data.hs_pe');

    //Inatrade Module
    Route::group(['prefix' => 'inatrade','middleware' => ['auth','role:admin,koordinator_cabang']], function(){
        Route::get('daftar', [InatradeController::class, 'daftar'])->name('inatrade.daftar');
        Route::get('edit/{id}', [InatradeController::class, 'edit'])->name('inatrade.edit');
        Route::post('store', [InatradeController::class, 'store'])->name('inatrade.store');
    });
    //BCOPS MODULE
    Route::group(['prefix' => 'bcops'], function(){
        Route::get('daftar', [BcopsController::class, 'daftar_umum'])->name('bcops.umum_daftar');
        Route::post('tambah_umum', [BcopsController::class, 'tambah_umum'])->name('bcops.umum_tambah');
        Route::post('exists_umum', [BcopsController::class, 'check_umum'])->name('bcops.umum_check');
        Route::get('surveyor', [BcopsController::class, 'daftar_surveyor'])->name('bcops.surveyor_daftar');
        Route::post('tambah_surveyor', [BcopsController::class, 'tambah_surveyor'])->name('bcops.surveyor_tambah');
        Route::post('exists_surveyor', [BcopsController::class, 'check_surveyor'])->name('bcops.surveyor_umum');
        Route::get('usage', [BcopsController::class, 'usage_hplps'])->name('bcops.hplps_usage');
        Route::get('pengembalian', [BcopsController::class, 'pengembalian'])->name('bcops.pengembalian');
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
// Route::group(['prefix' => 'special-pages'], function() {
//     //Example Page Routs
//     Route::get('billing', [HomeController::class, 'billing'])->name('special-pages.billing');
//     Route::get('calender', [HomeController::class, 'calender'])->name('special-pages.calender');
//     Route::get('kanban', [HomeController::class, 'kanban'])->name('special-pages.kanban');
//     Route::get('pricing', [HomeController::class, 'pricing'])->name('special-pages.pricing');
//     Route::get('rtl-support', [HomeController::class, 'rtlsupport'])->name('special-pages.rtlsupport');
//     Route::get('timeline', [HomeController::class, 'timeline'])->name('special-pages.timeline');
// });


// //Auth pages Routs
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
