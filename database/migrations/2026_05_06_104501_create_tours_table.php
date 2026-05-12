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
        Schema::create('tours', function (Blueprint $table) {
            $table->id();
            $table->foreignId('t_category')->constrained('tour_categories');
            $table->foreignId('t_type')->constrained('tour_types');
            $table->foreignId('t_theme')->constrained('tour_themes');
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->string('duration');
            $table->foreignId('country')->constrained('countries');
            $table->json('destinations')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->text('highlight_activities')->nullable();
            $table->string('banner_img_path')->nullable();
            $table->tinyInteger('visibility')->default(1)->comment('0=featured,1=home');
            $table->tinyInteger('status')->default(0)->comment('0=inactive,1=active,2=deleted');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tours');
    }
};
