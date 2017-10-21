<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLookupValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lookup_value', function (Blueprint $table) {
            $table->increments('lookup_value_id');
            $table->string('lookup_value');
            $table->boolean('archived')->default(0);
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
//            $table->rememberToken();
            $table->timestamps();
        });

        //Inserting record for male 1
        DB::table('lookup_value')->insert(
            array(
                'lookup_value' => 'Male',
                'created_by' => 1
            )
        );

        //Inserting record for female 2
        DB::table('lookup_value')->insert(
            array(
                'lookup_value' => 'Female',
                'created_by' => 1
            )
        );

        //Inserting record for YES 3
        DB::table('lookup_value')->insert(
            array(
                'lookup_value' => 'YES',
                'created_by' => 1
            )
        );

        //Inserting record for NO 4
        DB::table('lookup_value')->insert(
            array(
                'lookup_value' => 'NO',
                'created_by' => 1
            )
        );

        //Inserting record for active 5
        DB::table('lookup_value')->insert(
            array(
                'lookup_value' => 'Active',
                'created_by' => 1
            )
        );

        //Inserting record for not active 6
        DB::table('lookup_value')->insert(
            array(
                'lookup_value' => 'Not Active',
                'created_by' => 1
            )
        );


        //Inserting record for active 7
        DB::table('lookup_value')->insert(
            array(
                'lookup_value' => 'Alive',
                'created_by' => 1
            )
        );

        //Inserting record for not active 8
        DB::table('lookup_value')->insert(
            array(
                'lookup_value' => 'Deceased',
                'created_by' => 1
            )
        );


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lookup_value');
    }
}
