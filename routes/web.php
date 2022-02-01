<?php

use App\Http\Controllers\FacilityController;
use App\Http\Controllers\GaleriController;
use Illuminate\Support\Facades\{Route, Auth};
use App\Http\Controllers\{AdminController, IndexController, MyLoginController, HomeController, KostController, RegulationController, ResidentController, RoomController};

Auth::routes(['verify' => true]);


Route::post('/logout', [MyLoginController::class, 'logout'])->name('logout');
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['auth', 'verified']);

Route::get('/kost/{slug}', [IndexController::class, 'detailkost'])->name('detailkost')->middleware('guest');
Route::get('/detail-kamar/{slug}', [IndexController::class, 'detailkamar'])->name('detailkamar')->middleware('guest');
Route::get('/all-kosts', [IndexController::class, 'allkosts'])->name('allkosts')->middleware('guest');
Route::get('/all-rooms', [IndexController::class, 'allrooms'])->name('allrooms')->middleware('guest');


//Kost
Route::get('/profile', [KostController::class, 'index'])->name('index')->middleware(['auth', 'verified']);
Route::get('/createSlug', [KostController::class, 'checkSlug'])->name('checkSlug')->middleware(['auth', 'verified']);
Route::post('/addKost', [KostController::class, 'store'])->name('store')->middleware(['auth', 'verified']);
Route::put('/updateProfile/{slug}', [KostController::class, 'update'])->name('update')->middleware(['auth', 'verified']);

//Peraturan
Route::get('/regulation', [RegulationController::class, 'index'])->name('index')->middleware(['auth', 'verified']);
Route::get('/add-regulation', [RegulationController::class, 'create'])->name('create')->middleware(['auth', 'verified']);
Route::get('/createSlugRule', [RegulationController::class, 'checkSlug'])->name('checkSlug')->middleware(['auth', 'verified']);
Route::post('/addRegulations', [RegulationController::class, 'store'])->name('store')->middleware(['auth', 'verified']);
Route::get('/edit-regulation/{slug}', [RegulationController::class, 'edit'])->name('edit')->middleware(['auth', 'verified']);
Route::put('/update-regulation/{slug}', [RegulationController::class, 'update'])->name('update')->middleware(['auth', 'verified']);
Route::delete('/delete-regulation/{slug}', [RegulationController::class, 'destroy'])->name('destroy')->middleware(['auth', 'verified']);

//Fasilitas
Route::get('/facility', [FacilityController::class, 'index'])->name('index')->middleware(['auth', 'verified']);
Route::get('/add-facility', [FacilityController::class, 'create'])->name('create')->middleware(['auth', 'verified']);
Route::post('/addFacility', [FacilityController::class, 'store'])->name('store')->middleware(['auth', 'verified']);
Route::delete('/delete-facility/{slug}', [FacilityController::class, 'destroy'])->name('destroy')->middleware(['auth', 'verified']);


//Kamar
Route::get('/room', [RoomController::class, 'index'])->name('index')->middleware(['auth', 'verified']);
Route::get('/add-room', [RoomController::class, 'create'])->name('create')->middleware(['auth', 'verified']);
Route::get('/createSlugRoom', [RoomController::class, 'checkSlug'])->name('checkSlug')->middleware(['auth', 'verified']);
Route::post('/addRoom', [RoomController::class, 'store'])->name('store')->middleware(['auth', 'verified']);
Route::get('/edit-room/{slug}', [RoomController::class, 'edit'])->name('edit')->middleware(['auth', 'verified']);
Route::get('/room-detail/{slug}', [RoomController::class, 'detail'])->name('detail')->middleware(['auth', 'verified']);
Route::post('/addFotoKamar', [RoomController::class, 'addRoomImg'])->name('addRoomImg')->middleware(['auth', 'verified']);
Route::delete('/delete-imageroom/{slug}', [RoomController::class, 'destroyImageRoom'])->name('destroyImageRoom')->middleware(['auth', 'verified']);
Route::put('/update-room/{slug}', [RoomController::class, 'update'])->name('update')->middleware(['auth', 'verified']);
Route::delete('/delete-room/{slug}', [RoomController::class, 'destroy'])->name('destroy')->middleware(['auth', 'verified']);

//Penghuni
Route::get('/resident', [ResidentController::class, 'index'])->name('index')->middleware(['auth', 'verified']);
Route::get('/add-resident', [ResidentController::class, 'create'])->name('create')->middleware(['auth', 'verified']);
Route::get('/createSlugResident', [ResidentController::class, 'checkSlug'])->name('checkSlug')->middleware(['auth', 'verified']);
Route::post('/addResident', [ResidentController::class, 'store'])->name('store')->middleware(['auth', 'verified']);
Route::delete('/delete-resident/{slug}', [ResidentController::class, 'destroy'])->name('destroy')->middleware(['auth', 'verified']);
Route::get('/edit-resident/{slug}', [ResidentController::class, 'edit'])->name('edit')->middleware(['auth', 'verified']);
Route::put('/update-resident/{slug}', [ResidentController::class, 'update'])->name('update')->middleware(['auth', 'verified']);

//Galeri
Route::get('/galeri', [GaleriController::class, 'index'])->name('index')->middleware(['auth', 'verified']);
Route::post('/addGaleri', [GaleriController::class, 'store'])->name('store')->middleware(['auth', 'verified']);
Route::delete('/delete-imageGaleri/{slug}', [GaleriController::class, 'destroy'])->name('destroy')->middleware(['auth', 'verified']);


//Admin
Route::get('/dashboard-admin', [AdminController::class, 'dashboard'])->name('dashboard')->middleware(['auth', 'verified']);
Route::get('/admin-user', [AdminController::class, 'admin_user'])->name('admin_user')->middleware(['auth', 'verified']);
Route::get('/admin-kost', [AdminController::class, 'admin_kost'])->name('admin_kost')->middleware(['auth', 'verified']);
Route::get('/admin-detailKost/{slug}', [AdminController::class, 'detail_kost'])->name('detail_kost')->middleware(['auth', 'verified']);
Route::get('/admin-kamar', [AdminController::class, 'admin_kamar'])->name('admin_kamar')->middleware(['auth', 'verified']);
Route::get('/admin-detail-kamar/{slug}', [AdminController::class, 'detail_kamar'])->name('detail_kamar')->middleware(['auth', 'verified']);
Route::get('/admin-facility', [AdminController::class, 'admin_fasilitas'])->name('admin_fasilitas')->middleware(['auth', 'verified']);
Route::get('/admin-galeri-foto-kost', [AdminController::class, 'admin_galeri_foto_kost'])->name('admin_galeri_foto_kost')->middleware(['auth', 'verified']);
Route::delete('/delete-imageGaleri-admin/{slug}', [AdminController::class, 'destroy_foto_kost'])->name('destroy_foto_kost')->middleware(['auth', 'verified']);
Route::get('/admin-galeri-foto-kamar', [AdminController::class, 'admin_galeri_foto_kamar'])->name('admin_galeri_foto_kamar')->middleware(['auth', 'verified']);
Route::delete('/delete-imageGaleri-kamar-admin/{slug}', [AdminController::class, 'destroy_foto_kamar'])->name('destroy_foto_kamar')->middleware(['auth', 'verified']);
