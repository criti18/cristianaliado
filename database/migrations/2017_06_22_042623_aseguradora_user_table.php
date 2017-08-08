<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AseguradoraUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aseguradora_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('aseguradora_id')->unsigned();
            
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('aseguradora_id')->references('id')->on('aseguradoras');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aseguradora_user');
    }
}
