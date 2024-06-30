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
        Schema::create('trainings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('group_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('user_id')->unique()->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->foreignId('field_id')->nullable()->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->dateTime('start_moment')->unique();
            $table->dateTime('end_moment');
            $table->timestamps();
        });
        DB::table('trainings')->insert(
            [
                [
                    'group_id'=>1,
                    'user_id'=>1,
                    'field_id'=>2,
                    'start_moment'=>\Carbon\Carbon::create(2023,4,1,10,20,30),
                    'end_moment'=>\Carbon\Carbon::create(2023,4,1,11,20,30)
                ],
                [
                    'group_id'=>2,
                    'user_id'=>2,
                    'field_id'=>3,
                    'start_moment'=>\Carbon\Carbon::create(2023,4,1,11,20,30),
                    'end_moment'=>\Carbon\Carbon::create(2023,4,1,12,20,30)
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
        Schema::dropIfExists('trainings');
    }
};
