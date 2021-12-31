<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToCommandRenderPipelineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('command_render_pipeline', function (Blueprint $table) {
            $table
                ->foreign('command_id')
                ->references('id')
                ->on('commands')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('render_pipeline_id')
                ->references('id')
                ->on('render_pipelines')
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
        Schema::table('command_render_pipeline', function (Blueprint $table) {
            $table->dropForeign(['command_id']);
            $table->dropForeign(['render_pipeline_id']);
        });
    }
}
