<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCoordinatesToValuesSensorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sensors_values', function (Blueprint $table) {
			$table->float('longitude')->after('id');
			$table->float('latitude')->after('id');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sensors_values', function (Blueprint $table) {
            //
        });
    }
}
