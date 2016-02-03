<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedAccuracyGpsCoords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drones', function (Blueprint $table) {
           // $table->double('latitude', 15, 6)->nullable()->change();
           // $table->double('longitude', 15, 6)->nullable()->change();
			DB::statement("ALTER TABLE `drones` MODIFY COLUMN `latitude` DOUBLE(15, 6) NULL");
			DB::statement("ALTER TABLE `drones` MODIFY COLUMN `longitude` DOUBLE(15, 6) NULL");
			$table->float('height')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('drones', function (Blueprint $table) {			
         
        });
    }
}
