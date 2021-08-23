<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeoplesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('peoples', function (Blueprint $table) {
            $table->id();
	        $table->string('name', 50);
	        $table->string('position', 100);
	        $table->string('images', 100);
	        $table->text('text');
	        $table->string('twitter', 255);
	        $table->string('facebook', 255);
	        $table->string('vkontakte', 255);
	        $table->string('instagram', 255);
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
        Schema::dropIfExists('peoples');
    }
}
