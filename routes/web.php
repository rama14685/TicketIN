<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| PUBLIC ROUTES (Landing & Event - TANPA LOGIN)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\EventController;

/**
 * Landing Page
 */
Route::get('/', function () {
    return view('welcome');
})->name('home');

/**
 * Public Event (untuk semua user & guest)
 */
Route::get('/events', [EventController::class, 'index'])
    ->name('events.index');

Route::get('/events/{event}', [EventController::class, 'show'])
    ->name('events.show');


/*
|--------------------------------------------------------------------------
| AUTHENTICATED USER ROUTES (USER BIASA)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\BeliTiketController;
use App\Http\Controllers\CartController;

Route::middleware('auth')->group(function () {

    // User Dashboard
    Route::get('/dashboard', function () {
        try {
            $events = \App\Models\Event::with(['kategori', 'tikets'])->latest()->take(6)->get();
            return view('dashboard', compact('events'));
        } catch (\Exception $e) {
            // Fallback jika ada error database
            return view('dashboard', ['events' => collect()]);
        }
    })->name('dashboard');

    Route::get('/history', [EventController::class, 'history'])->name('history');

    Route::post('tiket/{tiket}/beli',
        [BeliTiketController::class, 'store']
    )->name('tiket.beli');

    // Cart routes
    Route::post('cart/add/{tiket}', [CartController::class, 'add'])->name('cart.add');
    Route::get('cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('cart/remove/{index}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('cart/clear', [CartController::class, 'clear'])->name('cart.clear');



    /**
     * Profile
     */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');



    /**
     * Profile
     */
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\EventController as AdminEventController;
use App\Http\Controllers\Admin\TiketController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\TransaksiController;

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /**
         * Dashboard Admin
         */
        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        /**
         * Master Data
         */
        Route::resource('kategori', KategoriController::class);
        Route::resource('events', AdminEventController::class);
        Route::resource('transaksi', TransaksiController::class)->only(['index', 'show']);

        /**
         * Tiket per Event (ADMIN)
         */
        Route::get('events/{event}/tiket/create', [TiketController::class, 'create'])
            ->name('events.tiket.create');

        Route::post('events/{event}/tiket', [TiketController::class, 'store'])
            ->name('events.tiket.store');

        /**
         * CRUD Tiket
         */
        Route::get('tiket/{tiket}/edit', [TiketController::class, 'edit'])
            ->name('tiket.edit');

        Route::put('tiket/{tiket}', [TiketController::class, 'update'])
            ->name('tiket.update');

        Route::delete('tiket/{tiket}', [TiketController::class, 'destroy'])
            ->name('tiket.destroy');
    });

require __DIR__ . '/auth.php';
