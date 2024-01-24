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
        Schema::create('data_klasemen', function (Blueprint $table) {
            $table->id('id_klasemen');
            $table->integer('club_id');
            $table->integer('main');
            $table->integer('menang');
            $table->integer('seri');
            $table->integer('kalah');
            $table->integer('goal_menang');
            $table->integer('goal_kalah');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_klasemen');
    }
};
