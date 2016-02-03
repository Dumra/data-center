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
            $table->double('latitude', 15, 6)->nullable()->change();
            $table->double('longitude', 15, 6)->nullable()->change();
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
