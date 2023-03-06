<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePersonalizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personalizes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable();
            $table->string('receipt_email')->index();
            $table->string('sender_email')->index();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('business_name');
            $table->string('address');
            $table->string('phone');
            $table->double('length');
            $table->double('width');
            $table->double('height');
            $table->integer('quantity');
            $table->enum('color', ['warm', 'white']);
            $table->enum('cardboard_type', ['box1', 'box2']);
            $table->enum('press_type', ['neutral', 'press1', 'press2']);
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
        Schema::dropIfExists('personalizes');
    }
}
