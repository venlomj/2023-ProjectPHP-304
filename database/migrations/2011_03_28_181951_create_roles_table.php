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
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique();
            $table->timestamps();
        });

        DB::table('roles')->insert(
            [
                [
                    'id'=> 1,
                    'type'=> 'admin'
                ],
                [
                    'id'=> 2,
                    'type'=> 'financieel beheerder'
                ],
                [
                    'id'=> 3,
                    'type'=> 'Voorzitter'
                ],
                [
                    'id'=> 4,
                    'type'=> 'trainer'
                ],
                [
                    'id'=> 5,
                    'type'=> 'ouder' //I change adult into 'ouder' --> is better so, because it's a record, which should be in Dutch
                ],
                [
                    'id'=> 6,
                    'type'=> 'kind' //for member
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
        Schema::dropIfExists('roles');
    }
};
