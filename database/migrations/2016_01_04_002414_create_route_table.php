<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRouteTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('routes', function (Blueprint $table) {
            $table->increments('id');
            $table->float('latitude');
            $table->float('longitude');
            $table->float('height')->nullable();
            $table->enum('direction', ['N', 'E', 'S', 'W', 'NW', 'NE', 'SE', 'SW'])->nullable();
            $table->integer('battery');
			$table->timestamp('added');
            $table->integer('drone_id')->unsigned();
            $table->foreign('drone_id')
                ->references('id')
                ->on('drones')
                ->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('routes');
    }
}
