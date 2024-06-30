<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        Schema::create('expenses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->restrictOnUpdate()->restrictOnDelete();//->unique()
            $table->string('name')->unique();
            $table->float('price');
            $table->string('comment')->nullable();
            $table->boolean('approved')->nullable();
            $table->string('rejection')->nullable();
            $table->date('input_date')->nullable();
            $table->string('picture')->nullable();
            $table->date('payment_date')->nullable();
            $table->timestamps();
        });

        DB::table('expenses')->insert(
            [
                [
                    'user_id' =>1,
                    'name' => 'Goal U14',
                    'price' => '15.5',
                    'comment' => 'kleine goal',
                    'approved' => True,
                    'rejection' => '',
                    'input_date' =>\Carbon\Carbon::create(2023,5,20),
                    'picture' => 'goal.jpg',
                    'payment_date' => \Carbon\Carbon::create(2023,5,25),
                ],
                [
                    'user_id' =>2,
                    'name' => 'Potjes',
                    'price' => '7.5',
                    'comment' => 'kegeltjes in verschillende kleuren',
                    'approved' => false,
                    'rejection' => 'slechte kwaliteit potjes',
                    'input_date' => \Carbon\Carbon::create(2023,5,26),
                    'picture' => 'potjes.jpg',
                    'payment_date' => \Carbon\Carbon::create(2023,5,30),
                ],
                [
                    'user_id' =>3,
                    'name' => 'dummy mannetjes',
                    'price' => '25',
                    'comment' => 'Grote mannetjes om op het veld als verdediger te gebruiken',
                    'approved' => True,
                    'rejection' => '',
                    'input_date' => \Carbon\Carbon::create(2023,6,5),
                    'picture' => 'dummies.jpg',
                    'payment_date' => \Carbon\Carbon::create(2023,6,15),
                ],
                [
                    'user_id' =>4,
                    'name' => 'Trainer onkosten',
                    'price' => '50',
                    'comment' => 'De trainer maakt onkosten',
                    'approved' => True,
                    'rejection' => '',
                    'input_date' => \Carbon\Carbon::create(2023,6,5),
                    'picture' => 'dummies.jpg',
                    'payment_date' => \Carbon\Carbon::create(2023,6,15),
                ],
                [
                    'user_id' =>5,
                    'name' => 'Gebruiker onkosten',
                    'price' => '15',
                    'comment' => 'De gebruiker maakt onkosten',
                    'approved' => True,
                    'rejection' => '',
                    'input_date' => \Carbon\Carbon::create(2023,6,5),
                    'picture' => 'dummies.jpg',
                    'payment_date' => \Carbon\Carbon::create(2023,6,15),
                ],
                [
                    'user_id' =>6,
                    'name' => 'Gebruiker 2 onkosten',
                    'price' => '30',
                    'comment' => 'De tweede gebruiker maakt onkosten',
                    'approved' => True,
                    'rejection' => '',
                    'input_date' => \Carbon\Carbon::create(2023,6,5),
                    'picture' => 'dummies.jpg',
                    'payment_date' => \Carbon\Carbon::create(2023,6,15),
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
        Schema::dropIfExists('expenses');
    }
};
