<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('route_stops', function (Blueprint $table) {
            $table->id();
            $table->string('place_name');            // contoh: Depan Kampus UNRI
            $table->string('address')->nullable();
            $table->unsignedTinyInteger('day');      // 1=Senin ... 7=Minggu
            $table->time('start_time');
            $table->time('end_time');
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('route_stops');
    }
};
