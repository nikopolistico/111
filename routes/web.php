<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MealPlanController;
use App\Http\Controllers\StripePaymentController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['middleware' => ['auth', 'verified']], function () {
    // Store the newly created meal plan
    Route::post('/meal-plans', [MealPlanController::class, 'store'])->name('mealPlans.store');
    Route::get('/mealhome', [MealPlanController::class, 'index'])->name('meal.home');
    Route::get('/mealcreate', [MealPlanController::class, 'mealcreate'])->name('meal.create');
    Route::get('/payment', [StripePaymentController::class, 'payment'])->name('payment');
    Route::post('/payment', [StripePaymentController::class, 'createPayment']);
    Route::post('/stripe/webhook', [StripePaymentController::class, 'handleWebhook']);
});






require __DIR__ . '/auth.php';
