<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Carbon;
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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->date('start_date');
            $table->date('end_date');
            $table->timestamps();
        });

        DB::table('events')->insert([
            [
                'title' => 'Afwezig',
                'start_date' => Carbon::createFromFormat('d-m-Y', '01-01-2023')->toDateString(),
                'end_date' => Carbon::createFromFormat('d-m-Y', '02-01-2023')->toDateString(),
            ],
            [
                'title' => 'Aanwezig',
                'start_date' => Carbon::createFromFormat('d-m-Y', '03-01-2023')->toDateString(),
                'end_date' => Carbon::createFromFormat('d-m-Y', '04-01-2023')->toDateString(),
            ],
            [
                'title' => 'Afwezig',
                'start_date' => Carbon::createFromFormat('d-m-Y', '05-01-2023')->toDateString(),
                'end_date' => Carbon::createFromFormat('d-m-Y', '06-01-2023')->toDateString(),
            ],
            [
                'title' => 'Aanwezig',
                'start_date' => Carbon::createFromFormat('d-m-Y', '07-01-2023')->toDateString(),
                'end_date' => Carbon::createFromFormat('d-m-Y', '08-01-2023')->toDateString(),
            ],
            [
                'title' => 'Afwezig',
                'start_date' => Carbon::createFromFormat('d-m-Y', '05-05-2023')->toDateString(),
                'end_date' => Carbon::createFromFormat('d-m-Y', '06-05-2023')->toDateString(),
            ],
            [
                'title' => 'Aanwezig',
                'start_date' => Carbon::createFromFormat('d-m-Y', '07-05-2023')->toDateString(),
                'end_date' => Carbon::createFromFormat('d-m-Y', '08-05-2023')->toDateString(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
};
