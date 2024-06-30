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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('order_period_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('payment_method_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->dateTime('order_date');
            $table->dateTime('payment_date')->nullable();
            $table->timestamps();
        });
        DB::table('orders')->insert(
            [
                [
                    'user_id'=>1,
                    'order_period_id'=>3,
                    'payment_method_id'=>1,
                    'order_date'=>\Carbon\Carbon::create(2022,3,12,10,20,30),
                    'payment_date'=>\Carbon\Carbon::create(2022,4,1,11,20,30)
                ],
                [
                    'user_id'=>3,
                    'order_period_id'=>4,
                    'payment_method_id'=>2,
                    'order_date'=>\Carbon\Carbon::create(2023,3,23,10,20,30),
                    'payment_date'=>\Carbon\Carbon::create(2023,3,28,11,20,30)
                ],
                [
                    'user_id'=>2,
                    'order_period_id'=>2,
                    'payment_method_id'=>3,
                    'order_date'=>\Carbon\Carbon::create(2023,1,31,10,20,30),
                    'payment_date'=>\Carbon\Carbon::create(2023,2,2,11,20,30)
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
        Schema::dropIfExists('orders');
    }
};
