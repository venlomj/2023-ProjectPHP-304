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
        Schema::create('hourly_wages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->float('wage');
            $table->date('wage_from');
            $table->timestamps();
        });
        DB::table('hourly_wages')->insert(
            [
                [
                    'user_id'=>1,
                    'wage'=>15.31,
                    'wage_from'=>\Carbon\Carbon::create(2023,4,1)
                ],
                [
                    'user_id'=>2,
                    'wage'=>18.31,
                    'wage_from'=>\Carbon\Carbon::create(2023,5,1)
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
        Schema::dropIfExists('hourly_wages');
    }
};
