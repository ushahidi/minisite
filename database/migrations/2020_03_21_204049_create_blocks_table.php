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
            /**
             * block's content is a json. This may change once we have a handle on what is needed
             * works pretty well for having a very flexible schema in terms of module field names etc
             * at minimal dev cost, but it's not clear what impact this will have on performance yet
             * If perf starts to get bad we can move away from this.
            **/
            $table->json('content');
            $table->string('description')->nullable();
            $table->string('type');//the type of block, like " header " or " news" 
            $table->string('visibility');//who can see this
            $table->integer('position');
            $table->boolean('enabled');
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
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
