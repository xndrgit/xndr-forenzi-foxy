<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSalePricesToProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('mini_description');
            $table->decimal('price_saled', 8, 2)->nullable();
            $table->decimal('weight', 8, 2);
            $table->decimal('first_price', 8, 2);
            $table->decimal('second_price', 8, 2);
            $table->decimal('third_price', 8, 2);
            $table->decimal('fourth_price', 8, 2);
            $table->integer('purchasable_in_multi_of');

            // $table->unsignedBigInteger('category_id');
            // $table->foreign('category_id')->references('id')->on('categories');

            // $table->unsignedBigInteger('subcategory_id');
            // $table->foreign('subcategory_id')->references('id')->on('subcategories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('mini_description');
            $table->dropColumn('price_saled');
            $table->dropColumn('weight');
            $table->dropColumn('first_price');
            $table->dropColumn('second_price');
            $table->dropColumn('third_price');
            $table->dropColumn('fourth_price');
            $table->dropColumn('purchasable_in_multi_of');

            // $table->dropForeign('products_category_id_foreign');
            // $table->dropColumn('category_id');
            // $table->dropForeign('products_subcategory_id_foreign');
            // $table->dropColumn('subcategory_id');
        });
    }
}
