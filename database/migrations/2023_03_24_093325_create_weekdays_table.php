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
        Schema::create('weekdays', function (Blueprint $table) {
            $table->id();
            $table->string('weekday')->unique();
            $table->timestamps();
        });
        DB::table('weekdays')->insert(
            [
                [
                    'weekday'=>'monday'
                ],
                [
                    'weekday'=>'tuesday'
                ],
                [
                    'weekday'=>'wednesday'
                ],
                [
                    'weekday'=>'thursday'
                ],
                [
                    'weekday'=>'friday'
                ],
                [
                    'weekday'=>'saturday'
                ],
                [
                    'weekday'=>'sunday'
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
        Schema::dropIfExists('weekdays');
    }
};
