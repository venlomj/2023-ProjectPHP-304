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
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('gender_id')->constrained('genders')->onDelete('cascade')->onUpdate('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->string('street');
            $table->string('house_number');
            $table->string('city')->nullable();
            $table->string('postal_code');
            $table->string('national_insurance_number')->nullable();
            $table->date('date_of_birth');
            $table->string('account_number')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();
            $table->foreignId('current_team_id')->nullable();
            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();
        });


    DB::table('users')->insert(
        [
            [
                'role_id' =>1,
                'gender_id' => 1,
                'first_name' => 'Murrel',
                'last_name' => 'Venlo',
                'phone_number' => '474244807',
                'street' => 'Oude tramlijn',
                'house_number' => '33',
                'city' => 'Retie',
                'postal_code' => '2430',
                'national_insurance_number' => '41445444462626',
                'date_of_birth' => \Carbon\Carbon::create(1994,3,10),
                'email' => 'r0781309@student.thomasmore.be',
                'password' => Hash::make('admin1234'),
            ],
            [
                'role_id' =>2,
                'gender_id' => 1,
                'first_name' => 'Koen',
                'last_name' => 'Vangeel',
                'phone_number' => '474248867',
                'street' => 'Beekstraat',
                'house_number' => '6',
                'city' => 'Retie',
                'postal_code' => '2430',
                'national_insurance_number' => '41445444462626',
                'date_of_birth' => \Carbon\Carbon::create(1980,1,2),
                'email' => 'test@student.thomasmore.be',
                'password' => Hash::make('user1234'),
            ],
            [
                'role_id' =>4,
                'gender_id' => 1,
                'first_name' => 'Jurmen',
                'last_name' => 'Prijor',
                'phone_number' => '49355005',
                'street' => 'Kerstraat',
                'house_number' => '12',
                'city' => 'Retie',
                'postal_code' => '2430',
                'national_insurance_number' => '41445444462626',
                'date_of_birth' => now(),
                'email' => 'jurmen@hotmail.com',
                'password' => Hash::make('trainer1234'),
            ],
            [
            'role_id' =>4,
            'gender_id' => 1,
            'first_name' => 'Thijs',
            'last_name' => 'De Vriend',
            'phone_number' => '49355555',
            'street' => 'Hoofdstraat',
            'house_number' => '112',
            'city' => 'Retie',
            'postal_code' => '3530',
            'national_insurance_number' => '41555554462626',
            'date_of_birth' => now(),
            'email' => 'thijs@hotmail.com',
            'password' => Hash::make('trainer1234'),
        ]
        ]
    );

                for ($i = 0; $i <= 40; $i++) {
            // Every 6th user, $active is false (0) else true (1)
            //$active = ($i + 1) % 6 !== 0;
            DB::table('users')->insert(
                [
                    'role_id' => 5,
                    'gender_id' =>  2,
                    'first_name' => "stickies user $i",
                    'last_name' => "stickies user last name $i",
                    'email' => "stickies_user_$i@mailinator.com",
                    'password' => Hash::make("stickies$i"),
                    'phone_number' => '0000000',
                    'city' => 'gemeente',
                    'street' => "straat $i",
                    'house_number' => "1 $i",
                    'city' => 'Gemeente',
                    'postal_code' => "0000 $i",
                    'national_insurance_number' => "0000000000 $i",
                    'date_of_birth' => now(),
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
