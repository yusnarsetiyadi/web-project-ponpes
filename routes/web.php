<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Auth::routes();
Route::get('/', function () {
    return view('frontend.home');
});

Route::get('/page/{seo}', [App\Http\Controllers\Frontend\HalamanController::class, 'show']);

Route::get('/semua/galeri', [App\Http\Controllers\Frontend\GaleriController::class, 'all_kategorigaleri']);
Route::get('/detil/{id}/galeri', [App\Http\Controllers\Frontend\GaleriController::class, 'show']);

Route::get('/semua/artikel', [App\Http\Controllers\Frontend\ArtikelController::class, 'allartikel']);
Route::get('/semua/program', [App\Http\Controllers\Frontend\ArtikelController::class, 'allprogram']);
Route::get('/detil-artikel/{seo}', [App\Http\Controllers\Frontend\ArtikelController::class, 'show']);
Route::get('/detil-program/{seo}', [App\Http\Controllers\Frontend\ArtikelController::class, 'showProgram']);

Route::get('/semua/event', [App\Http\Controllers\Frontend\EventController::class, 'allevent']);
Route::get('/detil-event/{seo}', [App\Http\Controllers\Frontend\EventController::class, 'show']);

Route::get('/formulir/penerimaan', [App\Http\Controllers\Frontend\PenerimaanController::class, 'formPenerimaan']);
Route::post('/santri/penerimaan', [App\Http\Controllers\Frontend\PenerimaanController::class, 'postData']);
Route::get('/proses/penerimaan/berhasil', [App\Http\Controllers\Frontend\PenerimaanController::class, 'getData']);


Route::group(['prefix' => config('pathadmin.admin_name'), 'as' => config('pathadmin.admin_prefix'), 'middleware' => ['auth']], function() {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::resource('roles', Alza_admin\RoleController::class);
    Route::resource('users', Alza_admin\UserController::class);
    Route::resource('permissions', Alza_admin\PermissionController::class);
    Route::get('/menus',[App\Http\Controllers\Alza_admin\MenuController::class,'index']);
    Route::get('/iden',[App\Http\Controllers\Alza_admin\IdentitasController::class, 'index'])->name('iden.index');
    Route::put('/iden/update/{iden}',[App\Http\Controllers\Alza_admin\IdentitasController::class, 'update'])->name('iden.update');

    Route::get('/wilayah/prov',[App\Http\Controllers\Alza_admin\WilayahController::class,'prov']);
    Route::get('/wilayah/{prov_id}/kabkot',[App\Http\Controllers\Alza_admin\WilayahController::class,'kabkot']);
    Route::get('/wilayah/{kabkot_id}/kec',[App\Http\Controllers\Alza_admin\WilayahController::class,'kec']);
    Route::get('/wilayah/{kec_id}/desa',[App\Http\Controllers\Alza_admin\WilayahController::class,'desa']);


    Route::get('/belum-dibayar',[App\Http\Controllers\Alza_admin\TagihanController::class, 'belum']);
    Route::post('/proses/{id}/bayar',[App\Http\Controllers\Alza_admin\TagihanController::class, 'prosesBayar']);
    Route::post('/proses/{id}/batal-bayar',[App\Http\Controllers\Alza_admin\TagihanController::class, 'prosesBatalBayar']);
    Route::get('/lunas',[App\Http\Controllers\Alza_admin\TagihanController::class, 'sudah']);
    Route::get('/tagihans/{id}/cetak', [App\Http\Controllers\Alza_admin\TagihanController::class, 'cetak'])->name('tagihans.cetak');
    Route::get('/konfirmasi',[App\Http\Controllers\Alza_admin\TagihanController::class, 'konfirm']);
    Route::get('/generatedata',[App\Http\Controllers\Alza_admin\TagihanController::class, 'viewGenerateTagihan']);
    Route::post('/generate-proccess',[App\Http\Controllers\Alza_admin\TagihanController::class, 'generateTagihan']);


    Route::get('/export/santri', [App\Http\Controllers\Export\ExportSantriController::class, 'exportSantri']);
    Route::get('/calon/santri/create', [App\Http\Controllers\Alza_admin\SantriController::class, 'createcalonsantri']);
    Route::get('/calon/santri',[App\Http\Controllers\Alza_admin\SantriController::class, 'santribaru'])->name(config('pathadmin.admin_name').'calon.santri');
    Route::post('/calon-santri/{id}/diterima',[App\Http\Controllers\Alza_admin\SantriController::class, 'diterima']);
	Route::resource('/gurus', Alza_admin\GuruController::class);
	Route::resource('/kategoris', Alza_admin\KategoriController::class);
	Route::resource('/programs', Alza_admin\ProgramController::class);
	Route::resource('/artikels', Alza_admin\ArtikelController::class);
	Route::resource('/events', Alza_admin\EventController::class);
	Route::resource('/jurusans', Alza_admin\JurusanController::class);
	Route::resource('/tingkatpendidikans', Alza_admin\TingkatpendidikanController::class);
	Route::resource('/akunbanks', Alza_admin\AkunbankController::class);
	Route::resource('/santris', Alza_admin\SantriController::class);
	Route::resource('/pendidikanakhirs', Alza_admin\PendidikanakhirController::class);
	Route::resource('/orangtuawalis', Alza_admin\OrangtuawaliController::class);
	Route::resource('/sliders', Alza_admin\SliderController::class);
	Route::resource('/halamans', Alza_admin\HalamanController::class);
	Route::resource('/galeris', Alza_admin\GaleriController::class);
	Route::resource('/kategorigaleris', Alza_admin\KategorigaleriController::class);
	Route::resource('/kategoribayarans', Alza_admin\KategoribayaranController::class);
	Route::resource('/tagihans', Alza_admin\TagihanController::class);

    Route::get('/laporan/tagihan', [App\Http\Controllers\Alza_admin\TagihanController::class,'viewLaporanTagihan']);

    Route::post('/cetak',[App\Http\Controllers\Alza_admin\TagihanController::class,'cetakTagihan']);
	/*new route*/
});
