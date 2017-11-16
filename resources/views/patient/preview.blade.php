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
    <!--This is a container for vital signs header -->
    <div class="row" >
        <div class="panel-heading">
                <div class="row">
                    <div class="col-md-3">
                        <label style="float: left">Submitted to-</label>
                            @foreach ($instructor_Details as $key=>$instructor_Detail)
                                @if(count($instructor_Detail)>0)
                                    <p>{{ $instructor_Detail[0]->firstname}} {{ $instructor_Detail[0]->lastname}}</p>
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
                        <p id="name_label" style="align-self: center"><strong>Name:</strong>
                            {{$vital_signs_header->name}}
                        </p>
                    </td>
                    <td style="padding-top: 0;padding-bottom: 0%">
                        <p id="age_label"><strong>Age: </strong>
                            {{$vital_signs_header->age}}
                        </p>
                    </td>
                    <td style="padding-top: 0;padding-bottom: 0%">
                        <p id="sex_label"><strong>Sex: </strong>
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
    <br>
    {{--HPI--}}
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: lightblue">
           <a data-toggle="collapse" href="#HPI">HPI</a>
        </div>
        <div class="panel-body" id="HPI" class="panel-collapse collapse">
            @if(!count($HPI)>0)
                <textarea id="HPI" name="HPI" rows="6" cols="50" >
                </textarea>
            @else
                <textarea id="HPI" name="HPI" rows="6" >
                                            {{$HPI[0]->value}}
                </textarea>
            @endif
        </div>
    </div>
    {{--Medical History--}}
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: lightblue">
            Medical History
        </div>
        <div class="panel-body">
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
                    </td>
                    <td>
                    @if(!count($personal_history_comment)>0)
                        <textarea rows="4" id="personal_history_comment" name="personal_history_comment" style="width: 575px">
                                             </textarea>
                    @else
                        <textarea rows="4" id="personal_history_comment" name="personal_history_comment" style="width: 575px">
                                        {{$personal_history_comment[0]->value}}</textarea>
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
                        <td>
                            Comments:
                        </td>
                        <td colspan="4">
                        @if(!count($comment_family_history) > 0)
                            <textarea rows="4" id="family_history_comment" name="family_history_comment" style="width: 600px" >
                            </textarea>
                        @else
                            <textarea rows="4" id="family_history_comment" name="family_history_comment" style="width: 600px" >
                                {{$comment_family_history[0]}}</textarea>
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
                    </td>
                    <td>
                        @if(!count($surgical_history_comment)>0)
                            <textarea rows="4" id="surgical_history_comment" name="surgical_history_comment" style="width: 575px">
                                                     </textarea>
                        @else
                            <textarea rows="4" id="surgical_history_comment" name="surgical_history_comment" style="width: 575px">
                                                {{$surgical_history_comment[0]->value}}</textarea>
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
                    <td colspan="2">
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
                    <td colspan="2">
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
                    <td colspan="2">
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
                    <td colspan="2">
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
                    <td colspan="2">
                        <label id="social_history_comment_label">Comments: </label>
                    </td>
                    <td>
                        <textarea rows="4" style="width: 525px" id="social_history_comment" name="social_history_comment" >
                            {{$social_history_comment}}
                        </textarea>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    {{--Medications--}}
    <table class="table table-striped table-bordered table-hover">
        <thead>
        <tr class="bg-info">
            <th colspan="2">List of Medicines</th>
        </tr>
        </thead>
        <tbody>
            @foreach ($medications as $medicine)
                <tr>
                    <td><p>{{$medicine->value}}</p></td>
                </tr>
            @endforeach
            <tr>
                <td>
                    Comments:
                </td>
                <td>
                @if(!count($medication_comment)>0)
                    <textarea rows="4" id="medication_comment" name="medication_comment" style="width: 590px">
                                     </textarea>
                @else
                    <textarea rows="4" id="medication_comment" name="medication_comment" style="width: 590px">
                                {{$medication_comment[0]->value}}</textarea>
                @endif
                </td>
            </tr>
        </tbody>
    </table>
    {{--Vital signs--}}
    <table class="table table-striped table-bordered table-hover" id="vital_signs_table">
        <thead>
        <tr>
            <th style="background-color: lightblue" colspan="12">
                Vital Signs
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
    {{--Orders--}}
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: lightblue">
            <h4>Orders</h4>
        </div>
        <div class="panel-body">
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
                <div class="col-md-1">
                        Comments:
                </div>
                <div class="col-md-11">
                    @if(!count($comment_order)>0)
                        <textarea rows="4" id="orders_comment" name="orders_comment" style="width: 600px" >
                        </textarea>
                    @else
                        <textarea rows="4" id="orders_comment" name="orders_comment" style="width: 600px">
                    {{$comment_order[0]->value}}</textarea>
                    @endif

            </div>
        </div>
    </div>
</div>
    {{--Results--}}
    <div class="panel panel-default">
        <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
            <h4>Results</h4>
        </div>
        <div class="panel-body ">
            <div class="container-fluid">
                @if(!count($results)>0)
                    <textarea id="results" name="results" rows="6" style="width: 700px">
                    </textarea>
                @else
                    <textarea id="results" name="results" rows="6" style="width: 700px">
                        {{$results[0]->value}}
                    </textarea>
                @endif
            </div>
        </div>
    </div>

</body>
</html>
