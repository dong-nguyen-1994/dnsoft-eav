<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributeTextValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_text_values', function (Blueprint $table) {
            $table->id();
            $table->text('content');
            $table->unsignedBigInteger('attribute_id');
            $table->integer('entity_id')->unsigned();
            $table->string('entity_type');
            $table->timestamps();

            // Indexes
            $table->foreign('attribute_id')->references('id')->on('attributes')
                ->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_text_values');
    }
}
