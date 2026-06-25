<?php

namespace App\Http\View\Composers;

use App\Models\TourType;
use Illuminate\View\View;

class SearchComposer
{
    public function compose(View $view): void
    {
        $view->with('types', TourType::where('status', 1)->get());
    }
}