<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('employee_id')->nullable();
            $table->string('name',50);
            $table->string('nid',17)->nullable();
            $table->string('mobile',11)->nullable();
            $table->date('birth_date')->nullable();
            $table->string('gender',6);
            $table->string('photo',155)->nullable();
            $table->string('recruitment_letter',155)->nullable();
            $table->string('religion',10)->nullable();
            $table->string('educational_qulification',25)->nullable();
            $table->string('hiring_authority',10);
            $table->date('first_joining');
            $table->integer('created_by');
            $table->string('created_by_ip',25);
            $table->integer('updated_by')->nullable();
            $table->string('updated_by_ip',25)->nullable();
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
        Schema::dropIfExists('employees');
    }
}
