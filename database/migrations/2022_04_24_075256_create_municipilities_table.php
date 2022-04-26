<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMunicipilitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('municipilities', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code',50)->nullable();
            $table->string('name',255);
            $table->string('logo',150)->nullable();
            $table->tinyInteger('division_id');
            $table->tinyInteger('district_id');
            $table->integer('estabilish_year')->nullable();
            $table->string('email',100)->nullable();
            $table->string('website',100)->nullable();
            $table->string('fax',25)->nullable();
            $table->tinyInteger('class');
            $table->tinyInteger('status');
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
        Schema::dropIfExists('municipilities');
    }
}
