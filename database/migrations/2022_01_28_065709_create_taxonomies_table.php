<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxonomiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxonomies', function (Blueprint $table) {
            $table->id();
            $table->string('group');
            $table->string('type');
            $table->integer('position');
            $table->string('code');
            $table->string('name');
            $table->string('short_name');
            $table->string('icon')->nullable();
            $table->string('slug');
            $table->tinyInteger('active');
            $table->string('description')->nullable();
            $table->foreignId('parent_taxonomy_id')->nullable()->constrained('taxonomies');
            $table->softDeletes();
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
        Schema::dropIfExists('taxonomies');
    }
}
