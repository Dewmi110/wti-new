<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Http\View\Composers\SearchComposer;
use App\Models\TourCategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Blade::anonymousComponentPath(resource_path('views/backend/components'));
        View::composer('frontend.components.search', SearchComposer::class);
        View::composer('frontend.components.filter_bar', function ($view) {
        $view->with('categories', TourCategory::orderBy('category_name')->get());
    });
    }
}
