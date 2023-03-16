<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJumbosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jumbos', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index()->nullable();
            $table->string('src')->nullable();
            $table->text('description')->nullable();
            $table->smallInteger('order_number')->default(0);
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
        Schema::dropIfExists('jumbos');
    }
}
