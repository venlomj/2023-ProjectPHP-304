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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->foreignId('gender_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->string('phone_number')->nullable();
            //$table->foreignId('user_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->string('street');
            $table->string('house_number');
            $table->string('city');
            $table->string('postal_code');
            $table->string('national_insurance_number')->nullable();
            $table->date('date_of_birth');
            $table->string('email')->unique();
            $table->string('comment')->nullable();
            $table->boolean('active');
            $table->timestamps();
        });

        DB::table('members')->insert([
            [
                'first_name' => 'Jos',
                'last_name' => 'van Engelen',
                'gender_id' => 1,
                'phone_number' => '0499123456',
                'street' => 'koekeloere straat',
                'house_number' => '34',
                'city' => 'Mol',
                'postal_code' => '2400',
                'national_insurance_number' => '32547621548',
                'date_of_birth' => \Carbon\Carbon::create(2013, 10, 22),
                'email' => 'jos@gmail.com',
                'comment' => '',
                'active' => true
            ],
            [
                'first_name' => 'Alisha',
                'last_name' => 'Poster',
                'gender_id' => 2,
                'phone_number' => '0476123456',
                'street' => 'koekeloere straat',
                'house_number' => '44',
                'city' => 'Mol',
                'postal_code' => '2400',
                'national_insurance_number' => '51368495154',
                'date_of_birth' => \Carbon\Carbon::create(2013, 5, 2),
                'email' => 'alisha.poster@gmail.com',
                'comment' => 'wilt liefst met anna in een team zitten',
                'active' => true
            ],
            [
                'first_name' => 'Jelle',
                'last_name' => 'Wijer',
                'gender_id' => 1,
                'phone_number' => '0475123456',
                'street' => 'bresserdijk',
                'house_number' => '3',
                'city' => 'Mol',
                'postal_code' => '2400',
                'national_insurance_number' => '45671589201',
                'date_of_birth' => \Carbon\Carbon::create(2009, 8, 9),
                'email' => 'Jelle@gmail.com',
                'comment' => 'wilt eigen gerief gebruiken',
                'active' => false
            ],
            [
                'first_name' => 'Jan',
                'last_name' => 'van Engelen',
                'gender_id' => 1,
                'phone_number' => '0473123456',
                'street' => 'koekeloere straat',
                'house_number' => '34',
                'city' => 'Mol',
                'postal_code' => '2400',
                'national_insurance_number' => '84651237894',
                'date_of_birth' => \Carbon\Carbon::create(2011, 12, 5),
                'email' => 'jan@gmail.com',
                'comment' => '',
                'active' => true
            ],
            [
                'first_name' => 'Anna',
                'last_name' => 'de Roest',
                'gender_id' => 2,
                'phone_number' => '0474123456',
                'street' => 'kerkof straat',
                'house_number' => '4',
                'city' => 'geel',
                'postal_code' => '2440',
                'national_insurance_number' => '68497515246',
                'date_of_birth' => \Carbon\Carbon::create(2014, 8, 13),
                'email' => 'Anna@gmail.com',
                'comment' => '',
                'active' => true
            ],
            [
                'first_name' => 'verdinand',
                'last_name' => 'Bekers',
                'gender_id' => 1,
                'phone_number' => '0485123456',
                'street' => 'lenerdijk',
                'house_number' => '22',
                'city' => 'Mol',
                'postal_code' => '2400',
                'national_insurance_number' => '48975652412',
                'date_of_birth' => \Carbon\Carbon::create(2007, 7, 10),
                'email' => 'verdinand@gmail.com',
                'comment' => '',
                'active' => true
            ],
            [
                'first_name' => 'louise',
                'last_name' => 'Bekers',
                'gender_id' => 2,
                'phone_number' => '0478123456',
                'street' => 'lenerdijk',
                'house_number' => '22',
                'city' => 'Mol',
                'postal_code' => '2400',
                'national_insurance_number' => '95845621547',
                'date_of_birth' => \Carbon\Carbon::create(2018, 11, 3),
                'email' => 'louise@gmail.com',
                'comment' => '',
                'active' => true
            ],
            [
                'first_name' => 'Emirhan',
                'last_name' => 'Islam',
                'gender_id' => 1,
                'phone_number' => '0472123456',
                'street' => 'bresserdijk',
                'house_number' => '1',
                'city' => 'Mol',
                'postal_code' => '2400',
                'national_insurance_number' => '56889451201',
                'date_of_birth' => \Carbon\Carbon::create(2012, 6, 21),
                'email' => 'Emirhan@gmail.com',
                'comment' => '',
                'active' => true
            ]
        ]);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};
