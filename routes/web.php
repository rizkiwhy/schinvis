<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InventarisController;
use App\Http\Controllers\PengajuanBarangController;
use App\Http\Controllers\DistribusiBarangController;
use App\Http\Controllers\AlatKerjaController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PermintaanController;
use App\Http\Controllers\PerbaikanController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\RuanganController;
use App\Http\Controllers\GolonganBarangController;
use App\Http\Controllers\BidangBarangController;
use App\Http\Controllers\KelompokBarangController;
use App\Http\Controllers\SubKelompokBarangController;
use App\Http\Controllers\SubSubKelompokBarangController;
use App\Http\Controllers\TitleController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {
    return redirect('/login');
})->name('index');
Route::get('/login', [AuthController::class, 'login'])->name('login.view');
Route::post('/login', [AuthController::class, 'actionLogin'])->name(
    'login.action'
);

Route::middleware(['auth'])->group(function () {
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
    Route::prefix('check')->group(function () {
        Route::get('no-register-inventaris', [
            InventarisController::class,
            'checkNoRegister',
        ])->name('check.inventaris.checkNoRegister');
        Route::get('pengajuan-barang', [
            PengajuanBarangController::class,
            'show',
        ])->name('check.pengajuan.show');
        Route::get('peminjaman-barang', [
            PengajuanBarangController::class,
            'showPeminjaman',
        ])->name('check.peminjaman.showpeminjaman');
        Route::get('user', [UserController::class, 'detail'])->name(
            'check.user.detail'
        );
        Route::get('jenis-barang', [
            SubSubKelompokBarangController::class,
            'detail',
        ])->name('check.subsubkelompokbarang.detail');
    });

    Route::prefix('chart')->group(function () {
        Route::get('pengajuan-barang-bar', [
            DashboardController::class,
            'pengajuanBarangBar',
        ])->name('chart.pengajuanbarangbar');
        Route::get('inventaris-barang-doughnut', [
            DashboardController::class,
            'inventarisBarangDoughnut',
        ])->name('chart.inventarisbarangdoughnut');
        Route::get('user-pie', [DashboardController::class, 'userPie'])->name(
            'chart.userpie'
        );
        Route::get('inventaris-diperbaiki-doughnut', [
            DashboardController::class,
            'inventarisDiperbaikiDoughnut',
        ])->name('chart.inventarisdiperbaikidoughnut');
        Route::get('inventaris-barang-bar', [
            DashboardController::class,
            'inventarisBarangBar',
        ])->name('chart.jenisinventarisbarangbar');
        Route::get('pengajuan-barang-pie', [
            DashboardController::class,
            'pengajuanBarangPie',
        ])->name('chart.pengajuanbarangpie');
        Route::get('inventaris-diperbaiki-bar', [
            DashboardController::class,
            'inventarisDiperbaikiBar',
        ])->name('chart.inventarisdiperbaikibar');
    });

    Route::prefix('administrator')
        ->middleware(['administrator'])
        ->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name(
                'admin.dashboard'
            );
            Route::prefix('gudang')->group(function () {
                Route::prefix('inventaris')->group(function () {
                    Route::get('/', [
                        InventarisController::class,
                        'index',
                    ])->name('admin.gudang.inventaris.index');
                    Route::get('{id}', [
                        InventarisController::class,
                        'show',
                    ])->name('admin.gudang.inventaris.get');
                    Route::get('edit/{id}', [
                        InventarisController::class,
                        'edit',
                    ])->name('admin.gudang.inventaris.edit');
                    Route::post('update', [
                        InventarisController::class,
                        'update',
                    ])->name('admin.gudang.inventaris.update');
                    Route::post('store', [
                        InventarisController::class,
                        'store',
                    ])->name('admin.gudang.inventaris.store');
                    Route::post('destroy', [
                        InventarisController::class,
                        'destroy',
                    ])->name('admin.gudang.inventaris.destroy');
                });

                Route::prefix('pengajuan')->group(function () {
                    Route::get('/', [
                        PengajuanBarangController::class,
                        'indexAntrian',
                    ])->name('admin.gudang.pengajuan.index');
                });

                Route::prefix('distribusi')->group(function () {
                    Route::get('/', [
                        DistribusiBarangController::class,
                        'index',
                    ])->name('admin.gudang.distribusi.index');
                    // Route::get('{id}', [
                    //     DistribusiBarangController::class,
                    //     'show',
                    // ])->name('admin.gudang.distribusi.get');
                    Route::get('edit/{id}', [
                        DistribusiBarangController::class,
                        'edit',
                    ])->name('admin.gudang.distribusi.edit');
                    Route::post('update', [
                        DistribusiBarangController::class,
                        'update',
                    ])->name('admin.gudang.distribusi.update');
                    Route::post('store', [
                        DistribusiBarangController::class,
                        'store',
                    ])->name('admin.gudang.distribusi.store');
                    Route::post('end', [
                        DistribusiBarangController::class,
                        'end',
                    ])->name('admin.gudang.distribusi.end');
                    Route::prefix('pengajuan')->group(function () {
                        Route::get('/', [
                            PengajuanBarangController::class,
                            'index',
                        ])->name('admin.gudang.distribusi.pengajuan.index');
                        Route::get('{id}', [
                            PengajuanBarangController::class,
                            'show',
                        ])->name('admin.gudang.distribusi.pengajuan.get');
                        Route::get('edit/{id}', [
                            PengajuanBarangController::class,
                            'edit',
                        ])->name('admin.gudang.distribusi.pengajuan.edit');
                        Route::post('update', [
                            PengajuanBarangController::class,
                            'update',
                        ])->name('admin.gudang.distribusi.pengajuan.update');
                        Route::post('store', [
                            PengajuanBarangController::class,
                            'store',
                        ])->name('admin.gudang.distribusi.pengajuan.store');
                        Route::post('destroy', [
                            PengajuanBarangController::class,
                            'destroy',
                        ])->name('admin.gudang.distribusi.pengajuan.destroy');
                    });
                });
                Route::prefix('peminjaman')->group(function () {
                    Route::get('/', [
                        PeminjamanController::class,
                        'index',
                    ])->name('admin.gudang.peminjaman.index');
                    // Route::get('{id}', [
                    //     PeminjamanController::class,
                    //     'show',
                    // ])->name('admin.gudang.peminjaman.get');
                    Route::get('edit/{id}', [
                        PeminjamanController::class,
                        'edit',
                    ])->name('admin.gudang.peminjaman.edit');
                    Route::post('update', [
                        PeminjamanController::class,
                        'update',
                    ])->name('admin.gudang.peminjaman.update');
                    Route::post('store', [
                        PeminjamanController::class,
                        'store',
                    ])->name('admin.gudang.peminjaman.store');
                    Route::post('destroy', [
                        PeminjamanController::class,
                        'destroy',
                    ])->name('admin.gudang.peminjaman.destroy');
                    Route::post('end', [
                        PeminjamanController::class,
                        'end',
                    ])->name('admin.gudang.peminjaman.end');
                    Route::prefix('pengajuan')->group(function () {
                        Route::get('/', [
                            PengajuanBarangController::class,
                            'indexPeminjaman',
                        ])->name('admin.gudang.peminjaman.pengajuan.index');
                        Route::get('{id}', [
                            PengajuanBarangController::class,
                            'showPeminjaman',
                        ])->name('admin.gudang.peminjaman.pengajuan.get');
                        Route::get('edit/{id}', [
                            PengajuanBarangController::class,
                            'editPeminjaman',
                        ])->name('admin.gudang.peminjaman.pengajuan.edit');
                        Route::post('update', [
                            PengajuanBarangController::class,
                            'updatePeminjaman',
                        ])->name('admin.gudang.peminjaman.pengajuan.update');
                        Route::post('store-peminjaman', [
                            PengajuanBarangController::class,
                            'storePeminjaman',
                        ])->name(
                            'admin.gudang.peminjaman.pengajuan.storepeminjaman'
                        );
                        Route::post('destroy', [
                            PengajuanBarangController::class,
                            'destroyPeminjaman',
                        ])->name('admin.gudang.peminjaman.pengajuan.destroy');
                    });
                });
                Route::prefix('permintaan')->group(function () {
                    Route::get('/', [
                        PermintaanController::class,
                        'index',
                    ])->name('admin.gudang.permintaan.index');
                    // Route::get('{id}', [
                    //     PermintaanController::class,
                    //     'show',
                    // ])->name('admin.gudang.permintaan.get');
                    Route::get('edit/{id}', [
                        PermintaanController::class,
                        'edit',
                    ])->name('admin.gudang.permintaan.edit');
                    Route::post('update', [
                        PermintaanController::class,
                        'update',
                    ])->name('admin.gudang.permintaan.update');
                    Route::post('store', [
                        PermintaanController::class,
                        'store',
                    ])->name('admin.gudang.permintaan.store');
                    Route::post('destroy', [
                        PermintaanController::class,
                        'destroy',
                    ])->name('admin.gudang.permintaan.destroy');
                    Route::prefix('pengajuan')->group(function () {
                        Route::get('/', [
                            PengajuanBarangController::class,
                            'indexPermintaan',
                        ])->name(
                            'admin.gudang.permintaan.pengajuan.indexpermintaan'
                        );
                        // Route::get('{id}', [
                        //     PengajuanBarangController::class,
                        //     'show',
                        // ])->name('admin.gudang.permintaan.pengajuan.get');
                        Route::get('edit/{id}', [
                            PengajuanBarangController::class,
                            'editPermintaan',
                        ])->name(
                            'admin.gudang.permintaan.pengajuan.editpermintaan'
                        );
                        Route::post('update', [
                            PengajuanBarangController::class,
                            'updatePermintaan',
                        ])->name(
                            'admin.gudang.permintaan.pengajuan.updatepermintaan'
                        );
                        Route::post('store', [
                            PengajuanBarangController::class,
                            'storePermintaan',
                        ])->name(
                            'admin.gudang.permintaan.pengajuan.storepermintaan'
                        );
                        Route::post('destroy', [
                            PengajuanBarangController::class,
                            'destroyPermintaan',
                        ])->name(
                            'admin.gudang.permintaan.pengajuan.destroypermintaan'
                        );
                    });
                });
                Route::prefix('perbaikan')->group(function () {
                    Route::get('/', [
                        PerbaikanController::class,
                        'index',
                    ])->name('admin.gudang.perbaikan.index');
                    Route::get('{id}', [
                        PerbaikanController::class,
                        'show',
                    ])->name('admin.gudang.perbaikan.get');
                    Route::get('edit/{id}', [
                        PerbaikanController::class,
                        'edit',
                    ])->name('admin.gudang.perbaikan.edit');
                    Route::post('update', [
                        PerbaikanController::class,
                        'update',
                    ])->name('admin.gudang.perbaikan.update');
                    Route::post('store', [
                        PerbaikanController::class,
                        'store',
                    ])->name('admin.gudang.perbaikan.store');
                    Route::post('destroy', [
                        PerbaikanController::class,
                        'destroy',
                    ])->name('admin.gudang.perbaikan.destroy');
                    Route::post('start', [
                        PerbaikanController::class,
                        'start',
                    ])->name('admin.gudang.perbaikan.start');
                    Route::post('end', [
                        PerbaikanController::class,
                        'end',
                    ])->name('admin.gudang.perbaikan.end');
                });
            });
            Route::prefix('alat-kerja')->group(function () {
                Route::get('/', [AlatKerjaController::class, 'index'])->name(
                    'admin.alat-kerja.index'
                );
                // Route::get('{id}', [AlatKerjaController::class, 'show'])->name(
                //     'admin.alat-kerja.get'
                // );
                Route::get('edit/{id}', [
                    AlatKerjaController::class,
                    'edit',
                ])->name('admin.alat-kerja.edit');
                Route::post('update', [
                    AlatKerjaController::class,
                    'update',
                ])->name('admin.alat-kerja.update');
                Route::post('store', [
                    AlatKerjaController::class,
                    'store',
                ])->name('admin.alat-kerja.store');
                Route::post('destroy', [
                    AlatKerjaController::class,
                    'destroy',
                ])->name('admin.alat-kerja.destroy');
                Route::post('end', [AlatKerjaController::class, 'end'])->name(
                    'admin.alat-kerja.end'
                );
                Route::prefix('pengajuan')->group(function () {
                    Route::get('/', [
                        PengajuanBarangController::class,
                        'indexPribadi',
                    ])->name('admin.alat-kerja.pengajuan.indexpribadi');
                    Route::get('{id}', [
                        PengajuanBarangController::class,
                        'show',
                    ])->name('admin.alat-kerja.pengajuan.get');
                    Route::get('edit/{id}', [
                        PengajuanBarangController::class,
                        'editPribadi',
                    ])->name('admin.alat-kerja.pengajuan.editpribadi');
                    Route::post('update', [
                        PengajuanBarangController::class,
                        'updatePribadi',
                    ])->name('admin.alat-kerja.pengajuan.updatepribadi');
                    Route::post('store', [
                        PengajuanBarangController::class,
                        'storePribadi',
                    ])->name('admin.alat-kerja.pengajuan.storepribadi');
                    Route::post('destroy', [
                        PengajuanBarangController::class,
                        'destroyPribadi',
                    ])->name('admin.alat-kerja.pengajuan.destroypribadi');
                });
            });
            Route::prefix('transaksi')->group(function () {
                Route::prefix('peminjaman')->group(function () {
                    Route::get('/', [
                        PeminjamanController::class,
                        'indexPribadi',
                    ])->name('admin.transaksi.peminjaman.indexpribadi');
                    // Route::get('{id}', [
                    //     PeminjamanController::class,
                    //     'show',
                    // ])->name('admin.transaksi.peminjaman.get');
                    Route::get('edit/{id}', [
                        PeminjamanController::class,
                        'edit',
                    ])->name('admin.transaksi.peminjaman.edit');
                    Route::post('update', [
                        PeminjamanController::class,
                        'update',
                    ])->name('admin.transaksi.peminjaman.update');
                    Route::post('store', [
                        PeminjamanController::class,
                        'store',
                    ])->name('admin.transaksi.peminjaman.store');
                    Route::post('destroy', [
                        PeminjamanController::class,
                        'destroy',
                    ])->name('admin.transaksi.peminjaman.destroy');
                    Route::post('end', [
                        PeminjamanController::class,
                        'endPribadi',
                    ])->name('admin.transaksi.peminjaman.endpribadi');
                    Route::prefix('pengajuan')->group(function () {
                        Route::get('/', [
                            PengajuanBarangController::class,
                            'indexPeminjamanPribadi',
                        ])->name(
                            'admin.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                        );
                        Route::get('{id}', [
                            PengajuanBarangController::class,
                            'showPeminjaman',
                        ])->name('admin.transaksi.peminjaman.pengajuan.get');
                        Route::get('edit/{id}', [
                            PengajuanBarangController::class,
                            'editPeminjamanPribadi',
                        ])->name(
                            'admin.transaksi.peminjaman.pengajuan.editpeminjamanpribadi'
                        );
                        Route::post('update', [
                            PengajuanBarangController::class,
                            'updatePeminjamanPribadi',
                        ])->name(
                            'admin.transaksi.peminjaman.pengajuan.updatepeminjamanpribadi'
                        );
                        Route::post('store', [
                            PengajuanBarangController::class,
                            'storePeminjamanPribadi',
                        ])->name(
                            'admin.transaksi.peminjaman.pengajuan.storepeminjamanpribadi'
                        );
                        Route::post('destroy', [
                            PengajuanBarangController::class,
                            'destroyPeminjamanPribadi',
                        ])->name(
                            'admin.transaksi.peminjaman.pengajuan.destroypeminjamanpribadi'
                        );
                    });
                });
                Route::prefix('permintaan')->group(function () {
                    Route::get('/', [
                        PermintaanController::class,
                        'indexPribadi',
                    ])->name('admin.transaksi.permintaan.index');
                    // Route::get('{id}', [
                    //     PermintaanController::class,
                    //     'show',
                    // ])->name('admin.transaksi.permintaan.get');
                    Route::get('edit/{id}', [
                        PermintaanController::class,
                        'edit',
                    ])->name('admin.transaksi.permintaan.edit');
                    Route::post('update', [
                        PermintaanController::class,
                        'update',
                    ])->name('admin.transaksi.permintaan.update');
                    Route::post('store', [
                        PermintaanController::class,
                        'store',
                    ])->name('admin.transaksi.permintaan.store');
                    Route::post('destroy', [
                        PermintaanController::class,
                        'destroy',
                    ])->name('admin.transaksi.permintaan.destroy');
                    Route::prefix('pengajuan')->group(function () {
                        Route::get('/', [
                            PengajuanBarangController::class,
                            'indexPermintaanPribadi',
                        ])->name(
                            'admin.transaksi.permintaan.pengajuan.indexpermintaan'
                        );
                        // Route::get('{id}', [
                        //     PengajuanBarangController::class,
                        //     'show',
                        // ])->name('admin.gudang.permintaan.pengajuan.get');
                        Route::get('edit/{id}', [
                            PengajuanBarangController::class,
                            'editPermintaanPribadi',
                        ])->name(
                            'admin.transaksi.permintaan.pengajuan.editpermintaan'
                        );
                        Route::post('update', [
                            PengajuanBarangController::class,
                            'updatePermintaanPribadi',
                        ])->name(
                            'admin.transaksi.permintaan.pengajuan.updatepermintaan'
                        );
                        Route::post('store', [
                            PengajuanBarangController::class,
                            'storePermintaanPribadi',
                        ])->name(
                            'admin.transaksi.permintaan.pengajuan.storepermintaan'
                        );
                        Route::post('destroy', [
                            PengajuanBarangController::class,
                            'destroyPermintaanPribadi',
                        ])->name(
                            'admin.transaksi.permintaan.pengajuan.destroypermintaan'
                        );
                    });
                });
                Route::prefix('perbaikan')->group(function () {
                    Route::get('/', [
                        PerbaikanController::class,
                        'indexPribadi',
                    ])->name('admin.transaksi.perbaikan.indexpribadi');
                    Route::get('{id}', [
                        PerbaikanController::class,
                        'show',
                    ])->name('admin.transaksi.perbaikan.get');
                    Route::get('edit/{id}', [
                        PerbaikanController::class,
                        'editPribadi',
                    ])->name('admin.transaksi.perbaikan.editpribadi');
                    Route::post('update', [
                        PerbaikanController::class,
                        'updatePribadi',
                    ])->name('admin.transaksi.perbaikan.updatepribadi');
                    Route::post('store', [
                        PerbaikanController::class,
                        'storePribadi',
                    ])->name('admin.transaksi.perbaikan.storepribadi');
                    Route::post('destroy', [
                        PerbaikanController::class,
                        'destroyPribadi',
                    ])->name('admin.transaksi.perbaikan.destroypribadi');
                });
            });
            Route::prefix('master')->group(function () {
                Route::prefix('lokasi')->group(function () {
                    Route::prefix('gedung')->group(function () {
                        Route::get('/', [
                            GedungController::class,
                            'index',
                        ])->name('admin.master.lokasi.gedung.index');
                        Route::get('{id}', [
                            GedungController::class,
                            'show',
                        ])->name('admin.master.lokasi.gedung.get');
                        Route::get('edit/{id}', [
                            GedungController::class,
                            'edit',
                        ])->name('admin.master.lokasi.gedung.edit');
                        Route::post('update', [
                            GedungController::class,
                            'update',
                        ])->name('admin.master.lokasi.gedung.update');
                        Route::post('store', [
                            GedungController::class,
                            'store',
                        ])->name('admin.master.lokasi.gedung.store');
                        Route::post('destroy', [
                            GedungController::class,
                            'destroy',
                        ])->name('admin.master.lokasi.gedung.destroy');
                    });
                    Route::prefix('ruangan')->group(function () {
                        Route::get('/', [
                            RuanganController::class,
                            'index',
                        ])->name('admin.master.lokasi.ruangan.index');
                        Route::get('{id}', [
                            RuanganController::class,
                            'show',
                        ])->name('admin.master.lokasi.ruangan.get');
                        Route::get('edit/{id}', [
                            RuanganController::class,
                            'edit',
                        ])->name('admin.master.lokasi.ruangan.edit');
                        Route::post('update', [
                            RuanganController::class,
                            'update',
                        ])->name('admin.master.lokasi.ruangan.update');
                        Route::post('store', [
                            RuanganController::class,
                            'store',
                        ])->name('admin.master.lokasi.ruangan.store');
                        Route::post('destroy', [
                            RuanganController::class,
                            'destroy',
                        ])->name('admin.master.lokasi.ruangan.destroy');
                    });
                });
                Route::prefix('barang')->group(function () {
                    Route::prefix('golongan')->group(function () {
                        Route::get('/', [
                            GolonganBarangController::class,
                            'index',
                        ])->name('admin.master.barang.golongan.index');
                        Route::get('{id}', [
                            GolonganBarangController::class,
                            'show',
                        ])->name('admin.master.barang.golongan.get');
                        Route::get('edit/{id}', [
                            GolonganBarangController::class,
                            'edit',
                        ])->name('admin.master.barang.golongan.edit');
                        Route::post('update', [
                            GolonganBarangController::class,
                            'update',
                        ])->name('admin.master.barang.golongan.update');
                        Route::post('store', [
                            GolonganBarangController::class,
                            'store',
                        ])->name('admin.master.barang.golongan.store');
                        Route::post('destroy', [
                            GolonganBarangController::class,
                            'destroy',
                        ])->name('admin.master.barang.golongan.destroy');
                    });
                    Route::prefix('bidang')->group(function () {
                        Route::get('/', [
                            BidangBarangController::class,
                            'index',
                        ])->name('admin.master.barang.bidang.index');
                        Route::get('{id}', [
                            BidangBarangController::class,
                            'show',
                        ])->name('admin.master.barang.bidang.get');
                        Route::get('edit/{id}', [
                            BidangBarangController::class,
                            'edit',
                        ])->name('admin.master.barang.bidang.edit');
                        Route::post('update', [
                            BidangBarangController::class,
                            'update',
                        ])->name('admin.master.barang.bidang.update');
                        Route::post('store', [
                            BidangBarangController::class,
                            'store',
                        ])->name('admin.master.barang.bidang.store');
                        Route::post('destroy', [
                            BidangBarangController::class,
                            'destroy',
                        ])->name('admin.master.barang.bidang.destroy');
                    });
                    Route::prefix('kelompok')->group(function () {
                        Route::get('/', [
                            KelompokBarangController::class,
                            'index',
                        ])->name('admin.master.barang.kelompok.index');
                        Route::get('{id}', [
                            KelompokBarangController::class,
                            'show',
                        ])->name('admin.master.barang.kelompok.get');
                        Route::get('edit/{id}', [
                            KelompokBarangController::class,
                            'edit',
                        ])->name('admin.master.barang.kelompok.edit');
                        Route::post('update', [
                            KelompokBarangController::class,
                            'update',
                        ])->name('admin.master.barang.kelompok.update');
                        Route::post('store', [
                            KelompokBarangController::class,
                            'store',
                        ])->name('admin.master.barang.kelompok.store');
                        Route::post('destroy', [
                            KelompokBarangController::class,
                            'destroy',
                        ])->name('admin.master.barang.kelompok.destroy');
                    });
                    Route::prefix('subkelompok')->group(function () {
                        Route::get('/', [
                            SubKelompokBarangController::class,
                            'index',
                        ])->name('admin.master.barang.subkelompok.index');
                        Route::get('{id}', [
                            SubKelompokBarangController::class,
                            'show',
                        ])->name('admin.master.barang.subkelompok.get');
                        Route::get('edit/{id}', [
                            SubKelompokBarangController::class,
                            'edit',
                        ])->name('admin.master.barang.subkelompok.edit');
                        Route::post('update', [
                            SubKelompokBarangController::class,
                            'update',
                        ])->name('admin.master.barang.subkelompok.update');
                        Route::post('store', [
                            SubKelompokBarangController::class,
                            'store',
                        ])->name('admin.master.barang.subkelompok.store');
                        Route::post('destroy', [
                            SubKelompokBarangController::class,
                            'destroy',
                        ])->name('admin.master.barang.subkelompok.destroy');
                    });
                    Route::prefix('subsubkelompok')->group(function () {
                        Route::get('/', [
                            SubSubKelompokBarangController::class,
                            'index',
                        ])->name('admin.master.barang.subsubkelompok.index');
                        Route::get('{id}', [
                            SubSubKelompokBarangController::class,
                            'show',
                        ])->name('admin.master.barang.subsubkelompok.get');
                        Route::get('edit/{id}', [
                            SubSubKelompokBarangController::class,
                            'edit',
                        ])->name('admin.master.barang.subsubkelompok.edit');

                        Route::post('update', [
                            SubSubKelompokBarangController::class,
                            'update',
                        ])->name('admin.master.barang.subsubkelompok.update');
                        Route::post('store', [
                            SubSubKelompokBarangController::class,
                            'store',
                        ])->name('admin.master.barang.subsubkelompok.store');
                        Route::post('destroy', [
                            SubSubKelompokBarangController::class,
                            'destroy',
                        ])->name('admin.master.barang.subsubkelompok.destroy');
                    });
                });
                Route::prefix('title')->group(function () {
                    Route::get('/', [TitleController::class, 'index'])->name(
                        'admin.master.title.index'
                    );
                    Route::get('{id}', [TitleController::class, 'show'])->name(
                        'admin.master.title.get'
                    );
                    Route::get('edit/{id}', [
                        TitleController::class,
                        'edit',
                    ])->name('admin.master.title.edit');
                    Route::post('update', [
                        TitleController::class,
                        'update',
                    ])->name('admin.master.title.update');
                    Route::post('store', [
                        TitleController::class,
                        'store',
                    ])->name('admin.master.title.store');
                    Route::post('destroy', [
                        TitleController::class,
                        'destroy',
                    ])->name('admin.master.title.destroy');
                });
            });
            Route::prefix('user')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name(
                    'admin.user.index'
                );
                Route::get('{id}', [UserController::class, 'show'])->name(
                    'admin.user.get'
                );
                Route::get('edit/{id}', [UserController::class, 'edit'])->name(
                    'admin.user.edit'
                );
                Route::post('update', [UserController::class, 'update'])->name(
                    'admin.user.update'
                );
                Route::post('store', [UserController::class, 'store'])->name(
                    'admin.user.store'
                );
                Route::post('destroy', [
                    UserController::class,
                    'destroy',
                ])->name('admin.user.destroy');
            });
            Route::prefix('user-profile')->group(function () {
                Route::get('edit', [
                    UserController::class,
                    'editPribadi',
                ])->name('admin.user-profile.edit');
                Route::post('update', [
                    UserController::class,
                    'updatePribadi',
                ])->name('admin.user-profile.update');
            });
        });

    Route::middleware(['user'])->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name(
            'user.dashboard'
        );

        Route::prefix('alat-kerja')->group(function () {
            Route::get('/', [AlatKerjaController::class, 'index'])->name(
                'user.alat-kerja.index'
            );
            // Route::get('{id}', [AlatKerjaController::class, 'show'])->name(
            //     'user.alat-kerja.get'
            // );
            Route::get('edit/{id}', [AlatKerjaController::class, 'edit'])->name(
                'user.alat-kerja.edit'
            );
            Route::post('update', [AlatKerjaController::class, 'update'])->name(
                'user.alat-kerja.update'
            );
            Route::post('store', [AlatKerjaController::class, 'store'])->name(
                'user.alat-kerja.store'
            );
            Route::post('destroy', [
                AlatKerjaController::class,
                'destroy',
            ])->name('user.alat-kerja.destroy');
            Route::post('end', [AlatKerjaController::class, 'end'])->name(
                'user.alat-kerja.end'
            );
            Route::prefix('pengajuan')->group(function () {
                Route::get('/', [
                    PengajuanBarangController::class,
                    'indexPribadi',
                ])->name('user.alat-kerja.pengajuan.indexpribadi');
                Route::get('{id}', [
                    PengajuanBarangController::class,
                    'show',
                ])->name('user.alat-kerja.pengajuan.get');
                Route::get('edit/{id}', [
                    PengajuanBarangController::class,
                    'editPribadi',
                ])->name('user.alat-kerja.pengajuan.editpribadi');
                Route::post('update', [
                    PengajuanBarangController::class,
                    'updatePribadi',
                ])->name('user.alat-kerja.pengajuan.updatepribadi');
                Route::post('store', [
                    PengajuanBarangController::class,
                    'storePribadi',
                ])->name('user.alat-kerja.pengajuan.storepribadi');
                Route::post('destroy', [
                    PengajuanBarangController::class,
                    'destroyPribadi',
                ])->name('user.alat-kerja.pengajuan.destroypribadi');
            });
        });
        Route::prefix('transaksi')->group(function () {
            Route::prefix('peminjaman')->group(function () {
                Route::get('/', [
                    PeminjamanController::class,
                    'indexPribadi',
                ])->name('user.transaksi.peminjaman.indexpribadi');
                // Route::get('{id}', [PeminjamanController::class, 'show'])->name(
                //     'user.transaksi.peminjaman.get'
                // );
                Route::get('edit/{id}', [
                    PeminjamanController::class,
                    'edit',
                ])->name('user.transaksi.peminjaman.edit');
                Route::post('update', [
                    PeminjamanController::class,
                    'update',
                ])->name('user.transaksi.peminjaman.update');
                Route::post('store', [
                    PeminjamanController::class,
                    'store',
                ])->name('user.transaksi.peminjaman.store');
                Route::post('destroy', [
                    PeminjamanController::class,
                    'destroy',
                ])->name('user.transaksi.peminjaman.destroy');
                Route::post('end', [
                    PeminjamanController::class,
                    'endPribadi',
                ])->name('user.transaksi.peminjaman.endpribadi');
                Route::prefix('pengajuan')->group(function () {
                    Route::get('/', [
                        PengajuanBarangController::class,
                        'indexPeminjamanPribadi',
                    ])->name(
                        'user.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                    );
                    Route::get('{id}', [
                        PengajuanBarangController::class,
                        'showPeminjaman',
                    ])->name('user.transaksi.peminjaman.pengajuan.get');
                    Route::get('edit/{id}', [
                        PengajuanBarangController::class,
                        'editPeminjamanPribadi',
                    ])->name(
                        'user.transaksi.peminjaman.pengajuan.editpeminjamanpribadi'
                    );
                    Route::post('update', [
                        PengajuanBarangController::class,
                        'updatePeminjamanPribadi',
                    ])->name(
                        'user.transaksi.peminjaman.pengajuan.updatepeminjamanpribadi'
                    );
                    Route::post('store', [
                        PengajuanBarangController::class,
                        'storePeminjamanPribadi',
                    ])->name(
                        'user.transaksi.peminjaman.pengajuan.storepeminjamanpribadi'
                    );
                    Route::post('destroy', [
                        PengajuanBarangController::class,
                        'destroyPeminjamanPribadi',
                    ])->name(
                        'user.transaksi.peminjaman.pengajuan.destroypeminjamanpribadi'
                    );
                });
            });
            Route::prefix('permintaan')->group(function () {
                Route::get('/', [
                    PermintaanController::class,
                    'indexPribadi',
                ])->name('user.transaksi.permintaan.index');
                // Route::get('{id}', [PermintaanController::class, 'show'])->name(
                //     'user.transaksi.permintaan.get'
                // );
                Route::get('edit/{id}', [
                    PermintaanController::class,
                    'edit',
                ])->name('user.transaksi.permintaan.edit');
                Route::post('update', [
                    PermintaanController::class,
                    'update',
                ])->name('user.transaksi.permintaan.update');
                Route::post('store', [
                    PermintaanController::class,
                    'store',
                ])->name('user.transaksi.permintaan.store');
                Route::post('destroy', [
                    PermintaanController::class,
                    'destroy',
                ])->name('user.transaksi.permintaan.destroy');
                Route::prefix('pengajuan')->group(function () {
                    Route::get('/', [
                        PengajuanBarangController::class,
                        'indexPermintaanPribadi',
                    ])->name(
                        'user.transaksi.permintaan.pengajuan.indexpermintaan'
                    );
                    // Route::get('{id}', [
                    //     PengajuanBarangController::class,
                    //     'show',
                    // ])->name('admin.gudang.permintaan.pengajuan.get');
                    Route::get('edit/{id}', [
                        PengajuanBarangController::class,
                        'editPermintaanPribadi',
                    ])->name(
                        'user.transaksi.permintaan.pengajuan.editpermintaan'
                    );
                    Route::post('update', [
                        PengajuanBarangController::class,
                        'updatePermintaanPribadi',
                    ])->name(
                        'user.transaksi.permintaan.pengajuan.updatepermintaan'
                    );
                    Route::post('store', [
                        PengajuanBarangController::class,
                        'storePermintaanPribadi',
                    ])->name(
                        'user.transaksi.permintaan.pengajuan.storepermintaan'
                    );
                    Route::post('destroy', [
                        PengajuanBarangController::class,
                        'destroyPermintaanPribadi',
                    ])->name(
                        'user.transaksi.permintaan.pengajuan.destroypermintaan'
                    );
                });
            });
            Route::prefix('perbaikan')->group(function () {
                Route::get('/', [
                    PerbaikanController::class,
                    'indexPribadi',
                ])->name('user.transaksi.perbaikan.indexpribadi');
                Route::get('{id}', [PerbaikanController::class, 'show'])->name(
                    'user.transaksi.perbaikan.get'
                );
                Route::get('edit/{id}', [
                    PerbaikanController::class,
                    'editPribadi',
                ])->name('user.transaksi.perbaikan.editpribadi');
                Route::post('update', [
                    PerbaikanController::class,
                    'updatePribadi',
                ])->name('user.transaksi.perbaikan.updatepribadi');
                Route::post('store', [
                    PerbaikanController::class,
                    'storePribadi',
                ])->name('user.transaksi.perbaikan.storepribadi');
                Route::post('destroy', [
                    PerbaikanController::class,
                    'destroyPribadi',
                ])->name('user.transaksi.perbaikan.destroypribadi');
            });
        });
        Route::prefix('user-profile')->group(function () {
            Route::get('edit', [UserController::class, 'editPribadi'])->name(
                'user.user-profile.edit'
            );
            Route::post('update', [
                UserController::class,
                'updatePribadi',
            ])->name('user.user-profile.update');
        });
    });

    Route::prefix('management')
        ->middleware(['management'])
        ->group(function () {
            Route::get('/', [DashboardController::class, 'index'])->name(
                'management.dashboard'
            );
            Route::prefix('gudang')->group(function () {
                Route::prefix('inventaris')->group(function () {
                    Route::get('/', [
                        InventarisController::class,
                        'index',
                    ])->name('manajemen.gudang.inventaris.index');
                    Route::get('{id}', [
                        InventarisController::class,
                        'show',
                    ])->name('manajemen.gudang.inventaris.get');
                    Route::get('edit/{id}', [
                        InventarisController::class,
                        'edit',
                    ])->name('manajemen.gudang.inventaris.edit');
                    Route::post('update', [
                        InventarisController::class,
                        'update',
                    ])->name('manajemen.gudang.inventaris.update');
                    Route::post('store', [
                        InventarisController::class,
                        'store',
                    ])->name('manajemen.gudang.inventaris.store');
                    Route::post('destroy', [
                        InventarisController::class,
                        'destroy',
                    ])->name('manajemen.gudang.inventaris.destroy');
                });

                Route::prefix('pengajuan')->group(function () {
                    Route::get('/', [
                        PengajuanBarangController::class,
                        'indexAll',
                    ])->name('manajemen.gudang.pengajuan.index');
                });

                Route::prefix('distribusi')->group(function () {
                    Route::get('/', [
                        DistribusiBarangController::class,
                        'index',
                    ])->name('manajemen.gudang.distribusi.index');
                    // Route::get('{id}', [
                    //     DistribusiBarangController::class,
                    //     'show',
                    // ])->name('manajemen.gudang.distribusi.get');
                    Route::get('edit/{id}', [
                        DistribusiBarangController::class,
                        'edit',
                    ])->name('manajemen.gudang.distribusi.edit');
                    Route::post('update', [
                        DistribusiBarangController::class,
                        'update',
                    ])->name('manajemen.gudang.distribusi.update');
                    Route::post('store', [
                        DistribusiBarangController::class,
                        'store',
                    ])->name('manajemen.gudang.distribusi.store');
                    Route::post('end', [
                        DistribusiBarangController::class,
                        'end',
                    ])->name('manajemen.gudang.distribusi.end');
                    Route::prefix('pengajuan')->group(function () {
                        Route::get('/', [
                            PengajuanBarangController::class,
                            'index',
                        ])->name('manajemen.gudang.distribusi.pengajuan.index');
                        Route::get('{id}', [
                            PengajuanBarangController::class,
                            'show',
                        ])->name('manajemen.gudang.distribusi.pengajuan.get');
                        Route::get('edit/{id}', [
                            PengajuanBarangController::class,
                            'edit',
                        ])->name('manajemen.gudang.distribusi.pengajuan.edit');
                        Route::post('update', [
                            PengajuanBarangController::class,
                            'update',
                        ])->name(
                            'manajemen.gudang.distribusi.pengajuan.update'
                        );
                        Route::post('store', [
                            PengajuanBarangController::class,
                            'store',
                        ])->name('manajemen.gudang.distribusi.pengajuan.store');
                        Route::post('destroy', [
                            PengajuanBarangController::class,
                            'destroy',
                        ])->name(
                            'manajemen.gudang.distribusi.pengajuan.destroy'
                        );
                    });
                });
                Route::prefix('peminjaman')->group(function () {
                    Route::get('/', [
                        PeminjamanController::class,
                        'index',
                    ])->name('manajemen.gudang.peminjaman.index');
                    // Route::get('{id}', [
                    //     PeminjamanController::class,
                    //     'show',
                    // ])->name('manajemen.gudang.peminjaman.get');
                    Route::get('edit/{id}', [
                        PeminjamanController::class,
                        'edit',
                    ])->name('manajemen.gudang.peminjaman.edit');
                    Route::post('update', [
                        PeminjamanController::class,
                        'update',
                    ])->name('manajemen.gudang.peminjaman.update');
                    Route::post('store', [
                        PeminjamanController::class,
                        'store',
                    ])->name('manajemen.gudang.peminjaman.store');
                    Route::post('destroy', [
                        PeminjamanController::class,
                        'destroy',
                    ])->name('manajemen.gudang.peminjaman.destroy');
                    Route::post('end', [
                        PeminjamanController::class,
                        'end',
                    ])->name('manajemen.gudang.peminjaman.end');
                    Route::prefix('pengajuan')->group(function () {
                        Route::get('/', [
                            PengajuanBarangController::class,
                            'indexPeminjaman',
                        ])->name('manajemen.gudang.peminjaman.pengajuan.index');
                        Route::get('{id}', [
                            PengajuanBarangController::class,
                            'showPeminjaman',
                        ])->name('manajemen.gudang.peminjaman.pengajuan.get');
                        Route::get('edit/{id}', [
                            PengajuanBarangController::class,
                            'editPeminjaman',
                        ])->name('manajemen.gudang.peminjaman.pengajuan.edit');
                        Route::post('update', [
                            PengajuanBarangController::class,
                            'updatePeminjaman',
                        ])->name(
                            'manajemen.gudang.peminjaman.pengajuan.update'
                        );
                        Route::post('store', [
                            PengajuanBarangController::class,
                            'storePeminjaman',
                        ])->name(
                            'manajemen.gudang.peminjaman.pengajuan.storepeminjaman'
                        );
                        Route::post('destroy', [
                            PengajuanBarangController::class,
                            'destroyPeminjaman',
                        ])->name(
                            'manajemen.gudang.peminjaman.pengajuan.destroy'
                        );
                    });
                });
                Route::prefix('permintaan')->group(function () {
                    Route::get('/', [
                        PermintaanController::class,
                        'index',
                    ])->name('manajemen.gudang.permintaan.index');
                    // Route::get('{id}', [
                    //     PermintaanController::class,
                    //     'show',
                    // ])->name('manajemen.gudang.permintaan.get');
                    Route::get('edit/{id}', [
                        PermintaanController::class,
                        'edit',
                    ])->name('manajemen.gudang.permintaan.edit');
                    Route::post('update', [
                        PermintaanController::class,
                        'update',
                    ])->name('manajemen.gudang.permintaan.update');
                    Route::post('store', [
                        PermintaanController::class,
                        'store',
                    ])->name('manajemen.gudang.permintaan.store');
                    Route::post('destroy', [
                        PermintaanController::class,
                        'destroy',
                    ])->name('manajemen.gudang.permintaan.destroy');
                    Route::prefix('pengajuan')->group(function () {
                        Route::get('/', [
                            PengajuanBarangController::class,
                            'indexPermintaan',
                        ])->name(
                            'manajemen.gudang.permintaan.pengajuan.indexpermintaan'
                        );
                        // Route::get('{id}', [
                        //     PengajuanBarangController::class,
                        //     'show',
                        // ])->name('admin.gudang.permintaan.pengajuan.get');
                        Route::get('edit/{id}', [
                            PengajuanBarangController::class,
                            'editPermintaan',
                        ])->name(
                            'manajemen.gudang.permintaan.pengajuan.editpermintaan'
                        );
                        Route::post('update', [
                            PengajuanBarangController::class,
                            'updatePermintaan',
                        ])->name(
                            'manajemen.gudang.permintaan.pengajuan.updatepermintaan'
                        );
                        Route::post('store-permintaan', [
                            PengajuanBarangController::class,
                            'storePermintaan',
                        ])->name(
                            'manajemen.gudang.permintaan.pengajuan.storepermintaan'
                        );
                        Route::post('destroy', [
                            PengajuanBarangController::class,
                            'destroyPermintaan',
                        ])->name(
                            'manajemen.gudang.permintaan.pengajuan.destroypermintaan'
                        );
                    });
                });
                Route::prefix('perbaikan')->group(function () {
                    Route::get('/', [
                        PerbaikanController::class,
                        'index',
                    ])->name('manajemen.gudang.perbaikan.index');
                    Route::get('{id}', [
                        PerbaikanController::class,
                        'show',
                    ])->name('manajemen.gudang.perbaikan.get');
                    Route::get('edit/{id}', [
                        PerbaikanController::class,
                        'edit',
                    ])->name('manajemen.gudang.perbaikan.edit');
                    Route::post('update', [
                        PerbaikanController::class,
                        'update',
                    ])->name('manajemen.gudang.perbaikan.update');
                    Route::post('store', [
                        PerbaikanController::class,
                        'store',
                    ])->name('manajemen.gudang.perbaikan.store');
                    Route::post('destroy', [
                        PerbaikanController::class,
                        'destroy',
                    ])->name('manajemen.gudang.perbaikan.destroy');
                    Route::post('start', [
                        PerbaikanController::class,
                        'start',
                    ])->name('manajemen.gudang.perbaikan.start');
                    Route::post('end', [
                        PerbaikanController::class,
                        'end',
                    ])->name('manajemen.gudang.perbaikan.end');
                });
            });
            Route::prefix('alat-kerja')->group(function () {
                Route::get('/', [AlatKerjaController::class, 'index'])->name(
                    'manajemen.alat-kerja.index'
                );
                // Route::get('{id}', [AlatKerjaController::class, 'show'])->name(
                //     'manajemen.alat-kerja.get'
                // );
                Route::get('edit/{id}', [
                    AlatKerjaController::class,
                    'edit',
                ])->name('manajemen.alat-kerja.edit');
                Route::post('update', [
                    AlatKerjaController::class,
                    'update',
                ])->name('manajemen.alat-kerja.update');
                Route::post('store', [
                    AlatKerjaController::class,
                    'store',
                ])->name('manajemen.alat-kerja.store');
                Route::post('destroy', [
                    AlatKerjaController::class,
                    'destroy',
                ])->name('manajemen.alat-kerja.destroy');
                Route::post('end', [AlatKerjaController::class, 'end'])->name(
                    'manajemen.alat-kerja.end'
                );
                Route::prefix('pengajuan')->group(function () {
                    Route::get('/', [
                        PengajuanBarangController::class,
                        'indexPribadi',
                    ])->name('manajemen.alat-kerja.pengajuan.indexpribadi');
                    Route::get('{id}', [
                        PengajuanBarangController::class,
                        'show',
                    ])->name('manajemen.alat-kerja.pengajuan.get');
                    Route::get('edit/{id}', [
                        PengajuanBarangController::class,
                        'editPribadi',
                    ])->name('manajemen.alat-kerja.pengajuan.editpribadi');
                    Route::post('update', [
                        PengajuanBarangController::class,
                        'updatePribadi',
                    ])->name('manajemen.alat-kerja.pengajuan.updatepribadi');
                    Route::post('store', [
                        PengajuanBarangController::class,
                        'storePribadi',
                    ])->name('manajemen.alat-kerja.pengajuan.storepribadi');
                    Route::post('destroy', [
                        PengajuanBarangController::class,
                        'destroyPribadi',
                    ])->name('manajemen.alat-kerja.pengajuan.destroypribadi');
                });
            });
            Route::prefix('transaksi')->group(function () {
                Route::prefix('peminjaman')->group(function () {
                    Route::get('/', [
                        PeminjamanController::class,
                        'indexPribadi',
                    ])->name('manajemen.transaksi.peminjaman.indexpribadi');
                    // Route::get('{id}', [
                    //     PeminjamanController::class,
                    //     'show',
                    // ])->name('manajemen.transaksi.peminjaman.get');
                    Route::get('edit/{id}', [
                        PeminjamanController::class,
                        'edit',
                    ])->name('manajemen.transaksi.peminjaman.edit');
                    Route::post('update', [
                        PeminjamanController::class,
                        'update',
                    ])->name('manajemen.transaksi.peminjaman.update');
                    Route::post('store', [
                        PeminjamanController::class,
                        'store',
                    ])->name('manajemen.transaksi.peminjaman.store');
                    Route::post('destroy', [
                        PeminjamanController::class,
                        'destroy',
                    ])->name('manajemen.transaksi.peminjaman.destroy');
                    Route::post('end', [
                        PeminjamanController::class,
                        'endPribadi',
                    ])->name('manajemen.transaksi.peminjaman.endpribadi');
                    Route::prefix('pengajuan')->group(function () {
                        Route::get('/', [
                            PengajuanBarangController::class,
                            'indexPeminjamanPribadi',
                        ])->name(
                            'manajemen.transaksi.peminjaman.pengajuan.indexpeminjamanpribadi'
                        );
                        Route::get('{id}', [
                            PengajuanBarangController::class,
                            'showPeminjaman',
                        ])->name(
                            'manajemen.transaksi.peminjaman.pengajuan.get'
                        );
                        Route::get('edit/{id}', [
                            PengajuanBarangController::class,
                            'editPeminjamanPribadi',
                        ])->name(
                            'manajemen.transaksi.peminjaman.pengajuan.editpeminjamanpribadi'
                        );
                        Route::post('update', [
                            PengajuanBarangController::class,
                            'updatePeminjamanPribadi',
                        ])->name(
                            'manajemen.transaksi.peminjaman.pengajuan.updatepeminjamanpribadi'
                        );
                        Route::post('store', [
                            PengajuanBarangController::class,
                            'storePeminjamanPribadi',
                        ])->name(
                            'manajemen.transaksi.peminjaman.pengajuan.storepeminjamanpribadi'
                        );
                        Route::post('destroy', [
                            PengajuanBarangController::class,
                            'destroyPeminjamanPribadi',
                        ])->name(
                            'manajemen.transaksi.peminjaman.pengajuan.destroypeminjamanpribadi'
                        );
                    });
                });
                Route::prefix('permintaan')->group(function () {
                    Route::get('/', [
                        PermintaanController::class,
                        'indexPribadi',
                    ])->name('manajemen.transaksi.permintaan.index');
                    // Route::get('{id}', [
                    //     PermintaanController::class,
                    //     'show',
                    // ])->name('manajemen.transaksi.permintaan.get');
                    Route::get('edit/{id}', [
                        PermintaanController::class,
                        'edit',
                    ])->name('manajemen.transaksi.permintaan.edit');
                    Route::post('update', [
                        PermintaanController::class,
                        'update',
                    ])->name('manajemen.transaksi.permintaan.update');
                    Route::post('store', [
                        PermintaanController::class,
                        'store',
                    ])->name('manajemen.transaksi.permintaan.store');
                    Route::post('destroy', [
                        PermintaanController::class,
                        'destroy',
                    ])->name('manajemen.transaksi.permintaan.destroy');
                    Route::prefix('pengajuan')->group(function () {
                        Route::get('/', [
                            PengajuanBarangController::class,
                            'indexPermintaanPribadi',
                        ])->name(
                            'manajemen.transaksi.permintaan.pengajuan.indexpermintaan'
                        );
                        // Route::get('{id}', [
                        //     PengajuanBarangController::class,
                        //     'show',
                        // ])->name('admin.gudang.permintaan.pengajuan.get');
                        Route::get('edit/{id}', [
                            PengajuanBarangController::class,
                            'editPermintaanPribadi',
                        ])->name(
                            'manajemen.transaksi.permintaan.pengajuan.editpermintaan'
                        );
                        Route::post('update', [
                            PengajuanBarangController::class,
                            'updatePermintaanPribadi',
                        ])->name(
                            'manajemen.transaksi.permintaan.pengajuan.updatepermintaan'
                        );
                        Route::post('store', [
                            PengajuanBarangController::class,
                            'storePermintaanPribadi',
                        ])->name(
                            'manajemen.transaksi.permintaan.pengajuan.storepermintaan'
                        );
                        Route::post('destroy', [
                            PengajuanBarangController::class,
                            'destroyPermintaanPribadi',
                        ])->name(
                            'manajemen.transaksi.permintaan.pengajuan.destroypermintaan'
                        );
                    });
                });
                Route::prefix('perbaikan')->group(function () {
                    Route::get('/', [
                        PerbaikanController::class,
                        'indexPribadi',
                    ])->name('manajemen.transaksi.perbaikan.indexpribadi');
                    Route::get('{id}', [
                        PerbaikanController::class,
                        'show',
                    ])->name('manajemen.transaksi.perbaikan.get');
                    Route::get('edit/{id}', [
                        PerbaikanController::class,
                        'editPribadi',
                    ])->name('manajemen.transaksi.perbaikan.editpribadi');
                    Route::post('update', [
                        PerbaikanController::class,
                        'updatePribadi',
                    ])->name('manajemen.transaksi.perbaikan.updatepribadi');
                    Route::post('store', [
                        PerbaikanController::class,
                        'storePribadi',
                    ])->name('manajemen.transaksi.perbaikan.storepribadi');
                    Route::post('destroy', [
                        PerbaikanController::class,
                        'destroyPribadi',
                    ])->name('manajemen.transaksi.perbaikan.destroypribadi');
                });
            });
            Route::prefix('master')->group(function () {
                Route::prefix('lokasi')->group(function () {
                    Route::prefix('gedung')->group(function () {
                        Route::get('/', [
                            GedungController::class,
                            'index',
                        ])->name('manajemen.master.lokasi.gedung.index');
                        Route::get('{id}', [
                            GedungController::class,
                            'show',
                        ])->name('manajemen.master.lokasi.gedung.get');
                        Route::get('edit/{id}', [
                            GedungController::class,
                            'edit',
                        ])->name('manajemen.master.lokasi.gedung.edit');
                        Route::post('update', [
                            GedungController::class,
                            'update',
                        ])->name('manajemen.master.lokasi.gedung.update');
                        Route::post('store', [
                            GedungController::class,
                            'store',
                        ])->name('manajemen.master.lokasi.gedung.store');
                        Route::post('destroy', [
                            GedungController::class,
                            'destroy',
                        ])->name('manajemen.master.lokasi.gedung.destroy');
                    });
                    Route::prefix('ruangan')->group(function () {
                        Route::get('/', [
                            RuanganController::class,
                            'index',
                        ])->name('manajemen.master.lokasi.ruangan.index');
                        Route::get('{id}', [
                            RuanganController::class,
                            'show',
                        ])->name('manajemen.master.lokasi.ruangan.get');
                        Route::get('edit/{id}', [
                            RuanganController::class,
                            'edit',
                        ])->name('manajemen.master.lokasi.ruangan.edit');
                        Route::post('update', [
                            RuanganController::class,
                            'update',
                        ])->name('manajemen.master.lokasi.ruangan.update');
                        Route::post('store', [
                            RuanganController::class,
                            'store',
                        ])->name('manajemen.master.lokasi.ruangan.store');
                        Route::post('destroy', [
                            RuanganController::class,
                            'destroy',
                        ])->name('manajemen.master.lokasi.ruangan.destroy');
                    });
                });
                Route::prefix('barang')->group(function () {
                    Route::prefix('golongan')->group(function () {
                        Route::get('/', [
                            GolonganBarangController::class,
                            'index',
                        ])->name('manajemen.master.barang.golongan.index');
                        Route::get('{id}', [
                            GolonganBarangController::class,
                            'show',
                        ])->name('manajemen.master.barang.golongan.get');
                        Route::get('edit/{id}', [
                            GolonganBarangController::class,
                            'edit',
                        ])->name('manajemen.master.barang.golongan.edit');
                        Route::post('update', [
                            GolonganBarangController::class,
                            'update',
                        ])->name('manajemen.master.barang.golongan.update');
                        Route::post('store', [
                            GolonganBarangController::class,
                            'store',
                        ])->name('manajemen.master.barang.golongan.store');
                        Route::post('destroy', [
                            GolonganBarangController::class,
                            'destroy',
                        ])->name('manajemen.master.barang.golongan.destroy');
                    });
                    Route::prefix('bidang')->group(function () {
                        Route::get('/', [
                            BidangBarangController::class,
                            'index',
                        ])->name('manajemen.master.barang.bidang.index');
                        Route::get('{id}', [
                            BidangBarangController::class,
                            'show',
                        ])->name('manajemen.master.barang.bidang.get');
                        Route::get('edit/{id}', [
                            BidangBarangController::class,
                            'edit',
                        ])->name('manajemen.master.barang.bidang.edit');
                        Route::post('update', [
                            BidangBarangController::class,
                            'update',
                        ])->name('manajemen.master.barang.bidang.update');
                        Route::post('store', [
                            BidangBarangController::class,
                            'store',
                        ])->name('manajemen.master.barang.bidang.store');
                        Route::post('destroy', [
                            BidangBarangController::class,
                            'destroy',
                        ])->name('manajemen.master.barang.bidang.destroy');
                    });
                    Route::prefix('kelompok')->group(function () {
                        Route::get('/', [
                            KelompokBarangController::class,
                            'index',
                        ])->name('manajemen.master.barang.kelompok.index');
                        Route::get('{id}', [
                            KelompokBarangController::class,
                            'show',
                        ])->name('manajemen.master.barang.kelompok.get');
                        Route::get('edit/{id}', [
                            KelompokBarangController::class,
                            'edit',
                        ])->name('manajemen.master.barang.kelompok.edit');
                        Route::post('update', [
                            KelompokBarangController::class,
                            'update',
                        ])->name('manajemen.master.barang.kelompok.update');
                        Route::post('store', [
                            KelompokBarangController::class,
                            'store',
                        ])->name('manajemen.master.barang.kelompok.store');
                        Route::post('destroy', [
                            KelompokBarangController::class,
                            'destroy',
                        ])->name('manajemen.master.barang.kelompok.destroy');
                    });
                    Route::prefix('subkelompok')->group(function () {
                        Route::get('/', [
                            SubKelompokBarangController::class,
                            'index',
                        ])->name('manajemen.master.barang.subkelompok.index');
                        Route::get('{id}', [
                            SubKelompokBarangController::class,
                            'show',
                        ])->name('manajemen.master.barang.subkelompok.get');
                        Route::get('edit/{id}', [
                            SubKelompokBarangController::class,
                            'edit',
                        ])->name('manajemen.master.barang.subkelompok.edit');
                        Route::post('update', [
                            SubKelompokBarangController::class,
                            'update',
                        ])->name('manajemen.master.barang.subkelompok.update');
                        Route::post('store', [
                            SubKelompokBarangController::class,
                            'store',
                        ])->name('manajemen.master.barang.subkelompok.store');
                        Route::post('destroy', [
                            SubKelompokBarangController::class,
                            'destroy',
                        ])->name('manajemen.master.barang.subkelompok.destroy');
                    });
                    Route::prefix('subsubkelompok')->group(function () {
                        Route::get('/', [
                            SubSubKelompokBarangController::class,
                            'index',
                        ])->name(
                            'manajemen.master.barang.subsubkelompok.index'
                        );
                        Route::get('{id}', [
                            SubSubKelompokBarangController::class,
                            'show',
                        ])->name('manajemen.master.barang.subsubkelompok.get');
                        Route::get('edit/{id}', [
                            SubSubKelompokBarangController::class,
                            'edit',
                        ])->name('manajemen.master.barang.subsubkelompok.edit');

                        Route::post('update', [
                            SubSubKelompokBarangController::class,
                            'update',
                        ])->name(
                            'manajemen.master.barang.subsubkelompok.update'
                        );
                        Route::post('store', [
                            SubSubKelompokBarangController::class,
                            'store',
                        ])->name(
                            'manajemen.master.barang.subsubkelompok.store'
                        );
                        Route::post('destroy', [
                            SubSubKelompokBarangController::class,
                            'destroy',
                        ])->name(
                            'manajemen.master.barang.subsubkelompok.destroy'
                        );
                    });
                });
                Route::prefix('title')->group(function () {
                    Route::get('/', [TitleController::class, 'index'])->name(
                        'manajemen.master.title.index'
                    );
                    Route::get('{id}', [TitleController::class, 'show'])->name(
                        'manajemen.master.title.get'
                    );
                    Route::get('edit/{id}', [
                        TitleController::class,
                        'edit',
                    ])->name('manajemen.master.title.edit');
                    Route::post('update', [
                        TitleController::class,
                        'update',
                    ])->name('manajemen.master.title.update');
                    Route::post('store', [
                        TitleController::class,
                        'store',
                    ])->name('manajemen.master.title.store');
                    Route::post('destroy', [
                        TitleController::class,
                        'destroy',
                    ])->name('manajemen.master.title.destroy');
                });
            });
            Route::prefix('user')->group(function () {
                Route::get('/', [UserController::class, 'index'])->name(
                    'manajemen.user.index'
                );
                Route::get('{id}', [UserController::class, 'show'])->name(
                    'manajemen.user.get'
                );
                Route::get('edit/{id}', [UserController::class, 'edit'])->name(
                    'manajemen.user.edit'
                );
                Route::post('update', [UserController::class, 'update'])->name(
                    'manajemen.user.update'
                );
                Route::post('store', [UserController::class, 'store'])->name(
                    'manajemen.user.store'
                );
                Route::post('destroy', [
                    UserController::class,
                    'destroy',
                ])->name('admin.user.destroy');
            });
            Route::prefix('user-profile')->group(function () {
                Route::get('edit', [
                    UserController::class,
                    'editPribadi',
                ])->name('manajemen.user-profile.edit');
                Route::post('update', [
                    UserController::class,
                    'updatePribadi',
                ])->name('manajemen.user-profile.update');
            });
        });
});
