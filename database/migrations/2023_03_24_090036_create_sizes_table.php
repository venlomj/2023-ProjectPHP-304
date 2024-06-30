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
        Schema::create('sizes', function (Blueprint $table) {
            $table->id();
            $table->string('size')->unique();
            $table->timestamps();
        });
        DB::table('sizes')->insert(
            [
                [
                    'size'=>'small',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'size'=>'medium',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'size'=>'large',
                    'created_at' => now(),
                    'updated_at' => now()
                ],
                [
                    'size'=>'extra large',
                    'created_at' => now(),
                    'updated_at' => now()
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
        Schema::dropIfExists('sizes');
    }
};
