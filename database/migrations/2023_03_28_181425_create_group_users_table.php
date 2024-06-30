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
        Schema::create('group_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('group_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('season_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });

        DB::table('group_users')->insert(
            [
                [
                    'user_id'=> 1,
                    'group_id'=>2,
                    'season_id'=>4

                ],
                [
                    'user_id'=> 2,
                    'group_id'=>1,
                    'season_id'=>4

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
        Schema::dropIfExists('group_users');
    }
};
