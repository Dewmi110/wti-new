<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Middleware\AdminAuth;

// Route::get('/', function () {
//     return view('frontend.index');
// });

//frontend - routes
Route::controller(FrontendController::class)->group(function () {
	Route::get('/', 'index')->name('frontend.index');
	// Route::get('/about', 'about')->name('frontend.about');
	Route::get('/visit-to-srilanka', 'visit_to_srilanka')->name('frontend.visit_to_srilanka');
	Route::get('/outbound', 'outbound')->name('frontend.outbound');
	Route::get('/tours/{tour}', 'singleTour')->name('frontend.single_tour');
	// Route::get('/blog', 'blog')->name('frontend.blog');
	// Route::get('/contact', 'contact')->name('frontend.contact');
});

// Admin auth routes



Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware(AdminAuth::class)->group(function () {
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

	// Tour management
	Route::resource('tours', \App\Http\Controllers\Admin\TourController::class, ['as' => 'admin']);
	Route::get('tours/feature-icons', [\App\Http\Controllers\Admin\TourController::class, 'featureIcons'])->name('admin.tours.feature-icons');

	// Taxonomy
	Route::resource('tour-categories', \App\Http\Controllers\Admin\TourCategoryController::class, ['as' => 'admin']);
	Route::resource('tour-types', \App\Http\Controllers\Admin\TourTypeController::class, ['as' => 'admin']);
	Route::resource('tour-themes', \App\Http\Controllers\Admin\TourThemeController::class, ['as' => 'admin']);

	// Countries & Destinations
	Route::resource('countries', \App\Http\Controllers\Admin\CountryController::class, ['as' => 'admin']);
	Route::get('countries/{id}/destinations', [\App\Http\Controllers\Admin\CountryController::class, 'destinations'])->name('admin.countries.destinations');
	Route::resource('destinations', \App\Http\Controllers\Admin\DestinationController::class, ['as' => 'admin']);
});
