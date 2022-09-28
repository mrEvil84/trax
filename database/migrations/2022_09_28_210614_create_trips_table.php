<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTripsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('trips', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('car_id', false, true);
            $table->foreign('car_id')->references('id')->on('cars');

            $table->integer('user_id', false, true);
            $table->foreign('user_id')->references('id')->on('users');

            $table->float('miles');
            $table->float('total');

            $table->timestamp('date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
}
