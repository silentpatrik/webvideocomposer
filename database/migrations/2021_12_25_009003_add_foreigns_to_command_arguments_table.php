<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToCommandArgumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('command_arguments', function (Blueprint $table) {
            $table
                ->foreign('command_id')
                ->references('id')
                ->on('commands')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('argument_id')
                ->references('id')
                ->on('arguments')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('command_arguments', function (Blueprint $table) {
            $table->dropForeign(['command_id']);
            $table->dropForeign(['argument_id']);
        });
    }
}
