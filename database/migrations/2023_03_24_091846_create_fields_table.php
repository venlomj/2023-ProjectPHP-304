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
        Schema::create('fields', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('street');
            $table->string('house_number');
            $table->string('city');
            $table->string('postal_code');
            $table->boolean('active');
            $table->timestamps();
        });

        DB::table('fields')->insert(
            [
                [
                    'name' => 'den uyt',
                    'street' => 'martelaren straat',
                    'house_number' => '44',
                    'city' => 'Mol',
                    'postal_code' => '2400',
                    'active' => true
                ],
                [
                    'name' => 'shell GO',
                    'street' => 'kalekaker straat',
                    'house_number' => '22',
                    'city' => 'Gent',
                    'postal_code' => '9000',
                    'active' => true
                ],
                [
                    'name' => 'kolka',
                    'street' => 'folie straat',
                    'house_number' => '69',
                    'city' => 'Geel',
                    'postal_code' => '2440',
                    'active' => false
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
        Schema::dropIfExists('fields');
    }
};
