<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedAccuracyGpsCoordsSensor extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sensors_values', function (Blueprint $table) {
//            $table->double('latitude', 15, 6)->change();
//            $table->double('longitude', 15, 6)->change();
			DB::statement("ALTER TABLE `sensors_values` MODIFY COLUMN `longitude` DOUBLE(15, 6) NOT NULL");
			DB::statement("ALTER TABLE `sensors_values` MODIFY COLUMN `latitude` DOUBLE(15, 6) NOT NULL");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sensor_values', function (Blueprint $table) {
            //
        });
    }
}
