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
        Schema::create('group_members', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('member_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('season_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });
        DB::table('group_members')->insert(
            [
                [
                    'group_id'=> 1,
                    'member_id'=> 1,
                    'season_id'=>4
                ],
                [
                    'group_id'=> 2,
                    'member_id'=>2 ,
                    'season_id'=>4
                ],
                [
                    'group_id'=>3 ,
                    'member_id'=>4 ,
                    'season_id'=>4
                ],
                [
                    'group_id'=>3 ,
                    'member_id'=> 5,
                    'season_id'=>4
                ],
                [
                    'group_id'=>3 ,
                    'member_id'=>6 ,
                    'season_id'=>4
                ],
                [
                    'group_id'=>1 ,
                    'member_id'=> 7,
                    'season_id'=>4
                ],
                [
                    'group_id'=> 2,
                    'member_id'=>8 ,
                    'season_id'=>4
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
        Schema::dropIfExists('group_members');
    }
};
