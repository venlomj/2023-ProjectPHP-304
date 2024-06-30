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
        Schema::create('member_users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });

        DB::table('member_users')->insert(
            [
                [
                    'member_id'=>1 ,
                    'user_id'=>1
                ],
                [
                    'member_id'=>2,
                    'user_id'=> 2
                ],
                [
                    'member_id'=>3 ,
                    'user_id'=> 3
                ],
                [
                    'member_id'=>4 ,
                    'user_id'=>1
                ],
                [
                    'member_id'=> 5,
                    'user_id'=> 4
                ],
                [
                    'member_id'=>6,
                    'user_id'=>5
                ],
                [
                    'member_id'=>7 ,
                    'user_id'=> 5
                ],
                [
                    'member_id'=>8 ,
                    'user_id'=> 6
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
        Schema::dropIfExists('member_users');
    }
};
