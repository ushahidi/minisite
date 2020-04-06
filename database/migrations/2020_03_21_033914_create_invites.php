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
            $table->bigInteger('community_id')->unsigned()->nullable();
            $table->foreign('community_id')->references('id')->on('communities')->onDelete('cascade');
            $table->bigInteger('generated_by')->unsigned()->nullable();
            $table->foreign('generated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamp('claimed')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('invites');
    }
}
