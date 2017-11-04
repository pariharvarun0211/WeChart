@extends('patient.active_record')

@section('documentation_panel')
    {{--@parent--}}
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-14">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                        <h4 style="margin-top: 0" id="hpi_heading">Vital Signs</h4>
                    </div>

                    <div class="panel-body col-md-offset">
                        <div class="col-md-30" style="float: right">
                            <button type="submit" id="btn_add_vital_signs" class="btn btn-primary">
                                Add Vital Signs
                            </button>
                        </div>
                        <br><br>
                        <div class="row" style="overflow-x: auto;width: 775px" class="col-md-12">
                            <table class="table table-striped table-bordered table-hover" style="margin-top:10px; margin-left:15px;" id="vital_signs_table">
                                <thead>
                                <tr style="background: lightblue">
                                    <th>Timestamp</th>
                                    <th>BP Systolic</th>
                                    <th>BP Diastolic</th>
                                    <th>Heart Rate</th>
                                    <th>Respiratory Rate</th>
                                    <th>Temperature</th>
                                    <th>Weight</th>
                                    <th>Height</th>
                                    <th>Pain</th>
                                    <th>Oxygen Saturation</th>
                                    <th>Comment</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                {{--Checking for no records--}}
                                @if(!count($vital_sign_details)> 0)
                                <tr>
                                    <td colspan="12" style="text-align: center">
                                        <br>
                                            <b>There are no vital signs.</b>
                                        <br>
                                    </td>
                                </tr>
                                @else
                                    @foreach ($vital_sign_details as $vs)
                                        <tr>
                                            <td>{{ $vs->timestamp }}</td>
                                            <td>{{ $vs->BP_Systolic[0] }}</td>
                                            <td>{{$vs->BP_Diastolic[0]}}</td>
                                            <td>{{$vs->Heart_Rate[0]}}</td>
                                            <td>{{$vs->Respiratory_Rate[0]}}</td>
                                            <td>{{$vs->Temperature[0]}}</td>
                                            <td>{{$vs->Weight[0]}}</td>
                                            <td>{{$vs->Height[0]}}</td>
                                            <td>{{$vs->Pain[0]}}</td>
                                            <td>{{$vs->Oxygen_Saturation[0]}}</td>
                                            <td>{{$vs->Comment[0]}}</td>
                                            <td>
                                                {{ Form::open(array('method' => 'post', 'route' => array('delete_vital_signs', $vs->timestamp))) }}
                                                    <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                                                    <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                                                    <button name="delbutton" class="btn btn-danger btn-delete btn-sm">Delete</button>
                                                {{ Form::close() }}
                                            </td>
                                        </tr>

                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                        <br><br>

                        <div class="row" style="overflow-x: auto;width: 775px" class="col-md-12">
                            <form class="form-horizontal" method="POST" action="{{ url('post_vital_signs') }}">
                                {{ csrf_field() }}
                                <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                                <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                                <!-- <input id="timestamp" name="timestamp" type="hidden"> -->
                                <table class="table table-striped table-bordered table-hover" id="table_child_vital_signs" style="margin-top:10px; margin-left:15px;">
                                    <tr style="background: lightblue">
                                        <th>BP Systolic</th>
                                        <th>BP Diastolic</th>
                                        <th>Heart Rate</th>
                                        <th>Respiratory Rate</th>
                                        <th>Temperature</th>
                                        <th>Weight</th>
                                        <th>Height</th>
                                        <th>Pain</th>
                                        <th>Oxygen Saturation</th>
                                        <th>Comment</th>
                                        <th>Action</th>
                                    </tr>

                                    <tr>
                                        <td>
                                            <input type="text" name="BP_Systolic" id="BP_Systolic" style="width: 100px;">
                                        </td>
                                        <td>
                                            <input type="text" name="BP_Diastolic" id="BP_Diastolic" style="width: 100px;">
                                        </td>
                                        <td>
                                            <input type="text" name="Heart_Rate" id="Heart_Rate" style="width: 100px;">
                                        </td>
                                        <td>
                                            <input type="text" name="Respiratory_Rate" id="Respiratory_Rate" style="width: 100px;">
                                        </td>
                                        <td>
                                            <input type="text" name="Temperature" id="Temperature" style="width: 100px;">
                                            <select name="temperature_unit" id = "temperature_unit">
                                                <option value=""></option>
                                                <option value="F">F</option>
                                                <option value="C">C</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="Weight" id="Weight" style="width: 100px;">
                                            <select name="weight_unit" id = "weight_unit">
                                                <option value=""></option>
                                                <option value="kgs">kgs</option>
                                                <option value="lbs">lbs</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="Height" id="Height" style="width: 100px;">
                                            <select name="height_unit" id="height_unit">
                                                <option value=""></option>
                                                <option value="cms">cms</option>
                                                <option value="inches">inches</option>
                                            </select>
                                        </td>
                                        <td>
                                            <input type="text" name="Pain" id="Pain" style="width: 100px;">
                                        </td>
                                        <td>
                                            <input type="text" name="Oxygen_Saturation" id="Oxygen_Saturation" style="width: 100px;">
                                        </td>
                                        <td>
                                            <input type="text" name="Comments" id="Comments" style="width: 100px;">
                                        </td>
                                        <td>
                                            <button name="submitbutton" class="btn btn-success btn-submit btn-sm">Add</button>
                                        </td>
                                    </tr>

                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $('#table_child_vital_signs').hide();
            $("#btn_add_vital_signs").click(function(){
                //$('#onetimedisplay').hide();
                $('#table_child_vital_signs').show();
                $("#btn_add_vital_signs").hide();
            });
        });

    </script>

@endsection