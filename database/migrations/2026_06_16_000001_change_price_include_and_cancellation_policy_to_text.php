<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            if (Schema::hasColumn('tours', 'price_include')) {
                DB::statement('ALTER TABLE `tours` MODIFY `price_include` TEXT NULL');
            }
            if (Schema::hasColumn('tours', 'cancellation_policy')) {
                DB::statement('ALTER TABLE `tours` MODIFY `cancellation_policy` TEXT NULL');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            if (Schema::hasColumn('tours', 'price_include')) {
                DB::statement('ALTER TABLE `tours` MODIFY `price_include` VARCHAR(255) NULL');
            }
            if (Schema::hasColumn('tours', 'cancellation_policy')) {
                DB::statement('ALTER TABLE `tours` MODIFY `cancellation_policy` VARCHAR(255) NULL');
            }
        });
    }
};
