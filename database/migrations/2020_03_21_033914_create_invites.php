<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvites extends Migration
{
    
    public function up()
    {
        Schema::create('invites', function (Blueprint $table) {
            $table->uuid('token');
            $table->bigInteger('neighborhood_id')->unsigned()->nullable();
            $table->foreign('neighborhood_id')->references('id')->on('neighborhoods')->onDelete('cascade');
            $table->bigInteger('generated_by')->unsigned()->nullable();
            $table->foreign('generated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('claimed')->nullable();
            $table->timestamps();
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('invites');
    }
}
