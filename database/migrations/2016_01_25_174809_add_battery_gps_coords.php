<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBatteryGpsCoords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('drones', function (Blueprint $table) {
            $table->float('longitude')->nullable()->after('name');
			$table->float('latitude')->nullable()->after('name'); 
			$table->integer('battery')->nullabe()->after('status');
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
            $table->dropColumn('longitude');
            $table->dropColumn('latitude');
			$table->dropColumn('battery');
        });
    }
}
