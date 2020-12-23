<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertAttributeOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_options', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('attribute_id')->nullable();
            $table->string('value')->nullable();
            $table->boolean('is_default')->default(false);
            $table->boolean('show_frontend')->default(true);
            $table->unsignedMediumInteger('sort_order')->nullable();
            $table->timestamps();

            $attributeTable = config('rinvex.attributes.tables.attributes');
            $table->foreign('attribute_id')->references('id')->on($attributeTable)->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_options');
    }
}
