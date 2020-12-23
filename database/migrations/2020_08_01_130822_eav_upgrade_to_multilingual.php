<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class EavUpgradeToMultilingual extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table(config('rinvex.attributes.tables.attribute_varchar_values'), function (Blueprint $table) {
            $table->{database_jsonable()}('content')->change();
        });

        Schema::table(config('rinvex.attributes.tables.attribute_text_values'), function (Blueprint $table) {
            $table->{database_jsonable()}('content')->change();
        });

        Schema::table('attribute_options', function (Blueprint $table) {
            $table->{database_jsonable()}('value')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(config('rinvex.attributes.tables.attribute_varchar_values'), function (Blueprint $table) {
            $table->string('content')->change();
        });

        Schema::table(config('rinvex.attributes.tables.attribute_text_values'), function (Blueprint $table) {
            $table->text('content')->change();
        });

        Schema::table('attribute_options', function (Blueprint $table) {
            $table->string('value')->nullable()->change();
        });
    }
}
