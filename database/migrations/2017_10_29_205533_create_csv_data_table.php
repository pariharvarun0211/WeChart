<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

use App\Csvdata;

//use Illuminate\Support\Collection;

class CreateCsvDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('csv_data', function (Blueprint $table) {
            $table->increments('id');
            $table->string('medical_list');
            $table->timestamps();
        });

        //Load tab-delimited file
        if (($handle = fopen ( public_path('med_dx_test.txt'), 'r' )) !== FALSE) {
            while ($data = fgetcsv ($handle, 1000, "\t"))  {

                $csv_data = new Csvdata ();
                $csv_data->medical_list = $data[0];
                $csv_data->save();

            }
            fclose ($handle);
        };


        //Load lookup_value
        $select_medlist = DB::table('csv_data')
            ->get(array('medical_list'));

        foreach($select_medlist as $data){
            DB::table('diagnosis_lookup_value')->insert(
                [
                    'diagnosis_lookup_value' => $data->medical_list,
                    'created_by'=>1
                ]);
        }

        //Load doc_lookup_value
//		$select_relation = DB::table('csv_data')
//			->join('lookup_value', 'csv_data.medical_list', '=', 'lookup_value.lookup_value')
//			->join('doc_control', function($join)
//			{
//				$join->on('doc_control.doc_control_id', '=', DB::raw('3'));
//				$join->orOn('doc_control.doc_control_id', '=', DB::raw('6'));
//				$join->orOn('doc_control.doc_control_id', '=', DB::raw('9'));
//			}) ->get(array('lookup_value_id', 'doc_control_id'));
//
//		foreach($select_relation as $data) {
//			DB::table('doc_lookup_value')->insert(
//				[
//					'lookup_value_id'=>$data->lookup_value_id,
//					'doc_control_id'=>$data->doc_control_id,
//					'created_by'=>1
//				]);
//		}




        //clear out staging table
        DB::table('csv_data')->truncate();

        //Load tab-delimited file for medications
        if (($handle = fopen ( public_path('med_list.txt'), 'r' )) !== FALSE) {
            while ($data = fgetcsv ($handle, 1000, "\t"))  {

                $csv_data = new Csvdata ();
                $csv_data->medical_list = $data[0];
                $csv_data->save();

            }
            fclose ($handle);
        };


        //Load lookup_value
        $select_medlist = DB::table('csv_data')
            ->get(array('medical_list'));

        foreach($select_medlist as $data){
            DB::table('med_lookup_value')->insert(
                [
                    'med_lookup_value' => $data->medical_list,
                    'created_by'=>1
                ]);
        }

        //Load doc_lookup_value
//		$select_relation = DB::table('csv_data')
//			->join('lookup_value', 'csv_data.medical_list', '=', 'lookup_value.lookup_value')
//			->join('doc_control', function($join)
//			{
//				$join->on('doc_control.doc_control_id', '=', DB::raw('16'));
//			}) ->get(array('lookup_value_id', 'doc_control_id'));
//
//		foreach($select_relation as $data) {
//			DB::table('doc_lookup_value')->insert(
//				[
//					'lookup_value_id'=>$data->lookup_value_id,
//					'doc_control_id'=>$data->doc_control_id,
//					'created_by'=>1
//				]);
//		}





        //clear out staging table
        DB::table('csv_data')->truncate();

        //Load tab-delimited file for Lab Orders
        if (($handle = fopen ( public_path('lab_orders.txt'), 'r' )) !== FALSE) {
            while ($data = fgetcsv ($handle, 1000, "\t"))  {

                $csv_data = new Csvdata ();
                $csv_data->medical_list = $data[0];
                $csv_data->save();

            }
            fclose ($handle);
        };


        //Load lookup_value
        $select_medlist = DB::table('csv_data')
            ->get(array('medical_list'));

        foreach($select_medlist as $data){
            DB::table('lab_orders_lookup_value')->insert(
                [
                    'lab_orders_lookup_value' => $data->medical_list,
                    'created_by'=>1
                ]);
        }

        //Load doc_lookup_value
//		$select_relation = DB::table('csv_data')
//			->join('lookup_value', 'csv_data.medical_list', '=', 'lookup_value.lookup_value')
//			->join('doc_control', function($join)
//			{
//				$join->on('doc_control.doc_control_id', '=', DB::raw('69'));
//			}) ->get(array('lookup_value_id', 'doc_control_id'));
//
//		foreach($select_relation as $data) {
//			DB::table('doc_lookup_value')->insert(
//				[
//					'lookup_value_id'=>$data->lookup_value_id,
//					'doc_control_id'=>$data->doc_control_id,
//					'created_by'=>1
//				]);
//		}





        //clear out staging table
        DB::table('csv_data')->truncate();

        //Load tab-delimited file for Lab Orders
        if (($handle = fopen ( public_path('imaging_orders.txt'), 'r' )) !== FALSE) {
            while ($data = fgetcsv ($handle, 1000, "\t"))  {

                $csv_data = new Csvdata ();
                $csv_data->medical_list = $data[0];
                $csv_data->save();

            }
            fclose ($handle);
        };


        //Load lookup_value
        $select_medlist = DB::table('csv_data')
            ->get(array('medical_list'));

        foreach($select_medlist as $data){
            DB::table('imaging_orders_lookup_value')->insert(
                [
                    'imaging_orders_lookup_value' => $data->medical_list,
                    'created_by'=>1
                ]);
        }

        //Load doc_lookup_value
//		$select_relation = DB::table('csv_data')
//			->join('lookup_value', 'csv_data.medical_list', '=', 'lookup_value.lookup_value')
//			->join('doc_control', function($join)
//			{
//				$join->on('doc_control.doc_control_id', '=', DB::raw('70'));
//			}) ->get(array('lookup_value_id', 'doc_control_id'));
//
//		foreach($select_relation as $data) {
//			DB::table('doc_lookup_value')->insert(
//				[
//					'lookup_value_id'=>$data->lookup_value_id,
//					'doc_control_id'=>$data->doc_control_id,
//					'created_by'=>1
//				]);
//		}





    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('csv_data');
    }
}
