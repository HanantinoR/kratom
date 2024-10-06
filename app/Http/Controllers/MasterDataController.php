<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inatrade;
use App\Helpers\AuthHelper;
use App\DataTables\KabupatenKotaDataTable;
use App\DataTables\KotaCabangDataTable;
use App\DataTables\NegaraDataTable;
use App\DataTables\PelabuhanMuatDataTable;
use App\DataTables\PelabuhanTujuanDataTable;
use App\DataTables\AnalisisPemeriksaanDataTable;
use App\DataTables\KesimpulanPemeriksaanDataTable;
use App\DataTables\ProvinsiDataTable;
use App\DataTables\MataUangDataTable;

class MasterDataController extends Controller
{
    public function kota_cabang(KotaCabangDataTable $dataTable){
        $pageTitle = 'Daftar Kota Cabang';
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','kota_cabang_list'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }

    public function negara(NegaraDataTable $dataTable){
        $pageTitle = 'Daftar Negara';
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','negara_list'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }

    public function pelabuhan_muat(PelabuhanMuatDataTable $dataTable){
        $pageTitle = 'Daftar Pelabuhan Muat';
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','pelabuhan_muat_list'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }

    public function pelabuhan_tujuan(PelabuhanTujuanDataTable $dataTable){
        $pageTitle = 'Daftar Pelabuhan Tujuan';
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','pelabuhan_tujuan_list'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }
    
    public function provinsi(ProvinsiDataTable $dataTable){
        $pageTitle = 'Daftar Provinsi';
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','provinsi_list'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }

    public function kabupaten_kota(KabupatenKotaDataTable $dataTable){
        $pageTitle = 'Daftar Kabupaten dan Kota';
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','kabupaten_kota_list'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }
    
    public function mata_uang(MataUangDataTable $dataTable){
        $pageTitle = 'Daftar Mata Uang';
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','mata_uang_list'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }

    public function analisis_pemeriksaan(AnalisisPemeriksaanDataTable $dataTable){
        $pageTitle = 'Daftar Analisis Pemeriksaan';
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','analisis_pemeriksaan_list'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }

    public function kesimpulan_pemeriksaan(KesimpulanPemeriksaanDataTable $dataTable){
        $pageTitle = 'Daftar Kesimpulan Pemeriksaan';
        $auth_user = AuthHelper::authSession();
        $assets = ['data-table','kesimpulan_pemeriksaan_list'];
        // $headerAction = '<a href="'.route('users.create').'" class="btn btn-sm btn-primary" role="button">Add UserS</a>';
        return $dataTable->render('global.datatable', compact('pageTitle','auth_user','assets'));
    }
}
