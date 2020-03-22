<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlockTypeFieldsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
    */
    public function up()
    {
        Schema::create('block_type_fields', function (Blueprint $table) {
            $table->id();
            $table->string('block_type');
            $table->foreign('block_type')->references('id')->on('block_types')->onDelete('cascade');
            $table->string('name'); //ie: 'description', 'url'
            $table->string('validator'); //the name of a validator, or a validation rule string
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
        Schema::dropIfExists('block_type_fields');
    }
}
