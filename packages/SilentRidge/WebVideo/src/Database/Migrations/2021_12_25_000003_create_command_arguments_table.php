<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandArgumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('command_arguments', function (Blueprint $table) {
            $table->unsignedBigInteger('command_id');
            $table->unsignedBigInteger('argument_id');
            $table
                ->boolean('enabled')
                ->default(1)
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('command_arguments');
    }
}
