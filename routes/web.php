<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\TourCategoryController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\TourThemeController;
use App\Http\Controllers\Admin\TourTypeController;
use App\Http\Controllers\Admin\ImageSliderController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('frontend.index');
// });

// frontend - routes
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('frontend.index');
    // Route::get('/about', 'about')->name('frontend.about');
    Route::get('/visit-to-srilanka', 'visit_to_srilanka')->name('frontend.visit_to_srilanka');
    Route::get('/outbound', 'outbound')->name('frontend.outbound');
    Route::get('/tours/{tour}', 'singleTour')->name('frontend.single_tour');
    Route::get('/blog', 'blog')->name('frontend.blog');
    Route::get('/single-blog/{blog}', 'singleBlog')->name('frontend.blog-single');
    Route::get('/contact', 'contact')->name('frontend.contact');
    Route::post('/send-inquiry', 'sendInquiry')->name('send.inquiry');
    Route::get('/air-tickets', 'airTickets')->name('frontend.air_tickets');
    Route::get('/visa-services', 'visaServices')->name('frontend.visa_services');
    Route::get('/mice-tours', 'miceTours')->name('frontend.mice_tours');
    Route::get('/corporate', 'corporate')->name('frontend.corporate');
});

// Admin auth routes

Route::get('/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/login', [AuthController::class, 'login'])->name('admin.login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('admin.logout');

Route::prefix('admin')->middleware(AdminAuth::class)->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');

    // Tour management
    Route::resource('tours', TourController::class, ['as' => 'admin']);
    Route::get('tours/feature-icons', [TourController::class, 'featureIcons'])->name('admin.tours.feature-icons');

    // Tour category
    Route::resource('tour-categories', TourCategoryController::class, ['as' => 'admin']);
    Route::resource('tour-types', TourTypeController::class, ['as' => 'admin']);
    Route::resource('tour-themes', TourThemeController::class, ['as' => 'admin']);

    // Countries & Destinations
    Route::resource('countries', CountryController::class, ['as' => 'admin']);
    Route::get('countries/{id}/destinations', [CountryController::class, 'destinations'])->name('admin.countries.destinations');
    Route::resource('destinations', DestinationController::class, ['as' => 'admin']);

    // Blogs
    Route::resource('blogs', BlogController::class, ['as' => 'admin']);
    Route::get('blogs/{id}/image', [BlogController::class, 'image'])->name('admin.blogs.image');
    Route::post('blogs/{id}/image', [BlogController::class, 'uploadImage'])->name('admin.blogs.upload_image');

    // User management
    Route::resource('users', UserController::class, ['as' => 'admin']);

    // Image Slider
    Route::get('image-sliders/create-home', [ImageSliderController::class, 'createHomeSlider'])->name('admin.image_sliders.create_home');
    Route::get('image-sliders/{imageSlider}/edit-home', [ImageSliderController::class, 'editHomeSlider'])->name('admin.image_sliders.edit_home');
    Route::resource('image-sliders', ImageSliderController::class, ['as' => 'admin']);
});
