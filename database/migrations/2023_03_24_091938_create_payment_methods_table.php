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
        Schema::create('payment_methods', function (Blueprint $table) {
            $table->id();
            $table->string('method')->unique();
            $table->boolean('active');
            $table->timestamps();
        });

        DB::table('payment_methods')-> insert(
            [
                [
                    "method" => 'payconiq',
                    'active' => true
                ],
                [
                    "method" => 'overschrijving',
                    'active' => true
                ],
                [
                    "method" => 'cash',
                    'active' => true
                ]
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
        Schema::dropIfExists('payment_methods');
    }
};
