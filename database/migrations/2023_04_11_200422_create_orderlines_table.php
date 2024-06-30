<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderlines', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('order_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->integer('quantity');
            $table->timestamps();
        });

        DB::table('orderlines')->insert(
            [
                [
                    'order_id' => 1,
                    'product_id'=> 3,
                    'quantity'=>2,
                ],
                [
                    'order_id' => 1,
                    'product_id'=> 2,
                    'quantity'=>2,
                ],
                [
                    'order_id' => 2,
                    'product_id'=> 2,
                    'quantity'=>1,
                ],
                [
                    'order_id' => 3,
                    'product_id'=> 1,
                    'quantity'=>3,
                ],

            ]
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orderlines');
    }
};
