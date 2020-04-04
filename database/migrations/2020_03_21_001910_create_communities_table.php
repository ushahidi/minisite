<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommunitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('community_location', function (Blueprint $table) {      
            $table->id();
            $table->string('neighborhood')->nullable();
            $table->string('location_source')->default('manual_entry');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->json('location_info')->nullable();//generic "all other stuff" 
        });
        Schema::create('communities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type')->default('neighborhood');//neighborhood, city, state, country, deployer
            $table->bigInteger('location_id')->unsigned()->nullable();
            $table->bigInteger('deployment_id')->nullable();//future music
            $table->foreign('location_id')->references('id')->on('community_location')->onDelete('SET NULL');
            $table->softDeletes('deleted_at', 0);
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
        Schema::dropIfExists('community_location');
        Schema::dropIfExists('communities');
    }
}
