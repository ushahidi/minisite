<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWhereItAppearsAndPhotoToBlockTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('block_types', function (Blueprint $table) {
            $table->string('where_is_placed');
            $table->string('image_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('block_types', function (Blueprint $table) {
            $table->dropColumn('where_is_placed');
            $table->dropColumn('image_url');
        });
    }
}
