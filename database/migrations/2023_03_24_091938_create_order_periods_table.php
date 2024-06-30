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
        Schema::create('order_periods', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('start_date')->unique();
            $table->date('end_date');
            $table->foreignId('season_id')->constrained()->restrictOnUpdate()->restrictOnDelete();
            $table->timestamps();
        });

        DB::table('order_periods')->insert(
            [
                [
                    'name'=>'start seizoen',
                    'start_date'=>\Carbon\Carbon::create(2022,9,1),
                    'end_date'=>\Carbon\Carbon::create(2023,1,1),
                    'season_id'=>1
                ],
//                [
//                    'name'=>'paas collectie',
//                    'start_date'=> '2019-03-03',
//                    'end_date'=> '2019-04-01',
//                    'season_id'=>1
//                ],
//                [
//                    'name'=>'start seizoen',
//                    'start_date'=> '2020-01-01',
//                    'end_date'=> '2020-02-18',
//                    'season_id'=>2
//                ],
//                [
//                    'name'=>'paas collectie',
//                    'start_date'=> '2020-01-03',
//                    'end_date'=> '2020-02-8',
//                    'season_id'=>2
//                ],
//                [
//                    'name'=>'start seizoen',
//                    'start_date'=> '2019-01-01',
//                    'end_date'=> '2019-02-18',
//                    'season_id'=>3
//                ],
//                [
//                    'name'=>'paas collectie',
//                    'start_date'=> '2021-01-01',
//                    'end_date'=> '2021-02-18',
//                    'season_id'=>3
//                ],
//                [
//                    'name'=>'start seizoen',
//                    'start_date'=> '2022-01-01',
//                    'end_date'=> '2022-02-18',
//                    'season_id'=>4
//                ],
//                    'start_date'=>\Carbon\Carbon::create(2023,1,1),
//                    'end_date'=>\Carbon\Carbon::create(2023,2,1),
//                    'season_id'=>1
//                ],
                [
                    'name'=>'winter seizoen',
                    'start_date'=>\Carbon\Carbon::create(2023,2,1),
                    'end_date'=>\Carbon\Carbon::create(2023,3,1),
                    'season_id'=>2
                ],
                [
                    'name'=>'herst collectie',
                    'start_date'=>\Carbon\Carbon::create(2023,3,1),
                    'end_date'=>\Carbon\Carbon::create(2023,4,1),
                    'season_id'=>2
                ],
                [
                    'name'=>'zomer collectie',
                    'start_date'=>\Carbon\Carbon::create(2023,4,1),
                    'end_date'=>\Carbon\Carbon::create(2023,5,1),
                    'season_id'=>3
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
        Schema::dropIfExists('order_periods');
    }
};
