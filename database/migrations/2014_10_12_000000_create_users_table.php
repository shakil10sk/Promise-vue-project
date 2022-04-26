<?php

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
            $table->bigIncrements('id');
            $table->string('employee_id')->nullable();
            $table->string('mobile_no',11)->unique();
            $table->string('password',255);
            $table->tinyInteger('type')->comment('1 = superadmin, 2 = admin, 3 = other');
            $table->integer('created_by');
            $table->string('created_by_ip',25);
            $table->integer('updated_by')->nullable();
            $table->string('updated_by_ip',25)->nullable();
            $table->softdeletes();
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
        Schema::dropIfExists('users');
    }
}
