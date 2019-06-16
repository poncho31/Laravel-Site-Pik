<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();

            $table->integer('section_id')->unsigned();
            $table->foreign('section_id')
                  ->references('id')
                  ->on('sections')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->integer('project_id')->unsigned();
            $table->foreign('project_id')
                  ->references('id')
                  ->on('projects')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->integer('category_id')->nullable()->unsigned();
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('restrict')
                  ->onUpdate('restrict');
                  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
		Schema::table('images', function(Blueprint $table) {
			$table->dropForeign('images_category_id_foreign');
			$table->dropForeign('images_user_id_foreign');
		});
        Schema::dropIfExists('images');
    }
}
