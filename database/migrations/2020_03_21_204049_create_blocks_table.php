<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blocks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('minisite_id')->unsigned()->nullable();
            $table->foreign('minisite_id')->references('id')->on('minisites')->onDelete('cascade');
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('type');//the type of block, like " header " or " news" 
            $table->string('visibility');//who can see this
            $table->string('position');
            $table->boolean('enabled');
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
        Schema::dropIfExists('blocks');
    }
}
