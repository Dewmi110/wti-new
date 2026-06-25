<?php

use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\CorporateController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\DestinationController;
use App\Http\Controllers\Admin\ImageSliderController;
use App\Http\Controllers\Admin\TourCategoryController;
use App\Http\Controllers\Admin\TourController;
use App\Http\Controllers\Admin\TourThemeController;
use App\Http\Controllers\Admin\TourTypeController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\BlogBannerController;
use App\Http\Controllers\Admin\BlogSliderController;
use App\Http\Controllers\Admin\ContactBannerController;
use App\Http\Controllers\Admin\ServiceBannerController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Middleware\AdminAuth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


//Frontend routes
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('frontend.index');
    Route::get('/visit-to-srilanka', 'visit_to_srilanka')->name('frontend.visit_to_srilanka');
    Route::get('/outbound', 'outbound')->name('frontend.outbound');
    Route::get('/tours/{tour:slug}', 'singleTour')->name('frontend.single_tour');
    Route::get('/blog', 'blog')->name('frontend.blog');
    Route::get('/single-blog/{blog}', 'singleBlog')->name('single.blog');
    Route::post('/send-inquiry', 'sendInquiry')->name('send.inquiry');
    Route::get('/air-tickets', 'airTickets')->name('frontend.air_tickets');
    Route::get('/visa-services', 'visaServices')->name('frontend.visa_services');
    Route::get('/mice-tours', 'miceTours')->name('frontend.mice_tours');
    Route::get('/corporate', 'corporate')->name('frontend.corporate');
    Route::post('/booking', 'storeBooking')->name('frontend.booking.store');
    Route::get('/contact', 'contact')->name('frontend.contact');
});

//  Authentication
    Route::controller(AuthController::class)->group(function () {
        Route::get('/login', 'showLogin')->name('admin.login');
        Route::post('/login', 'login')->name('admin.login.post');
        Route::post('/logout', 'logout')->name('admin.logout');
    });

//  Admin Routes
    Route::prefix('admin')
        ->name('admin.')
        ->middleware(AdminAuth::class)
        ->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index']) ->name('dashboard');

// Resource Controllers
        Route::resources([
            'tours'            => TourController::class,
            'tour-categories'  => TourCategoryController::class,
            'tour-types'       => TourTypeController::class,
            'tour-themes'      => TourThemeController::class,
            'countries'        => CountryController::class,
            'destinations'     => DestinationController::class,
            'blogs'            => BlogController::class,
            'users'            => UserController::class,
            'services'         => ServiceController::class,
        ]);

//Tour Custom Routes
        Route::get('tours/feature-icons', [TourController::class, 'featureIcons'])->name('tours.feature-icons');

//Service Custom Routes
        Route::resource('services', ServiceController::class)->names('services');
//Country Custom Routes
        Route::get('countries/{id}/destinations',[CountryController::class, 'destinations'])->name('countries.destinations');

//Blog Custom Routes
        Route::get('blogs/{id}/image',[BlogController::class, 'image'])->name('blogs.image');
        Route::post('blogs/{id}/image',[BlogController::class, 'uploadImage'])->name('blogs.upload_image');

//Image Sliders
        Route::prefix('image-sliders')->name('image_sliders.')->controller(ImageSliderController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create-home', 'createHomeSlider')->name('create_home');
            Route::get('/{imageSlider}/edit-home', 'editHomeSlider')->name('edit_home');
            Route::post('/', 'store')->name('store');
            Route::put('/{imageSlider}', 'update')->name('update');
            Route::delete('/{imageSlider}', 'destroy')->name('destroy');
        });

//Blog Sliders
        Route::prefix('blog-sliders')->name('blog_sliders.')->controller(BlogSliderController::class)->group(function () {
            Route::get('/', 'index')->name('index');
            Route::get('/create-home', 'create')->name('create');
            Route::get('/{blogSlider}/edit-home', 'edit')->name('edit');
            Route::post('/', 'store')->name('store');
            Route::put('/{blogSlider}', 'update')->name('update');
            Route::delete('/{blogSlider}', 'destroy')->name('destroy');
        });

//Banner Modules
        Route::resource('corporate-banners', CorporateController::class )->except('show')->names('corporate_banners');
        Route::resource( 'blog-banners',BlogBannerController::class)->except('show')->names('blog_banners');
        Route::resource('contact-banners', ContactBannerController::class)->except('show')->names('contact_banners');
        Route::resource('service-banners', ServiceBannerController::class)->except('show')->names('service_banners');
//Tour Banners
        Route::prefix('tour-banners')->name('tour_banners.') ->controller(TourTypeController::class)->group(function () {
            Route::get('/', 'indexBanner')->name('index');
            Route::get('/create', 'createBanner')->name('create');
            Route::post('/', 'storeBanner')->name('store');
        });
//Booking Routes
        Route::get('bookings/{booking}', [BookingController::class, 'show'])->name('bookings.show');
        Route::patch('bookings/{booking}/status', [BookingController::class, 'updateStatus'])->name('bookings.updateStatus');
        Route::delete('bookings/{booking}', [BookingController::class, 'destroy'])->name('bookings.destroy');
        Route::resource('bookings', BookingController::class)->only(['index']);
    });

