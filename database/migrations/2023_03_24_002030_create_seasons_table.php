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
        Schema::create('seasons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->date('start_date');
            $table->date('end_date');
            $table->boolean('active');
            $table->integer('amount');
            $table->timestamps();
        });

        DB::table('seasons')->insert(
            [
                [
                    'name'=>'seizoen 13',
                    'start_date'=>\Carbon\Carbon::create(2023,4,1),
                    'end_date'=>\Carbon\Carbon::create(2023,8,1),
                    'active'=>true,
                    'amount'=>35
                ],
                [
                    'name'=>'seizoen 14',
                    'start_date'=>\Carbon\Carbon::create(2023,4,1),
                    'end_date'=>\Carbon\Carbon::create(2023,4,1),
                    'active'=>false,
                    'amount'=>35
                ],
                [
                    'name'=>'seizoen 15',
                    'start_date'=>\Carbon\Carbon::create(2023,4,1),
                    'end_date'=>\Carbon\Carbon::create(2023,4,1),
                    'active'=>false,
                    'amount'=>40
                ],
                [
                    'name'=>'seizoen 16',
                    'start_date'=>\Carbon\Carbon::create(2023,4,1),
                    'end_date'=>\Carbon\Carbon::create(2023,4,1),
                    'active'=>true,
                    'amount'=>40
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
        Schema::dropIfExists('seasons');
    }
};
