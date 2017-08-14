<?php

use App\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('city');
            $table->string('address');
            $table->string('phone');
            $table->string('experience');
            $table->string('affiliations');
            $table->timestamp('timeAt');
            $table->string('nameCo');
            $table->string('siteW');
            $table->string('image1');
            $table->string('image2');
            $table->string('image3');
            $table->text('services');
            $table->text('abstract');
            $table->string('cedula');
            $table->string('businessName');
            $table->string('razonSocial');
            $table->string('rfc');
            $table->integer('cral');
            $table->string('nameLegal');
            $table->string('activation')->default(User::USUARIO_NO_ACTIVADO);
            $table->string('activationToken')->nullable();
            $table->string('tipoCedula');
            $table->string('longitude');
            $table->string('latitude');
            $table->string('agenteTipo');
            $table->string('especial1');
            $table->string('especial2');
            $table->string('especial3');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('type')->default(User::USUARIO_AGENTE);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
