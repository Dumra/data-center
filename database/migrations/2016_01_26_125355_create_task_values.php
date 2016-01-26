<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTaskValues extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('task_values', function (Blueprint $table) {
            $table->increments('id');
			$table->float('latitude');
            $table->float('longitude');
            $table->float('height')->nullable();
            $table->enum('direction', ['N', 'E', 'S', 'W', 'NW', 'NE', 'SE', 'SW'])->nullable();
			$table->integer('task_id')->unsigned();
			$table->foreign('task_id')
                ->references('id')
                ->on('tasks')
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
        Schema::drop('task_values');
    }
}
