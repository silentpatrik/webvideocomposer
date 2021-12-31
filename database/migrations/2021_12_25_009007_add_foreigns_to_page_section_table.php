<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignsToPageSectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('page_section', function (Blueprint $table) {
            $table
                ->foreign('section_id')
                ->references('id')
                ->on('sections')
                ->onUpdate('CASCADE')
                ->onDelete('CASCADE');

            $table
                ->foreign('page_id')
                ->references('id')
                ->on('pages')
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
        Schema::table('page_section', function (Blueprint $table) {
            $table->dropForeign(['section_id']);
            $table->dropForeign(['page_id']);
        });
    }
}
