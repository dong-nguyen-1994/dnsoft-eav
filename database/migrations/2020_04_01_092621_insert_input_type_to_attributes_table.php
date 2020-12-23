<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InsertInputTypeToAttributesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tableName = config('rinvex.attributes.tables.attributes');
        Schema::table($tableName, function (Blueprint $table) {
            $table->string('input_type')->nullable()->after('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tableName = config('rinvex.attributes.tables.attributes');
        Schema::table($tableName, function (Blueprint $table) {
            $table->dropColumn('input_type');
        });
    }
}
