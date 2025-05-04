<?php

use App\Models\User;
use App\Models\Testimonial;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\BatchController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TrainerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TestimonialController;

// Route::get('/', function () {
//     $data['testimonials'] = Testimonial::get();
//     $data['trainers'] = User::with(['category'])->where('type', 'trainer')->get();
//     return view('welcome', $data);
// });

Route::get('/', [SiteController::class, 'welcome'])->name('welcome');
Route::post('registration-message', [SiteController::class, 'registrationMessage'])->name('registration.message');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    Route::prefix('dashboard')
    ->name('dashboard.')
    ->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('courses', CourseController::class);
        Route::resource('trainers', TrainerController::class);
        Route::resource('testimonials', TestimonialController::class);
        Route::resource('batches', BatchController::class);
        Route::get('messages', [BatchController::class, 'messages'])->name('messages');
    });



});

require __DIR__.'/auth.php';
