<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
        public function up(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->json('inclusion_ids')->nullable()->after('price_include');
            $table->json('exclusion_ids')->nullable()->after('inclusion_ids');
            $table->json('cancellation_policy_ids')->nullable()->after('cancellation_policy');
        });
    }

    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn(['inclusion_ids', 'exclusion_ids', 'cancellation_policy_ids']);
        });
    }
};
