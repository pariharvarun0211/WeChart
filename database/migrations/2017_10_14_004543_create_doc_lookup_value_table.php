<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDocLookupValueTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doc_lookup_value', function (Blueprint $table) {
            $table->integer('doc_control_id')->unsigned();
            $table->integer('lookup_value_id')->unsigned();
            $table->integer('sort_order_number')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('doc_lookup_value', function (Blueprint $table) {
            $table->foreign('doc_control_id')->references('doc_control_id')->on('doc_control');
        });

        Schema::table('doc_lookup_value', function (Blueprint $table) {
            $table->foreign('lookup_value_id')->references('lookup_value_id')->on('lookup_value');
        });

        /*  We are no longer including demographics in active record
                //Inserting record for documentation-male relation
                DB::table('doc_lookup_value')->insert(
                    array(
                        'doc_control_id' => ?,
                        'lookup_value_id' => 1,
                        'sort_order_number' => 1,
                        'created_by' => 1
                        )
                    );

                //Inserting record for female
                DB::table('doc_lookup_value')->insert(
                    array(
                        'doc_control_id' => ?,
                        'lookup_value_id' => 2,
                        'sort_order_number' => 2,
                        'created_by' => 1
                        )
                    );
        */

        //Inserting record for Smoke Tobacco - YES
        DB::table('doc_lookup_value')->insert(
            array(
                'doc_control_id' => 13,		//Smoke Tobacco
                'lookup_value_id' => 3,		//YES
                'sort_order_number' => 1,
                'created_by' => 1
            )
        );

        //Inserting record for Smoke Tobacco - NO
        DB::table('doc_lookup_value')->insert(
            array(
                'doc_control_id' => 13,		//Smoke Tobacco
                'lookup_value_id' => 4,		//NO
                'sort_order_number' => 2,
                'created_by' => 1
            )
        );

        //Inserting record for Non-Smoke Tobacco - YES
        DB::table('doc_lookup_value')->insert(
            array(
                'doc_control_id' => 14,		//Non-Smoke Tobacco
                'lookup_value_id' => 3,		//YES
                'sort_order_number' => 1,
                'created_by' => 1
            )
        );

        //Inserting record for Non-Smoke Tobacco - NO
        DB::table('doc_lookup_value')->insert(
            array(
                'doc_control_id' => 14,		//Non-Smoke Tobacco
                'lookup_value_id' => 4,		//NO
                'sort_order_number' => 2,
                'created_by' => 1
            )
        );

        //Inserting record for Alcohol - YES
        DB::table('doc_lookup_value')->insert(
            array(
                'doc_control_id' => 15,		//Alcohol
                'lookup_value_id' => 3,		//YES
                'sort_order_number' => 1,
                'created_by' => 1
            )
        );

        //Inserting record for Alcohol - NO
        DB::table('doc_lookup_value')->insert(
            array(
                'doc_control_id' => 15,		//Alcohol
                'lookup_value_id' => 4,		//NO
                'sort_order_number' => 2,
                'created_by' => 1
            )
        );

        //Inserting record for Sexual Activity - Active
        DB::table('doc_lookup_value')->insert(
            array(
                'doc_control_id' => 16,		//Sexual Activity
                'lookup_value_id' => 5,		//Active
                'sort_order_number' => 1,
                'created_by' => 1
            )
        );

        //Inserting record for Sexual Activity - Not active
        DB::table('doc_lookup_value')->insert(
            array(
                'doc_control_id' => 16,		//Sexual Activity
                'lookup_value_id' => 6,		//Not Active
                'sort_order_number' => 2,
                'created_by' => 1
            )
        );

        //Inserting record for Family Member - Status - Alive
        DB::table('doc_lookup_value')->insert(
            array(
                'doc_control_id' => 9,		//Family Member Status
                'lookup_value_id' => 7,		//Alive
                'sort_order_number' => 1,
                'created_by' => 1
            )
        );

        //Inserting record for Family Member - Status - Deceased
        DB::table('doc_lookup_value')->insert(
            array(
                'doc_control_id' => 9,		//Family Member Status
                'lookup_value_id' => 8,		//Deseased
                'sort_order_number' => 2,
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
        Schema::dropIfExists('doc_lookup_value');
    }
}
