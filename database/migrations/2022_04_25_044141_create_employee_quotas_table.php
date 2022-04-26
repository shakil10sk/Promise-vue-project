<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeQuotasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_quotas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->tinyInteger('municipility_class')->comment('1 = ক, 2 = খ, 3 = গ');
            $table->integer('designation_id');
            $table->integer('total_quota');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employee_quotas');
    }
}
