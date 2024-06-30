<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->restrictOnDelete()->onUpdate('cascade');
            $table->foreignId('event_id')->constrained()->restrictOnDelete()->onUpdate('cascade');
            $table->unique(['user_id', 'event_id']);
            $table->timestamps();
        });

        DB::table('user_attendances')->insert([
            ['user_id' => 1, 'event_id' => 1],
            ['user_id' => 1, 'event_id' => 2],
            ['user_id' => 2, 'event_id' => 1],
            ['user_id' => 3, 'event_id' => 2],
            ['user_id' => 1, 'event_id' => 5],
            ['user_id' => 2, 'event_id' => 6],
        ]);
//        DB::table('user_attendances')->insert([
//            [
//                'user_id' => 1,
//                'weekday_id' => 1,
//                'present_start' => Carbon::parse('08:30:00')->format('H:i:s'),
//                'present_end' => Carbon::parse('12:30:00')->format('H:i:s'),
//                'absent_start' => null,
//                'absent_end' => null,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now(),
//            ],
//            [
//                'user_id' => 1,
//                'weekday_id' => 2,
//                'present_start' => Carbon::parse('09:00:00')->format('H:i:s'),
//                'present_end' => Carbon::parse('13:00:00')->format('H:i:s'),
//                'absent_start' => null,
//                'absent_end' => null,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now(),
//            ],
//            [
//                'user_id' => 2,
//                'weekday_id' => 1,
//                'present_start' => Carbon::parse('07:00:00')->format('H:i:s'),
//                'present_end' => Carbon::parse('11:00:00')->format('H:i:s'),
//                'absent_start' => null,
//                'absent_end' => null,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now(),
//            ],
//            [
//                'user_id' => 2,
//                'weekday_id' => 2,
//                'present_start' => Carbon::parse('10:00:00')->format('H:i:s'),
//                'present_end' => Carbon::parse('14:00:00')->format('H:i:s'),
//                'absent_start' => null,
//                'absent_end' => null,
//                'created_at' => Carbon::now(),
//                'updated_at' => Carbon::now(),
//            ],
//        ]);

    }



    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_attendances');
    }
};
