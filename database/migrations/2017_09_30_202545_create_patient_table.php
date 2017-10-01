<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patient', function (Blueprint $table) {
            $table->increments('patient_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('gender');
            $table->integer('age');
            $table->integer('height');
            $table->string('visit_date');
            $table->integer('module_id')->unsigned();
            $table->boolean('is_archived')->default(0);
            $table->integer('patient_record_status_id')->unsigned();
            $table->rememberToken();
            $table->timestamps();
        });

        //Adding foreign key constraint with module table
        Schema::table('patient', function (Blueprint $table) {
            $table->foreign('module_id')->references('module_id')->on('module');
        });

        //Adding foreign key constraints with patient_record_status table
        Schema::table('patient', function (Blueprint $table) {
            $table->foreign('patient_record_status_id')->references('patient_record_status_id')->on('patient_record_status');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('patient');
    }
}
