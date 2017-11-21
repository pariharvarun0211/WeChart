<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>WeChart</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

</head>
<body>
    <div class="container-fluid">
        <!--Vital signs header -->
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-3">
                                <label style="float: left">Submitted to-</label>
                                    @foreach ($instructor_Details as $key=>$instructor_Detail)
                                        @if(count($instructor_Detail)>0)
                                            <label>{{ $instructor_Detail[0]->firstname}} {{ $instructor_Detail[0]->lastname}}</label>
                                            <br>
                                        @endif
                                    @endforeach
                            </div>
                            <div class="col-md-6">
                                <h3 id="patient_active_record" align="center" style="margin-top: 0;"><b>Patient Active Record</b></h3>
                            </div>
                            <div class="col-md-3">
                                <label style="float: right">Submitted by- {{ Auth::user()->firstname }} {{ Auth::user()->lastname}}</label>
                                <br>
                                <label style="float: right">Submitted on- {{$patient->submitted_date}} </label>
                            </div>
                        </div>
                </div>
                <div class="panel-body" style="margin-bottom: 0;padding-bottom: 0;background-color: #FFFAF0;margin-top: 0;padding-top: 0">
                    <table class="table" style=" margin-top: 0;padding-top: 0;margin-bottom: 0;padding-bottom: 0">
                        <!--This is the first row in the vital signs panel -->
                        <tr style="padding-top: 0;padding-bottom: 0%; border-style: hidden">
                            <td style="padding-top: 0;padding-bottom: 0%">
                                <p id="name_label" style="align-self: center"><strong>Patient Name:</strong>
                                    {{$vital_signs_header->name}}
                                </p>
                            </td>
                            <td style="padding-top: 0;padding-bottom: 0%">
                                <p id="age_label"><strong>Patient Age: </strong>
                                    {{$vital_signs_header->age}}
                                </p>
                            </td>
                            <td style="padding-top: 0;padding-bottom: 0%">
                                <p id="sex_label"><strong>Patient Sex: </strong>
                                    {{$vital_signs_header->gender}}
                                </p>
                            </td>
                            <td style="padding-top: 0;padding-bottom: 0%">
                                <p id="room_number_label"> <strong>Room No: </strong>
                                    {{$vital_signs_header->room_number}}</p>
                            </td>
                        </tr>
                        <!--This is the second row in the vital signs panel -->
                        <tr style="padding-top: 0;padding-bottom: 0%; border-style: hidden">
                            <td style="padding-top: 0%;padding-bottom: 0%">
                                <p id="visit_date_label"><strong>Visit Date: </strong>
                                    {{$vital_signs_header->visit_date}}</p>
                            </td>
                            <td style="padding-top: 0;padding-bottom: 0%">
                                <p id="RR_label" style="align-self: center"><strong>Respiratory Rate (RR):</strong>
                                    @foreach($vital_signs_header->respiratory_rate as $key=>$respiratory_rate)
                                        @if($respiratory_rate != null)
                                            {{$vital_signs_header->respiratory_rate[$key]}}
                                            @break
                                        @endif
                                    @endforeach
                                </p>
                            </td>
                            <td style="padding-top: 0%;padding-bottom: 0%">
                                <p id="temperature_label"><strong>Temperature: </strong>
                                    @foreach($vital_signs_header->temperature as $key=>$temperature)
                                        @if($temperature != ' ')
                                            {{$vital_signs_header->temperature[$key]}}
                                            @break
                                        @endif
                                    @endforeach
                                </p>
                            </td>
                            <td style="padding-top: 0%;padding-bottom: 0%">
                                <p id="oxygen_saturation_label"><strong>Oxygen Saturation: </strong>
                                    @foreach($vital_signs_header->oxygen_saturation as $key=>$oxygen_saturation)
                                        @if($oxygen_saturation != null)
                                            {{$vital_signs_header->oxygen_saturation[$key]}}
                                            @break
                                        @endif
                                    @endforeach
                                </p>
                            </td>
                        </tr>
                        <!--This is the third row in the vital signs panel -->
                        <tr style="padding-top: 0;padding-bottom: 0%; border-style: hidden">
                            <td style="padding-top: 0;padding-bottom: 0%">
                                <p id="bp_systolic_label" style="align-self: center"><strong>Blood Pressure (BP) Systolic: </strong>
                                    @foreach($vital_signs_header->BP_systolic as $key=>$BP_systolic)
                                        @if($BP_systolic != null)
                                            {{$vital_signs_header->BP_systolic[$key]}}
                                            @break
                                        @endif
                                    @endforeach
                                </p>
                            </td>
                            <td style="padding-top: 0%;padding-bottom: 0%">
                                <p id="bp_diastolic_label"><strong>Blood Pressure (BP) Diastolic: </strong>
                                    @foreach($vital_signs_header->BP_diastolic as $key=>$BP_diastolic)
                                        @if($BP_diastolic != null)
                                            {{$vital_signs_header->BP_diastolic[$key]}}
                                            @break
                                        @endif
                                    @endforeach
                                </p>
                            </td>
                            <td style="padding-top: 0%;padding-bottom: 0%">
                                <p id="hr_label"><strong>Heart Rate (HR): </strong>
                                    @foreach($vital_signs_header->heart_rate as $key=>$heart_rate)
                                        @if($heart_rate != null)
                                            {{$vital_signs_header->heart_rate[$key]}}
                                            @break
                                        @endif
                                    @endforeach
                                </p>
                            </td>
                            <td style="padding-top: 0%;padding-bottom: 0%">
                                <p id="pain_label"><strong>Pain:  </strong>
                                    @foreach($vital_signs_header->pain as $key=>$pain)
                                        @if($pain != null)
                                            {{$vital_signs_header->pain[$key]}}
                                            @break
                                        @endif
                                    @endforeach
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
        {{--HPI--}}
        <div class="row">
            <div class="panel panel-default">
            <div class="panel-heading" style="background-color: lightblue">
               <a data-toggle="collapse" href="#HPI">HPI</a>
            </div>
            <div class="panel-body" id="HPI" class="panel-collapse collapse">
                @if(!count($HPI)>0)
                    <textarea id="HPI" name="HPI" rows="6" style="width: 100%;display: block" ></textarea>
                @else
                    <textarea id="HPI" name="HPI" rows="6" style="width: 100%;display: block">{{$HPI[0]->value}}</textarea>
                @endif
            </div>
        </div>
       </div>
        {{--Medical History--}}
        <div class="row">
            <div class="panel panel-default">
            <div class="panel-heading" style="background-color: lightblue">
               <a data-toggle="collapse" href="#medical_history">Medical History</a>
            </div>
            <div class="panel-body" id="medical_history" class="panel-collapse collapse">
                {{--Personal History--}}
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="bg-info">
                        <th colspan="2">Personal History- List of Diagnosis</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($diagnosis_list_personal_history as $diagnosis)
                            <tr>
                                <td colspan="2"><p><?php echo ($diagnosis->value); ?></p></td>
                            </tr>
                        @endforeach
                    <tr>
                        <td>
                            Comments:
                            <br>
                        @if(!count($personal_history_comment)>0)
                            <textarea rows="4" id="personal_history_comment" name="personal_history_comment" style="width: 100%;display: block"></textarea>
                        @else
                            <textarea rows="4" id="personal_history_comment" name="personal_history_comment" style="width: 100%;display: block">{{$personal_history_comment[0]->value}}</textarea>
                        @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
                {{--Family History--}}
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="bg-info">
                        <th colspan="6">Family History</th>
                    </tr>
                        <tr>
                            <th>Relation</th>
                            <th>Alive?</th>
                            <th>List of Diagnosis</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($family_members_details as $family_member_details)
                            <tr>
                                <td><p><?php echo ($family_member_details->relation); ?></p></td>
                                <td>
                                    @if(count($family_member_details->status)>0)
                                        <p><?php echo ($family_member_details->status[0]); ?></p>
                                    @endif
                                </td>
                                <td colspan="10">
                                    @foreach ($family_member_details->diagnosis as $family_member_diagnosis)
                                        <table>
                                            <tbody>
                                            <tr>
                                                <td>
                                                    <p><?php echo ($family_member_diagnosis); ?></p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    @endforeach
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td colspan="4">
                                Comments:
                                <br>
                            @if(!count($comment_family_history) > 0)
                                <textarea rows="4" id="family_history_comment" name="family_history_comment"style="width: 100%;display: block" ></textarea>
                            @else
                                <textarea rows="4" id="family_history_comment" name="family_history_comment"style="width: 100%;display: block" >{{$comment_family_history[0]}}</textarea>
                            @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
                {{--Surgical History --}}
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="bg-info">
                        <th colspan="2">Surgical History- List of Diagnosis</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($diagnosis_list_surgical_history as $diagnosis)
                            <tr>
                                <td colspan="2"><p><?php echo ($diagnosis->value); ?></p></td>
                            </tr>
                        @endforeach
                    <tr>
                        <td>
                            Comments:
                            <br>
                            @if(!count($surgical_history_comment)>0)
                                <textarea rows="4" id="surgical_history_comment" name="surgical_history_comment" style="width: 100%;display: block"></textarea>
                            @else
                                <textarea rows="4" id="surgical_history_comment" name="surgical_history_comment" style="width: 100%;display: block">{{$surgical_history_comment[0]->value}}</textarea>
                            @endif
                        </td>
                    </tr>
                    </tbody>
                </table>
                {{--Social History--}}
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="bg-info">
                        <th colspan="3">Social History</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td >
                            <label id="smoke_tobacco">Smoke Tobacco?: </label>
                        </td>
                        <td>
                            @if($social_history_smoke_tobacco == "YES")
                                <label id="smoke_tobacco">Yes </label>
                             @else
                                <label id="smoke_tobacco">No </label>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td >
                            <label id="non_smoke_tobacco">Non-Smoke Tobacco?: </label>
                        </td>
                        <td>
                            @if($social_history_non_smoke_tobacco == "YES")
                                <label id="non_smoke_tobacco">Yes </label>
                            @else
                                <label id="non_smoke_tobacco">No </label>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label id="alcohol">Drink Alcohol?: </label>
                        </td>
                        <td>
                            @if($social_history_alcohol == "YES")
                                <label id="alcohol">Yes </label>
                            @else
                                <label id="alcohol">No </label>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label id="sexual_activity">Sexual Activity?: </label>
                        </td>
                        <td>
                            @if($social_history_sexual_activity == "YES")
                                <label id="sexual_activity">Yes </label>
                            @else
                                <label id="sexual_activity">No </label>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td colspan="3">
                            <label id="social_history_comment_label">Comments: </label>
                            <br>
                            <textarea rows="4" style="width: 100%;display: block" id="social_history_comment" name="social_history_comment" >{{$social_history_comment}}</textarea>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        </div>
        {{--Medications--}}
        <div class="row">
            <div class="panel panel-default">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr class="bg-info">
                        <th colspan="2">
                            <a data-toggle="collapse" href="#medications">List of Medications</a>
                        </th>
                    </tr>
                    </thead>
                    <tbody  id="medications" class="panel-collapse collapse">
                    @foreach ($medications as $medicine)
                        <tr>
                            {{$medicine->value}}<br>
                        </tr>
                    @endforeach
                        <tr>
                            <td>
                                Comments:
                                <br>
                            @if(!count($medication_comment)>0)
                                <textarea rows="4" id="medication_comment" name="medication_comment" style="width: 100%;display: block"></textarea>
                            @else
                                <textarea rows="4" id="medication_comment" name="medication_comment" style="width: 100%;display: block">{{$medication_comment[0]->value}}</textarea>
                            @endif
                            </td>
                        </tr>
                    </tbody>
                 </table>
            </div>
        </div>
        {{--Vital signs--}}
        <div class="row">
            <div class="panel panel-default">
            <table class="table table-striped table-bordered table-hover" id="vital_signs_table">
            <thead>
            <tr>
                <th style="background-color: lightblue" colspan="12">
                   <a data-toggle="collapse" href="#vital_signs">Vital Signs</a>
                </th>
            </tr>
                <tr class="bg-info">
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
                </tr>
            </thead>
            <tbody id="vital_signs" class="panel-collapse collapse">
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
                        <td>
                            {{ $vs->timestamp }}
                        </td>
                        <td>
                            @if(count($vs->BP_Systolic)>0)
                                {{ $vs->BP_Systolic[0] }}
                            @endif
                        </td>
                        <td>
                            @if(count($vs->BP_Diastolic)>0)
                                {{$vs->BP_Diastolic[0]}}
                            @endif
                        </td>
                        <td>
                            @if(count($vs->Heart_Rate)>0)
                                {{$vs->Heart_Rate[0]}}
                            @endif
                        </td>
                        <td>
                            @if(count($vs->Respiratory_Rate)>0)
                                {{$vs->Respiratory_Rate[0]}}
                            @endif
                        </td>
                        <td>
                            @if(count($vs->Temperature)>0)
                                {{$vs->Temperature[0]}}
                            @endif
                        </td>
                        <td>
                            @if(count($vs->Weight)>0)
                                {{$vs->Weight[0]}}
                            @endif
                        </td>
                        <td>
                            @if(count($vs->Height)>0)
                                {{$vs->Height[0]}}
                            @endif
                        </td>
                        <td>
                            @if(count($vs->Pain)>0)
                                {{$vs->Pain[0]}}
                            @endif
                        </td>
                        <td>
                            @if(count($vs->Oxygen_Saturation)>0)
                                {{$vs->Oxygen_Saturation[0]}}
                            @endif
                        </td>
                        <td>
                            @if(count($vs->Comment)>0)
                                {{$vs->Comment[0]}}
                            @endif
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
        </div>
        </div>
        {{--ROS--}}
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: lightblue">
                    <a data-toggle="collapse" href="#ros">ROS</a>
                </div>
                <div class="panel-body" id="ros" class="panel-collapse collapse">
                    {{--ros_constitutional--}}
                    <div class="container-fluid" id="constitutional">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                                <p style="margin-top: 0">ROS- Constitutional</p>
                            </div>
                            <div class="panel-body">
                                <br>
                                <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <tbody>
                                                    @foreach ($ros_constitutional_symptoms as $ros_constitutional_symptom)
                                                        <tr>
                                                            <td>
                                                                @if($ros_constitutional_symptom->is_saved)
                                                                    <input
                                                                            type="checkbox"
                                                                            name="$ros_constitutional_symptoms[]"
                                                                            value="{{$ros_constitutional_symptom->value}}"
                                                                            id="{{$ros_constitutional_symptom->value}}" checked>
                                                                @else
                                                                    <input
                                                                            type="checkbox"
                                                                            name="$ros_constitutional_symptoms[]"
                                                                            value="{{$ros_constitutional_symptom->value}}"
                                                                            id="{{$ros_constitutional_symptom->value}}">

                                                                @endif
                                                                {{$ros_constitutional_symptom->value}}
                                                                <br>
                                                                <br>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Comment box -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="Comment"> Comments:</label>
                                                <br>
                                                @if(!count($ros_constitutional_comment)>0)
                                                    <textarea rows="4" id="ros_constitutional_comment" name="ros_constitutional_comment" style="width: 100%;display: block"></textarea>
                                                @else
                                                    <textarea rows="4" id="ros_constitutional_comment" name="ros_constitutional_comment" style="width: 100%;display: block">{{$ros_constitutional_comment[0]}}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                      </div>
                              </div>
                        </div>
                    </div>
                    <hr style="border:solid">
                    {{--ros_hent--}}
                    <div class="container-fluid" id="hent">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                                <p style="margin-top: 0">ROS- HENT</p>
                            </div>
                            <div class="panel-body">
                                <br>
                                <div class="row">
                                    <div class="col-md-12 ">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <tbody>
                                                    @foreach ($ros_hent_symptoms as $ros_hent_symptom)
                                                        <tr>
                                                            <td>
                                                                @if($ros_hent_symptom->is_saved)
                                                                    <input
                                                                            type="checkbox"
                                                                            name="$ros_hent_symptoms[]"
                                                                            value="{{$ros_hent_symptom->value}}"
                                                                            id="{{$ros_hent_symptom->value}}" checked>
                                                                @else
                                                                    <input
                                                                            type="checkbox"
                                                                            name="$ros_hent_symptoms[]"
                                                                            value="{{$ros_hent_symptom->value}}"
                                                                            id="{{$ros_hent_symptom->value}}">

                                                                @endif
                                                                {{$ros_hent_symptom->value}}
                                                                <br>
                                                                <br>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                </div>
                                <!-- Comment box -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <label for="Comment"> Comments:</label>
                                        <br>
                                        @if(!count($ros_hent_comment)>0)
                                            <textarea rows="4" id="ros_hent_comment" name="ros_hent_comment" style="width: 100%;display: block"></textarea>
                                        @else
                                            <textarea rows="4" id="ros_hent_comment" name="ros_hent_comment" style="width: 100%;display: block">{{$ros_hent_comment[0]}}</textarea>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="border:solid">
                    {{--ros_eyes--}}
                    <div class="container-fluid" id="eyes">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                                <p style="margin-top: 0">ROS- Eyes</p>
                            </div>
                            <div class="panel-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tbody>
                                                @foreach ($ros_eyes_symptoms as $ros_eyes_symptom)
                                                    <tr>
                                                        <td>
                                                            @if($ros_eyes_symptom->is_saved)
                                                                <input
                                                                        type="checkbox"
                                                                        name="$ros_eyes_symptoms[]"
                                                                        value="{{$ros_eyes_symptom->value}}"
                                                                        id="{{$ros_eyes_symptom->value}}" checked>
                                                            @else
                                                                <input
                                                                        type="checkbox"
                                                                        name="$ros_eyes_symptoms[]"
                                                                        value="{{$ros_eyes_symptom->value}}"
                                                                        id="{{$ros_eyes_symptom->value}}">

                                                            @endif
                                                            {{$ros_eyes_symptom->value}}
                                                            <br>
                                                            <br>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- Comment box -->
                                    <div class="row">
                                            <div class="col-md-12">
                                                <label for="Comment"> Comments:</label>
                                                <br>
                                                @if(!count($ros_eyes_comment)>0)
                                                    <textarea rows="4" id="ros_eyes_comment" name="ros_eyes_comment" style="width: 100%;display: block"></textarea>
                                                @else
                                                    <textarea rows="4" id="ros_eyes_comment" name="ros_eyes_comment" style="width: 100%;display: block">{{$ros_eyes_comment[0]}}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="border:solid">
                    {{--ros_respiratory--}}
                    <div class="container-fluid" id="respiratory">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                                <p style="margin-top: 0">ROS- Respiratory</p>
                            </div>
                            <div class="panel-body">
                                <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <tbody>
                                                    @foreach ($ros_respiratory_symptoms as $ros_respiratory_symptom)
                                                        <tr>
                                                            <td>
                                                                @if($ros_respiratory_symptom->is_saved)
                                                                    <input
                                                                            type="checkbox"
                                                                            name="$ros_respiratory_symptoms[]"
                                                                            value="{{$ros_respiratory_symptom->value}}"
                                                                            id="{{$ros_respiratory_symptom->value}}" checked>
                                                                @else
                                                                    <input
                                                                            type="checkbox"
                                                                            name="$ros_respiratory_symptoms[]"
                                                                            value="{{$ros_respiratory_symptom->value}}"
                                                                            id="{{$ros_respiratory_symptom->value}}">

                                                                @endif
                                                                {{$ros_respiratory_symptom->value}}
                                                                <br>
                                                                <br>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Comment box -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="Comment"> Comments:</label>
                                                <br>
                                                @if(!count($ros_respiratory_comment)>0)
                                                    <textarea rows="4" id="ros_respiratory_comment" name="ros_respiratory_comment" style="width: 100%;display: block"></textarea>
                                                @else
                                                    <textarea rows="4" id="ros_respiratory_comment" name="ros_respiratory_comment" style="width: 100%;display: block">{{$ros_respiratory_comment[0]}}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="border:solid">
                     {{--ros_cardiovascular--}}
                    <div class="container-fluid" id="cardiovascular">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                                <p style="margin-top: 0">ROS- Cardiovascular</p>
                            </div>
                            <div class="panel-body">
                                <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <tbody>
                                                    @foreach ($ros_cardiovascular_symptoms as $ros_cardiovascular_symptom)
                                                        <tr>
                                                            <td>
                                                                @if($ros_cardiovascular_symptom->is_saved)
                                                                    <input
                                                                            type="checkbox"
                                                                            name="$ros_cardiovascular_symptoms[]"
                                                                            value="{{$ros_cardiovascular_symptom->value}}"
                                                                            id="{{$ros_cardiovascular_symptom->value}}" checked>
                                                                @else
                                                                    <input
                                                                            type="checkbox"
                                                                            name="$ros_cardiovascular_symptoms[]"
                                                                            value="{{$ros_cardiovascular_symptom->value}}"
                                                                            id="{{$ros_cardiovascular_symptom->value}}">

                                                                @endif
                                                                {{$ros_cardiovascular_symptom->value}}
                                                                <br>
                                                                <br>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Comment box -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="Comment"> Comments:</label>
                                                <br>
                                                @if(!count($ros_cardiovascular_comment)>0)
                                                    <textarea rows="4" id="ros_cardiovascular_comment" name="ros_cardiovascular_comment" style="width: 100%;display: block"></textarea>
                                                @else
                                                    <textarea rows="4" id="ros_cardiovascular_comment" name="ros_cardiovascular_comment" style="width: 100%;display: block">{{$ros_cardiovascular_comment[0]}}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr style="border:solid">
                    {{--ros_musculosketal--}}
                    <div class="container-fluid" id="musculoskeletal">
                        <div class="panel panel-default">
                        <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                            <p style="margin-top: 0">ROS- Musculoskeletal</p>
                        </div>
                        <div class="panel-body">
                             <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 ">
                                         <table class="table table-striped table-bordered table-hover">
                                            <tbody>
                                            @foreach ($ros_musculoskeletal_symptoms as $ros_musculoskeletal_symptom)
                                                <tr>
                                                    <td>
                                                        @if($ros_musculoskeletal_symptom->is_saved)
                                                            <input
                                                                    type="checkbox"
                                                                    name="$ros_musculoskeletal_symptoms[]"
                                                                    value="{{$ros_musculoskeletal_symptom->value}}"
                                                                    id="{{$ros_musculoskeletal_symptom->value}}" checked>
                                                        @else
                                                            <input
                                                                    type="checkbox"
                                                                    name="$ros_musculoskeletal_symptoms[]"
                                                                    value="{{$ros_musculoskeletal_symptom->value}}"
                                                                    id="{{$ros_musculoskeletal_symptom->value}}">

                                                        @endif
                                                        {{$ros_musculoskeletal_symptom->value}}
                                                        <br>
                                                        <br>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Comment box -->
                                <div class="row">
                                            <div class="col-md-12">
                                                <label for="Comment"> Comments:</label>
                                                <br>
                                                @if(!count($ros_musculoskeletal_comment)>0)
                                                    <textarea rows="4" id="ros_musculoskeletal_comment" name="ros_musculoskeletal_comment" style="width: 100%;display: block"></textarea>
                                                @else
                                                    <textarea rows="4" id="ros_musculoskeletal_comment" name="ros_musculoskeletal_comment" style="width: 100%;display: block">{{$ros_musculoskeletal_comment[0]}}</textarea>
                                                @endif
                                            </div>
                                        </div>
                             </div>
                         </div>
                    </div>
                    </div>
                    <hr style="border:solid">
                     {{--ros_integumentary--}}
                    <div class="container-fluid" id="integumentary">
                        <div class="panel panel-default">
                        <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                            <p style="margin-top: 0">ROS- Integumentary</p>
                        </div>
                        <div class="panel-body">
                           <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 ">
                                   <table class="table table-striped table-bordered table-hover">
                                        <tbody>
                                        @foreach ($ros_integumentary_symptoms as $ros_integumentary_symptom)
                                            <tr>
                                                <td>
                                                    @if($ros_integumentary_symptom->is_saved)
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_integumentary_symptoms[]"
                                                                value="{{$ros_integumentary_symptom->value}}"
                                                                id="{{$ros_integumentary_symptom->value}}" checked>
                                                    @else
                                                        <input
                                                                type="checkbox"
                                                                name="$ros_integumentary_symptoms[]"
                                                                value="{{$ros_integumentary_symptom->value}}"
                                                                id="{{$ros_integumentary_symptom->value}}">

                                                    @endif
                                                    {{$ros_integumentary_symptom->value}}
                                                    <br>
                                                    <br>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- Comment box -->
                            <div class="row">
                                        <div class="col-md-12">
                                            <label for="Comment"> Comments:</label>
                                            <br>
                                            @if(!count($ros_integumentary_comment)>0)
                                                <textarea rows="4" id="ros_integumentary_comment" name="ros_integumentary_comment" style="width: 100%;display: block"></textarea>
                                            @else
                                                <textarea rows="4" id="ros_integumentary_comment" name="ros_integumentary_comment" style="width: 100%;display: block">{{$ros_integumentary_comment[0]}}</textarea>
                                            @endif
                                        </div>
                                    </div>
                           </div>
                        </div>
                    </div>
                    </div>
                    <hr style="border:solid">
                    {{--ros_neurological--}}
                    <div class="container-fluid" id="neurological">
                        <div class="panel panel-default">
                        <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                            <p style="margin-top: 0">ROS- Neurological</p>
                        </div>
                        <div class="panel-body">
                            <div class="container-fluid">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <table class="table table-striped table-bordered table-hover">
                                            <tbody>
                                            @foreach ($ros_neurological_symptoms as $ros_neurological_symptom)
                                                <tr>
                                                    <td>
                                                        @if($ros_neurological_symptom->is_saved)
                                                            <input
                                                                    type="checkbox"
                                                                    name="$ros_neurological_symptoms[]"
                                                                    value="{{$ros_neurological_symptom->value}}"
                                                                    id="{{$ros_neurological_symptom->value}}" checked>
                                                        @else
                                                            <input
                                                                    type="checkbox"
                                                                    name="$ros_neurological_symptoms[]"
                                                                    value="{{$ros_neurological_symptom->value}}"
                                                                    id="{{$ros_neurological_symptom->value}}">

                                                        @endif
                                                        {{$ros_neurological_symptom->value}}
                                                        <br>
                                                        <br>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <!-- Comment box -->
                                <div class="row">
                                        <div class="col-md-12">
                                            <label for="Comment"> Comments:</label>
                                            <br>
                                            @if(!count($ros_neurological_comment)>0)
                                                <textarea rows="4" id="ros_neurological_comment" name="ros_neurological_comment" style="width: 100%;display: block"></textarea>
                                            @else
                                                <textarea rows="4" id="ros_neurological_comment" name="ros_neurological_comment" style="width: 100%;display: block">{{$ros_neurological_comment[0]}}</textarea>
                                            @endif
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <hr style="border:solid">
                    {{--ros_psychological--}}
                    <div class="container-fluid" id="psychological">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                                <p style="margin-top: 0">ROS- Psychological</p>
                            </div>
                            <div class="panel-body">
                               <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tbody>
                                                @foreach ($ros_psychological_symptoms as $ros_psychological_symptom)
                                                    <tr>
                                                        <td>
                                                            @if($ros_psychological_symptom->is_saved)
                                                                <input
                                                                        type="checkbox"
                                                                        name="$ros_psychological_symptoms[]"
                                                                        value="{{$ros_psychological_symptom->value}}"
                                                                        id="{{$ros_psychological_symptom->value}}" checked>
                                                            @else
                                                                <input
                                                                        type="checkbox"
                                                                        name="$ros_psychological_symptoms[]"
                                                                        value="{{$ros_psychological_symptom->value}}"
                                                                        id="{{$ros_psychological_symptom->value}}">

                                                            @endif
                                                            {{$ros_psychological_symptom->value}}
                                                            <br>
                                                            <br>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- Comment box -->
                                    <div class="row">
                                            <div class="col-md-12">
                                                <label for="Comment"> Comments:</label>
                                                <br>
                                                @if(!count($ros_psychological_comment)>0)
                                                    <textarea rows="4" id="ros_psychological_comment" name="ros_psychological_comment" style="width: 100%;display: block"></textarea>
                                                @else
                                                    <textarea rows="4" id="ros_psychological_comment" name="ros_psychological_comment" style="width: 100%;display: block">{{$ros_psychological_comment[0]}}</textarea>
                                                @endif
                                            </div>
                                        </div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <hr style="border:solid">
        </div>
            </div>
        </div>
        {{--PE--}}
        <div class="row">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: lightblue">
                    <a data-toggle="collapse" href="#pe">PE- Physical Exams</a>
                </div>
                <div class="panel-body" id="pe" class="panel-collapse collapse">
                    {{--Constitutional--}}
                    <div class="container-fluid" id="constitutional">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                                <p style="margin-top: 0">Physical Exam- Constitutional</p>
                            </div>
                            <div class="panel-body">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <tbody>
                                                    @foreach ($constitutional_symptoms as $constitutional_symptom)
                                                        <tr>
                                                            <td>
                                                                @if($constitutional_symptom->is_saved)
                                                                    <input
                                                                            type="checkbox"
                                                                            name="$constitutional_symptoms[]"
                                                                            value="{{$constitutional_symptom->value}}"
                                                                            id="{{$constitutional_symptom->value}}" checked>
                                                                @else
                                                                    <input
                                                                            type="checkbox"
                                                                            name="$constitutional_symptoms[]"
                                                                            value="{{$constitutional_symptom->value}}"
                                                                            id="{{$constitutional_symptom->value}}">

                                                                @endif
                                                                {{$constitutional_symptom->value}}
                                                                <br>
                                                                <br>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Comment box -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="Comment"> Comments:</label>
                                                <br>
                                                @if(!count($constitutional_comment)>0)
                                                    <textarea rows="4" id="constitutional_comment" name="constitutional_comment" style="width: 100%;display: block"></textarea>
                                                @else
                                                    <textarea rows="4" id="constitutional_comment" name="constitutional_comment" style="width: 100%;display: block">{{$constitutional_comment[0]}}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                               </div>
                        </div>
                    </div>
                    <hr style="border:solid">
                    {{--HENT--}}
                    <div class="container-fluid" id="hent">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                                <p style="margin-top: 0">Physical Exam- HENT</p>
                            </div>
                            <div class="panel-body">
                               <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tbody>
                                                @foreach ($HENT_symptoms as $HENT_symptom)
                                                    <tr>
                                                        <td>
                                                            @if($HENT_symptom->is_saved)
                                                                <input
                                                                        type="checkbox"
                                                                        name="$HENT_symptoms[]"
                                                                        value="{{$HENT_symptom->value}}"
                                                                        id="{{$HENT_symptom->value}}" checked>
                                                            @else
                                                                <input
                                                                        type="checkbox"
                                                                        name="$HENT_symptoms[]"
                                                                        value="{{$HENT_symptom->value}}"
                                                                        id="{{$HENT_symptom->value}}">

                                                            @endif
                                                            {{$HENT_symptom->value}}
                                                            <br>
                                                            <br>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- Comment box -->
                                    <div class="row">
                                            <div class="col-md-12">
                                                <label for="Comment"> Comments:</label>
                                                <br>
                                                @if(!count($HENT_comment)>0)
                                                    <textarea rows="4" id="HENT_comment" name="HENT_comment" style="width: 100%;display: block"></textarea>
                                                @else
                                                    <textarea rows="4" id="HENT_comment" name="HENT_comment" style="width: 100%;display: block">{{$HENT_comment[0]}}</textarea>
                                                @endif
                                            </div>
                                        </div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <hr style="border:solid">
                    {{--Eyes--}}
                    <div class="container-fluid" id="eyes">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                                <p style="margin-top: 0">Physical Exam- Eyes</p>
                            </div>
                            <div class="panel-body">
                                <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <tbody>
                                                    @foreach ($eyes_symptoms as $eyes_symptom)
                                                        <tr>
                                                            <td>
                                                                @if($eyes_symptom->is_saved)
                                                                    <input
                                                                            type="checkbox"
                                                                            name="$eyes_symptoms[]"
                                                                            value="{{$eyes_symptom->value}}"
                                                                            id="{{$eyes_symptom->value}}" checked>
                                                                @else
                                                                    <input
                                                                            type="checkbox"
                                                                            name="$eyes_symptoms[]"
                                                                            value="{{$eyes_symptom->value}}"
                                                                            id="{{$eyes_symptom->value}}">

                                                                @endif
                                                                {{$eyes_symptom->value}}
                                                                <br>
                                                                <br>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Comment box -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="Comment"> Comments:</label>
                                                <br>
                                                @if(!count($eyes_comment)>0)
                                                    <textarea rows="4" id="eyes_comment" name="eyes_comment" style="width: 100%;display: block"></textarea>
                                                @else
                                                    <textarea rows="4" id="eyes_comment" name="eyes_comment" style="width: 100%;display: block">{{$eyes_comment[0]}}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <hr style="border:solid">
                    {{--Respiratory--}}
                    <div class="container-fluid" id="respiratory">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                                <p style="margin-top: 0">Physical Exam- Respiratory</p>
                            </div>
                            <div class="panel-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tbody>
                                                @foreach ($respiratory_symptoms as $respiratory_symptom)
                                                    <tr>
                                                        <td>
                                                            @if($respiratory_symptom->is_saved)
                                                                <input
                                                                        type="checkbox"
                                                                        name="$respiratory_symptoms[]"
                                                                        value="{{$respiratory_symptom->value}}"
                                                                        id="{{$respiratory_symptom->value}}" checked>
                                                            @else
                                                                <input
                                                                        type="checkbox"
                                                                        name="$respiratory_symptoms[]"
                                                                        value="{{$respiratory_symptom->value}}"
                                                                        id="{{$respiratory_symptom->value}}">

                                                            @endif
                                                            {{$respiratory_symptom->value}}
                                                            <br>
                                                            <br>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- Comment box -->
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="Comment"> Comments:</label>
                                            <br>
                                            @if(!count($respiratory_comment)>0)
                                                <textarea rows="4" id="respiratory_comment" name="respiratory_comment" style="width: 100%;display: block"></textarea>
                                            @else
                                                <textarea rows="4" id="respiratory_comment" name="respiratory_comment" style="width: 100%;display: block">{{$respiratory_comment[0]}}</textarea>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <hr style="border:solid">
                    {{--Cardiovascular--}}
                    <div class="container-fluid" id="cardiovascular">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                                <p style="margin-top: 0">Physical Exam- Cardiovascular</p>
                            </div>
                            <div class="panel-body">
                               <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tbody>
                                                @foreach ($cardiovascular_symptoms as $cardiovascular_symptom)
                                                    <tr>
                                                        <td>
                                                            @if($cardiovascular_symptom->is_saved)
                                                                <input
                                                                        type="checkbox"
                                                                        name="$cardiovascular_symptoms[]"
                                                                        value="{{$cardiovascular_symptom->value}}"
                                                                        id="{{$cardiovascular_symptom->value}}" checked>
                                                            @else
                                                                <input
                                                                        type="checkbox"
                                                                        name="$cardiovascular_symptoms[]"
                                                                        value="{{$cardiovascular_symptom->value}}"
                                                                        id="{{$cardiovascular_symptom->value}}">

                                                            @endif
                                                            {{$cardiovascular_symptom->value}}
                                                            <br>
                                                            <br>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- Comment box -->
                                    <div class="row">
                                            <div class="col-md-12">
                                                <label for="Comment"> Comments:</label>
                                                <br>
                                                @if(!count($cardiovascular_comment)>0)
                                                    <textarea rows="4" id="cardiovascular_comment" name="cardiovascular_comment" style="width: 100%;display: block"></textarea>
                                                @else
                                                    <textarea rows="4" id="cardiovascular_comment" name="cardiovascular_comment" style="width: 100%;display: block">{{$cardiovascular_comment[0]}}</textarea>
                                                @endif
                                            </div>
                                        </div>
                               </div>
                            </div>
                        </div>
                    </div>
                    <hr style="border:solid">
                    {{--Musculoskeletal--}}
                    <div class="container-fluid" id="musculoskeletal">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                                <p style="margin-top: 0">Physical Exam- Musculoskeletal</p>
                            </div>
                            <div class="panel-body">
                                 <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tbody>
                                                @foreach ($musculoskeletal_symptoms as $musculoskeletal_symptom)
                                                    <tr>
                                                        <td>
                                                            @if($musculoskeletal_symptom->is_saved)
                                                                <input
                                                                        type="checkbox"
                                                                        name="$musculoskeletal_symptoms[]"
                                                                        value="{{$musculoskeletal_symptom->value}}"
                                                                        id="{{$musculoskeletal_symptom->value}}" checked>
                                                            @else
                                                                <input
                                                                        type="checkbox"
                                                                        name="$musculoskeletal_symptoms[]"
                                                                        value="{{$musculoskeletal_symptom->value}}"
                                                                        id="{{$musculoskeletal_symptom->value}}">

                                                            @endif
                                                            {{$musculoskeletal_symptom->value}}
                                                            <br>
                                                            <br>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- Comment box -->
                                    <div class="row">
                                            <div class="col-md-12">
                                                <label for="Comment"> Comments:</label>
                                                <br>
                                                @if(!count($musculoskeletal_comment)>0)
                                                    <textarea rows="4" id="musculoskeletal_comment" name="musculoskeletal_comment" style="width: 100%;display: block"></textarea>
                                                @else
                                                    <textarea rows="4" id="musculoskeletal_comment" name="musculoskeletal_comment" style="width: 100%;display: block">{{$musculoskeletal_comment[0]}}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <hr style="border:solid">
                    {{--Integumentary--}}
                    <div class="container-fluid" id="integumentary">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                                <p style="margin-top: 0">Physical Exam- Integumentary</p>
                            </div>
                            <div class="panel-body">
                                <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <tbody>
                                                    @foreach ($integumentary_symptoms as $integumentary_symptom)
                                                        <tr>
                                                            <td>
                                                                @if($integumentary_symptom->is_saved)
                                                                    <input
                                                                            type="checkbox"
                                                                            name="$integumentary_symptoms[]"
                                                                            value="{{$integumentary_symptom->value}}"
                                                                            id="{{$integumentary_symptom->value}}" checked>
                                                                @else
                                                                    <input
                                                                            type="checkbox"
                                                                            name="$integumentary_symptoms[]"
                                                                            value="{{$integumentary_symptom->value}}"
                                                                            id="{{$integumentary_symptom->value}}">

                                                                @endif
                                                                {{$integumentary_symptom->value}}
                                                                <br>
                                                                <br>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Comment box -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="Comment"> Comments:</label>
                                                <br>
                                                @if(!count($integumentary_comment)>0)
                                                    <textarea rows="4" id="integumentary_comment" name="integumentary_comment" style="width: 100%;display: block"></textarea>
                                                @else
                                                    <textarea rows="4" id="integumentary_comment" name="integumentary_comment" style="width: 100%;display: block">{{$integumentary_comment[0]}}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <hr style="border:solid">
                    {{--Neurological--}}
                    <div class="container-fluid" id="neurological">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                                <p style="margin-top: 0">Physical Exam- Neurological</p>
                            </div>
                            <div class="panel-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-12 ">
                                            <table class="table table-striped table-bordered table-hover">
                                                <tbody>
                                                @foreach ($neurological_symptoms as $neurological_symptom)
                                                    <tr>
                                                        <td>
                                                            @if($neurological_symptom->is_saved)
                                                                <input
                                                                        type="checkbox"
                                                                        name="$neurological_symptoms[]"
                                                                        value="{{$neurological_symptom->value}}"
                                                                        id="{{$neurological_symptom->value}}" checked>
                                                            @else
                                                                <input
                                                                        type="checkbox"
                                                                        name="$neurological_symptoms[]"
                                                                        value="{{$neurological_symptom->value}}"
                                                                        id="{{$neurological_symptom->value}}">

                                                            @endif
                                                            {{$neurological_symptom->value}}
                                                            <br>
                                                            <br>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!-- Comment box -->
                                    <div class="row">
                                            <div class="col-md-12">
                                                <label for="Comment"> Comments:</label>
                                                <br>
                                                @if(!count($neurological_comment)>0)
                                                    <textarea rows="4" id="neurological_comment" name="neurological_comment" style="width: 100%;display: block"></textarea>
                                                @else
                                                    <textarea rows="4" id="neurological_comment" name="neurological_comment" style="width: 100%;display: block">{{$neurological_comment[0]}}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                    <hr style="border:solid">
                    {{--Psychological--}}
                    <div class="container-fluid" id="psychological">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                                <p style="margin-top: 0">Physical Exam- Psychological</p>
                            </div>
                            <div class="panel-body">
                                <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                <table class="table table-striped table-bordered table-hover">
                                                    <tbody>
                                                    @foreach ($psychological_symptoms as $psychological_symptom)
                                                        <tr>
                                                            <td>
                                                                @if($psychological_symptom->is_saved)
                                                                    <input
                                                                            type="checkbox"
                                                                            name="$psychological_symptoms[]"
                                                                            value="{{$psychological_symptom->value}}"
                                                                            id="{{$psychological_symptom->value}}" checked>
                                                                @else
                                                                    <input
                                                                            type="checkbox"
                                                                            name="$psychological_symptoms[]"
                                                                            value="{{$psychological_symptom->value}}"
                                                                            id="{{$psychological_symptom->value}}">

                                                                @endif
                                                                {{$psychological_symptom->value}}
                                                                <br>
                                                                <br>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- Comment box -->
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="Comment"> Comments:</label>
                                                <br>
                                                @if(!count($psychological_comment)>0)
                                                    <textarea rows="4" id="psychological_comment" name="psychological_comment" style="width: 100%;display: block"></textarea>
                                                @else
                                                    <textarea rows="4" id="psychological_comment" name="psychological_comment" style="width: 100%;display: block">{{$psychological_comment[0]}}</textarea>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                    <hr style="border:solid">
        </div>
            </div>
        </div>
        {{--Orders--}}
        <div class="row">
            <div class="panel panel-default">
            <div class="panel-heading" style="background-color: lightblue">
                <a data-toggle="collapse" href="#orders">Orders</a>
            </div>
            <div class="panel-body" id="orders" class="panel-collapse collapse">
                <div class="row">
                    <div class="col-sm-6">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="bg-info">
                                <th>List of labs</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($labs as $lab)
                                <tr>
                                    <td><p>{{$lab->value}}</p></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <table class="table table-striped table-bordered table-hover">
                            <thead>
                            <tr class="bg-info">
                                <th>List of Images</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($images as $image)
                                <tr>
                                    <td><p>{{$image->value}}</p></td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        Comments:
                        <br>
                        @if(!count($comment_order)>0)
                            <textarea rows="4" id="orders_comment" name="orders_comment"style="width: 100%;display: block" ></textarea>
                        @else
                            <textarea rows="4" id="orders_comment" name="orders_comment"style="width: 100%;display: block">{{$comment_order[0]->value}}</textarea>
                        @endif

                </div>
            </div>
        </div>
    </div>
        </div>
        {{--Results--}}
        <div class="row">
            <div class="panel panel-default">
        <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
            <a data-toggle="collapse" href="#results">Results</a>
        </div>
        <div class="panel-body " id="results" class="panel-collapse collapse">
            <div class="container-fluid">
                @if(!count($results)>0)
                    <textarea id="results" name="results" rows="6" style="width: 100%;display: block"></textarea>
                @else
                    <textarea id="results" name="results" rows="6" style="width: 100%;display: block">{{$results[0]->value}}</textarea>
                @endif
            </div>
        </div>
    </div>
        </div>
    </div>
</body>
</html>
