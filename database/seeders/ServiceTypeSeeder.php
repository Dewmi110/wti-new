<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServiceTypeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('service_types')->insert([
            ['name' => 'Air Tickets','banner_image' => 'air-tickets.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Visa Services', 'banner_image' => 'visa-services.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Visit to Sri Lanka', 'banner_image' => 'visit-srilanka.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Global Tour Holidays', 'banner_image' => 'global-tour-holidays.jpg', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'MICE Tours', 'banner_image' => 'mice-tours.jpg', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}