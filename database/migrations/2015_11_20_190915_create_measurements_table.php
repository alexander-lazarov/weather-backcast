<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeasurementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('measurements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('spot_id')->index();
            $table->decimal('wind_speed', 3, 1);
            $table->decimal('wind_gust_speed', 3, 1);
            $table->decimal('wind_direction', 3, 0);
            $table->decimal('temperature', 3, 1);
            $table->decimal('pressure', 5, 1);
            $table->dateTime('created_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('measurements');
    }
}
