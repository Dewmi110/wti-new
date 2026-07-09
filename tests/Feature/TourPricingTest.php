<?php

namespace Tests\Feature;

use App\Models\Country;
use App\Models\Destination;
use App\Models\Tour;
use App\Models\TourCategory;
use App\Models\TourTheme;
use App\Models\TourType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TourPricingTest extends TestCase
{
    use RefreshDatabase;

    public function test_tour_can_be_created_with_blank_pricing_values(): void
    {
        $category = TourCategory::factory()->create();
        $type = TourType::factory()->create();
        $theme = TourTheme::factory()->create();
        $country = Country::factory()->create();
        Destination::factory()->create();

        $response = $this->post(route('admin.tours.store'), [
            'title' => 'Test Tour',
            'slug' => 'test-tour',
            't_category' => $category->id,
            't_type' => $type->id,
            't_theme' => $theme->id,
            'description' => 'Great tour',
            'duration' => '3 days',
            'country' => $country->id,
            'destinations' => [],
            'price' => '',
            'discount_price' => '',
            'currency' => 'USD',
            'status' => 1,
        ]);

        $response->assertRedirect(route('admin.tours.index'));
        $this->assertDatabaseHas('tours', [
            'title' => 'Test Tour',
            'price' => 0,
            'discount_price' => null,
        ]);
    }
}
