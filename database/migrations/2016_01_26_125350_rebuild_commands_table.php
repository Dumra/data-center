<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RebuildCommandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
		Schema::rename('log_commands', 'tasks');
        Schema::table('tasks', function (Blueprint $table) { 
			$table->enum('status', ['opened', 'in progress', 'failed', 'closed'])->default('opened');
			$table->dropColumn('longitude');
			$table->dropColumn('latitude');
			$table->dropColumn('height');
			$table->dropColumn('direction');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::rename('tasks', 'log_commands');
        Schema::table('log_commands', function (Blueprint $table) {
			$table->dropColumn('status');
			$table->float('latitude');
            $table->float('longitude');
            $table->float('height')->nullable();
            $table->enum('direction', ['N', 'E', 'S', 'W', 'NW', 'NE', 'SE', 'SW'])->nullable();
        });
    }
}
