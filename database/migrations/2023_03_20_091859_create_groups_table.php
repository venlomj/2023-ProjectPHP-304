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
        Schema::create('groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('min_age')->unique();
            $table->integer('max_age');
            $table->boolean('active');
            $table->timestamps();
        });
        DB::table('groups')->insert(
            [
                [
                    'name' => 'jolly worm',
                    'min_age' => 8,
                    'max_age' => 10,
                    'active' => true
                ],
                [
                    'name' => 'ground hog',
                    'min_age' => 11,
                    'max_age' => 13,
                    'active' => true
                ],
                [
                    'name' => 'strong gents',
                    'min_age' => 14,
                    'max_age' => 16,
                    'active' => true
                ],
                [
                    'name' => 'broken car',
                    'min_age' => 9,
                    'max_age' => 11,
                    'active' => false
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
        Schema::dropIfExists('groups');
    }
};
