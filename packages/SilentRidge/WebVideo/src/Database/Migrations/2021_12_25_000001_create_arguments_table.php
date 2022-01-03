<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArgumentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('arguments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('value');
            $table->text('description');
            $table->unsignedBigInteger('command_id');
            $table
                ->boolean('enabled')
                ->default(1)
                ->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('arguments');
    }
}
