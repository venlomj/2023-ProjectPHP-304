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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->date('date_from')->unique();
            $table->float('price');
            $table->timestamps();
        });

        DB::table('prices')->insert(
            [
                [
                    'date_from'=>\Carbon\Carbon::create(2023,1,1),
                    'price'=>15.5
                ],
                [
                    'date_from'=>\Carbon\Carbon::create(2023,2,1),
                    'price'=>25.5
                ],
                [
                    'date_from'=>\Carbon\Carbon::create(2023,3,1),
                    'price'=>20.5
                ],
                [
                    'date_from'=>\Carbon\Carbon::create(2023,4,1),
                    'price'=>10.5
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
        Schema::dropIfExists('prices');
    }
};
