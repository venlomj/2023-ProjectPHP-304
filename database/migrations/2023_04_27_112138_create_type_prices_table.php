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
        Schema::create('type_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('price_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('type_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('type_prices')->insert(
            [
                [
                    'price_id'=>1,
                    'type_id'=>1,
                ],
                [
                    'price_id'=>1,
                    'type_id'=>1,
                ],
                [
                    'price_id'=>1,
                    'type_id'=>1,
                ],
                [
                    'price_id'=>1,
                    'type_id'=>1,
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
        Schema::dropIfExists('type_prices');
    }
};
