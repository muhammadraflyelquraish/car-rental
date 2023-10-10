<?php

use App\Http\Controllers\{
    AuthController,
    DashboardController,
    CustomerController,
    RegisteredUserController,
    BrandController,
    UserController,
    CarController,
    CheckoutController,
    LandingController,
    OrderController
};
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [LandingController::class, 'home'])->name('home');
Route::get('/about-us', [LandingController::class, 'aboutUs'])->name('about');
Route::get('/list-cars', [LandingController::class, 'listCars'])->name('cars');
Route::get('/car-detail/{carId}', [LandingController::class, 'carDetail'])->name('car-detail')->middleware('auth');
Route::get('/contact-us', [LandingController::class, 'contactUs'])->name('contact');
Route::get('get-image', [LandingController::class, 'getImage'])->name('get-image');

Route::any('/checkout/callback', [CheckoutController::class, 'callback']);
Route::get('/checkout/cancel', [CheckoutController::class, 'cancel'])->name('checkout.cancel')->middleware('auth');
Route::resource('/checkout', CheckoutController::class)->middleware('auth');

Route::get('/update-document', [RegisteredUserController::class, 'updateDocument'])->name('update.document')->middleware('auth');
Route::resource('/auth', AuthController::class);
Route::resource('/register', RegisteredUserController::class);

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('/brand', BrandController::class);
    Route::resource('/customer', CustomerController::class);
    Route::resource('/order', OrderController::class);
    Route::resource('/user', UserController::class);
    Route::get('/car/data', [CarController::class, 'data'])->name('car.data');
    Route::resource('/car', CarController::class);
});

require __DIR__ . '/auth.php';
