<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToProjectRenderPipelineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_render_pipeline', function (Blueprint $table) {
            $table
                ->foreign('render_pipeline_id')
                ->references('id')
                ->on('render_pipelines')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('project_id')
                ->references('id')
                ->on('projects')
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
        Schema::table('project_render_pipeline', function (Blueprint $table) {
            $table->dropForeign(['render_pipeline_id']);
            $table->dropForeign(['project_id']);
        });
    }
}
