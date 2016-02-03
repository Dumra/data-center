<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddedAccuracyGpsCoordsRoute extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('routes', function (Blueprint $table) {
//            $table->double('latitude', 15, 6)->change();
//            $table->double('longitude', 15, 6)->change();
			DB::statement("ALTER TABLE `routes` MODIFY COLUMN `longitude` DOUBLE(15, 6) NOT NULL");
			DB::statement("ALTER TABLE `routes` MODIFY COLUMN `latitude` DOUBLE(15, 6) NOT NULL");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('routes', function (Blueprint $table) {
            //
        });
    }
}
