<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInsurancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('insurances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('buyer_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('typeInsurance')->default(null);
            $table->string('aseguradora')->default(null);
            $table->datetime('vigencia')->default(null);
            $table->string('noPoliz')->default(null);
            $table->string('telEmergency')->default(null);
            $table->string('telAsesor')->default(null);
            $table->text('coverage')->default(null);
            $table->text('exclusions')->default(null);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('buyer_id')->references('id')->on('buyers');
            $table->foreign('user_id')->references('id')->on('buyers');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('insurances');
    }
}
