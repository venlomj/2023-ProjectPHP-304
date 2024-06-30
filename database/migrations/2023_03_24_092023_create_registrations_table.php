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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->unique()->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('payment_method_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('season_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('price_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->dateTime('registration_date');
            $table->dateTime('payment_date')->nullable();
            $table->boolean('payed');
            $table->string('comment')->nullable();
            $table->timestamps();
        });
        DB::table('registrations')->insert(
            [
                [
                    'member_id'=>1 ,
                    'payment_method_id'=>1 ,
                    'season_id'=> 4,
                    'price_id'=>1,
                    'registration_date'=>\Carbon\Carbon::create(2023,1,1,10,20,30),
                    'payment_date'=>\Carbon\Carbon::create(2023,1,2,11,20,30),
                    'payed'=> true,
                    'comment'=>''

                ],
                [
                    'member_id'=>2 ,
                    'payment_method_id'=> 2,
                    'season_id'=>4 ,
                    'price_id'=>1,
                    'registration_date'=>\Carbon\Carbon::create(2023,4,1,10,20,30),
                    'payment_date'=>\Carbon\Carbon::create(2023,4,1,11,20,30),
                    'payed'=> true,
                    'comment'=>''

                ],[
                'member_id'=> 4,
                'payment_method_id'=>2 ,
                'season_id'=>4 ,
                'price_id'=>1,
                'registration_date'=>\Carbon\Carbon::create(2023,4,1,10,20,30),
                'payment_date'=>\Carbon\Carbon::create(2023,4,1,11,20,30),
                'payed'=> true,
                'comment'=>''

            ],[
                'member_id'=> 5,
                'payment_method_id'=> 3,
                'season_id'=> 4,
                'price_id'=>1,
                'registration_date'=>\Carbon\Carbon::create(2023,4,1,10,20,30) ,
                'payment_date'=>\Carbon\Carbon::create(2023,4,1,11,20,30),
                'payed'=> true,
                'comment'=>''

            ],[
                'member_id'=>6 ,
                'payment_method_id'=>1 ,
                'season_id'=> 4,
                'price_id'=>1,
                'registration_date'=>\Carbon\Carbon::create(2023,4,1,10,20,30) ,
                'payment_date'=>\Carbon\Carbon::create(2023,4,1,11,20,30),
                'payed'=> true,
                'comment'=>''

            ],[
                'member_id'=> 7,
                'payment_method_id'=> 1,
                'season_id'=>4 ,
                'price_id'=>1,
                'registration_date'=>\Carbon\Carbon::create(2023,4,1,10,20,30) ,
                'payment_date'=>\Carbon\Carbon::create(2023,4,1,11,20,30),
                'payed'=> true,
                'comment'=>''

            ],[
                'member_id'=>8 ,
                'payment_method_id'=>3 ,
                'season_id'=> 4,
                'price_id'=>1,
                'registration_date'=>\Carbon\Carbon::create(2023,4,1,10,20,30) ,
                'payment_date'=>\Carbon\Carbon::create(2023,4,1,11,20,30),
                'payed'=> true,
                'comment'=>''

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
        Schema::dropIfExists('registrations');
    }
};
