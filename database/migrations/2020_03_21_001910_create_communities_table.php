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
        Schema::create('community_locations', function (Blueprint $table) {      
            $table->id();
            $table->string('neighborhood')->nullable();
            $table->string('location_source')->default('manual_entry');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->json('location_info')->nullable();//generic "all other stuff" 
            $table->softDeletes('deleted_at', 0);
        });

        Schema::create('communities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('welcome');
            $table->string('description');
            $table->string('visibility');//who can see this
            $table->string('type')->default('neighborhood');//neighborhood, city, state, country, deployer
            $table->bigInteger('location_id')->unsigned()->nullable();
            $table->bigInteger('deployment_id')->nullable();//future music
            $table->foreign('location_id')->references('id')->on('community_locations')->onDelete('SET NULL');
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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Schema::dropIfExists('community_locations');
        Schema::dropIfExists('communities');
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

    }
}
