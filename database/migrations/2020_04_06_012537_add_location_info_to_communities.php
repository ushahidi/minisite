<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLocationInfoToCommunities extends Migration
{
    /**
     * Run the migrations
     * @return void
     */
    public function up()
    {
        Schema::table('community_locations', function (Blueprint $table) {
            $table->string('display_name');
            $table->renameColumn('neighborhood', 'locality');          
            $table->string('city', 255)->nullable()->change();
            $table->string('state', 255)->nullable()->change();
            $table->string('postal_code')->nullable();
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
        Schema::table('community_locations', function (Blueprint $table) {
            $table->dropColumn('display_name');
            $table->string('city', 255)->change();
            $table->string('state', 255)->change();
            $table->renameColumn('locality', 'neighborhood');    
            $table->dropColumn('postal_code');
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
        });
    }
}
