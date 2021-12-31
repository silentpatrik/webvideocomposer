<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommandRenderPipelineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('command_render_pipeline', function (Blueprint $table) {
            $table->unsignedBigInteger('command_id');
            $table->unsignedBigInteger('render_pipeline_id');
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
        Schema::dropIfExists('command_render_pipeline');
    }
}
