<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePoisitionsEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poisitions_employee', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_id')->unsigned()->nullable();
            $table->foreign('employee_id')->references('id')->on('employees')->onDelete('SET NULL')->onUpdate('cascade');
            $table->string('document');
            $table->string('area');
            $table->bigInteger('position_id')->unsigned()->nullable();;
            $table->foreign('position_id')->references('id')->on('positions')->onDelete('SET NULL')->onUpdate('cascade');
            $table->unsignedBigInteger('rol_id')->nullable();;
            $table->foreign('rol_id')->references('id')->on('roles');
            $table->bigInteger('chief_id')->unsigned()->nullable();
            $table->foreign('chief_id')->references('id')->on('employees')->onDelete('SET NULL')->onUpdate('cascade');
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
        Schema::dropIfExists('poisitions_employee');
    }
}
