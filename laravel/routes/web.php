<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileVillageController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\SuratController;
use App\Http\Controllers\TemplateSuratController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AparaturController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\VillageDataController;
use App\Http\Controllers\RefMasterController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Public Routes (Blade - DesaDigital)
|--------------------------------------------------------------------------
*/
Route::prefix('/')->group(function () {
    Route::get('', [ProfileVillageController::class, 'index'])->name('profiledesaindex');
    Route::get('berita', [ProfileVillageController::class, 'newsIndex'])->name('berita');
    Route::get('berita/{news}', [ProfileVillageController::class, 'newsShow'])->name('berita.show');
    Route::post('berita/comment', [ProfileVillageController::class, 'storeComment'])->name('berita.comment');

    Route::get('contact', [ProfileVillageController::class, 'contactIndex'])->name('contact');
    Route::post('contact', [ProfileVillageController::class, 'sendContactForm'])->name('contact.send');

    Route::prefix('keuangan/')->group(function () {
        Route::get('apbdesa', [ProfileVillageController::class, 'apbDesaIndex'])->name('apbdesa');
    });

    Route::post('comments', [ProfileVillageController::class, 'commentstore'])->name('comments.store');
    Route::get('map', [ProfileVillageController::class, 'villageMapIndex'])->name('map');
    Route::get('profilvillage', [ProfileVillageController::class, 'profilevillage'])->name('profilevillage');
    Route::get('demografi', [ProfileVillageController::class, 'demografi'])->name('demografi');
    Route::get('visimisi', [ProfileVillageController::class, 'visimisi'])->name('visimisi');
    Route::get('sejarah', [ProfileVillageController::class, 'sejarah'])->name('sejarah');
    Route::get('monografi', [ProfileVillageController::class, 'monografi'])->name('monografi');
    Route::get('pelayanan', [ProfileVillageController::class, 'pelayanan'])->name('pelayanan');
    Route::get('pasardesa', [ProfileVillageController::class, 'pasarDesa'])->name('pasardesa');
    Route::get('pasardesa/{id}', [ProfileVillageController::class, 'showPasarDesa'])->name('pasardesa.show');
});

/*
|--------------------------------------------------------------------------
| Auth Routes (Breeze / Inertia)
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (desadigital)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')->middleware(['auth'])->group(function () {
    // Dashboard Admin
    Route::get('home', [HomeController::class, 'index'])->name('home');

    // User Management
    Route::resource('users', UserController::class);
    Route::post('users/{user}/approve', [UserController::class, 'approve'])->name('users.approve');
    Route::post('users/{user}/reject', [UserController::class, 'reject'])->name('users.reject');

    // Surat
    Route::resource('surat', SuratController::class);
    Route::get('surat/print/{surat}', [SuratController::class, 'printSurat'])->name('surat.print');
    Route::get('surat/export/{surat}', [SuratController::class, 'export'])->name('surat.export');

    // Template Surat
    Route::resource('templatesurat', TemplateSuratController::class);
    Route::post('templatesurat/import', [TemplateSuratController::class, 'import'])->name('templatesurat.import');
    Route::get('templatesurat/{templatesurat}/export-pdf', [TemplateSuratController::class, 'exportPdf'])->name('templatesurat.export-pdf');

    // Aparatur
    Route::resource('aparatur', AparaturController::class);

    // Berita
    Route::resource('news', NewsController::class);
    Route::post('news/{news}/publish', [NewsController::class, 'publish'])->name('news.publish');

    // Store & Product
    Route::resource('stores', StoreController::class);
    Route::resource('products', ProductController::class);

    // Village Data
    Route::resource('villagedata', VillageDataController::class);

    // Ref Master
    Route::resource('refmaster', RefMasterController::class);
    Route::get('refmaster/type/{type}', [RefMasterController::class, 'byType'])->name('refmaster.bytype');

    // Roles & Permissions (Spatie)
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
});

require __DIR__.'/auth.php';
