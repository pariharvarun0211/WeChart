@extends('patient.active_record')

@section('documentation_panel')

    @if(in_array("20", $navIds))
        {{--Constitutional--}}
        <div class="container-fluid" id="constitutional">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                    <h4 style="margin-top: 0">Physical Exam- Constitutional</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('Constitutional') }}" id="Constitutional_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
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
                                        <textarea rows="4" id="constitutional_comment" name="constitutional_comment" style="width: 575px">
                                            </textarea>
                                    @else
                                        <textarea rows="4" id="constitutional_comment" name="constitutional_comment" style="width: 575px">
                                            {{$constitutional_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-12" >
                                    <button type="submit" id="btn_save_constitutional" class="btn btn-primary" style="float: right">
                                        Save Constitutional
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <hr style="border:solid">
    @endif
    @if(in_array("21", $navIds))
        {{--HENT--}}
        <div class="container-fluid" id="hent">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                    <h4 style="margin-top: 0">Physical Exam- HENT</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('HENT') }}" id="HENT_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
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
                                        <textarea rows="4" id="HENT_comment" name="HENT_comment" style="width: 575px">
                                            </textarea>
                                    @else
                                        <textarea rows="4" id="HENT_comment" name="HENT_comment" style="width: 575px">
                                            {{$HENT_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-12" >
                                    <button type="submit" id="btn_save_HENT" class="btn btn-primary" style="float: right">
                                        Save HENT
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <hr style="border:solid">
    @endif
    @if(in_array("22", $navIds))
        {{--Eyes--}}
        <div class="container-fluid" id="eyes">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                    <h4 style="margin-top: 0">Physical Exam- Eyes</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('Eyes') }}" id="Eyes_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
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
                                        <textarea rows="4" id="eyes_comment" name="eyes_comment" style="width: 575px">
                                            </textarea>
                                    @else
                                        <textarea rows="4" id="eyes_comment" name="eyes_comment" style="width: 575px">
                                            {{$eyes_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-12" >
                                    <button type="submit" id="btn_save_eyes" class="btn btn-primary" style="float: right">
                                        Save Eyes
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <hr style="border:solid">
    @endif
    @if(in_array("23", $navIds))
        {{--Respiratory--}}
        <div class="container-fluid" id="respiratory">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                    <h4 style="margin-top: 0">Physical Exam- Respiratory</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('Respiratory') }}" id="Respiratory_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
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
                                        <textarea rows="4" id="respiratory_comment" name="respiratory_comment" style="width: 575px">
                                            </textarea>
                                    @else
                                        <textarea rows="4" id="respiratory_comment" name="respiratory_comment" style="width: 575px">
                                            {{$respiratory_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-12" >
                                    <button type="submit" id="btn_save_respiratory" class="btn btn-primary" style="float: right">
                                        Save Respiratory
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <hr style="border:solid">
    @endif
    @if(in_array("24", $navIds))
        {{--Cardiovascular--}}
        <div class="container-fluid" id="cardiovascular">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                    <h4 style="margin-top: 0">Physical Exam- Cardiovascular</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('Cardiovascular') }}" id="Cardiovascular_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
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
                                        <textarea rows="4" id="cardiovascular_comment" name="cardiovascular_comment" style="width: 575px">
                                            </textarea>
                                    @else
                                        <textarea rows="4" id="cardiovascular_comment" name="cardiovascular_comment" style="width: 575px">
                                            {{$cardiovascular_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-12" >
                                    <button type="submit" id="btn_save_cardiovascular" class="btn btn-primary" style="float: right">
                                        Save Cardiovascular
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <hr style="border:solid">
    @endif
    @if(in_array("25", $navIds))
        {{--Musculoskeletal--}}
        <div class="container-fluid" id="musculoskeletal">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                    <h4 style="margin-top: 0">Physical Exam- Musculoskeletal</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('Musculoskeletal') }}" id="Musculoskeletal_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
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
                                        <textarea rows="4" id="musculoskeletal_comment" name="musculoskeletal_comment" style="width: 575px">
                                            </textarea>
                                    @else
                                        <textarea rows="4" id="musculoskeletal_comment" name="musculoskeletal_comment" style="width: 575px">
                                            {{$psychological_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-12" >
                                    <button type="submit" id="btn_save_musculoskeletal" class="btn btn-primary" style="float: right">
                                        Save Musculoskeletal
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <hr style="border:solid">
    @endif
    @if(in_array("26", $navIds))
        {{--Integumentary--}}
        <div class="container-fluid" id="integumentary">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                    <h4 style="margin-top: 0">Physical Exam- Integumentary</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('Integumentary') }}" id="Integumentary_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
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
                                        <textarea rows="4" id="integumentary_comment" name="integumentary_comment" style="width: 575px">
                                            </textarea>
                                    @else
                                        <textarea rows="4" id="integumentary_comment" name="integumentary_comment" style="width: 575px">
                                            {{$integumentary_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-12" >
                                    <button type="submit" id="btn_save_integumentary" class="btn btn-primary" style="float: right">
                                        Save Integumentary
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <hr style="border:solid">
    @endif
    @if(in_array("27", $navIds))
        {{--Neurological--}}
        <div class="container-fluid" id="neurological">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                    <h4 style="margin-top: 0">Physical Exam- Neurological</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('Neurological') }}" id="Neurological_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
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
                                        <textarea rows="4" id="neurological_comment" name="neurological_comment" style="width: 575px">
                                            </textarea>
                                    @else
                                        <textarea rows="4" id="neurological_comment" name="neurological_comment" style="width: 575px">
                                            {{$neurological_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-12" >
                                    <button type="submit" id="btn_save_neurological" class="btn btn-primary" style="float: right">
                                        Save Neurological
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
        <hr style="border:solid">
    @endif
    @if(in_array("28", $navIds))
        {{--Psychological--}}
        <div class="container-fluid" id="psychological">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                    <h4 style="margin-top: 0">Physical Exam- Psychological</h4>
                </div>
                    <div class="panel-body">
                        <br>
                        <form class="form-horizontal" method="POST" action="{{ route('Psychological') }}" id="Psychological_form">
                            {{ csrf_field() }}
                            <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                            <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                            <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
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
                                            <textarea rows="4" id="psychological_comment" name="psychological_comment" style="width: 575px">
                                            </textarea>
                                        @else
                                            <textarea rows="4" id="psychological_comment" name="psychological_comment" style="width: 575px">
                                            {{$psychological_comment[0]}}</textarea>
                                        @endif
                                    </div>
                                </div>
                                <br>
                                {{--Buttons--}}
                                <div class="row">
                                    <div class="col-md-12" >
                                        <button type="submit" id="btn_save_psychological" class="btn btn-primary" style="float: right">
                                            Save Psychological
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>

            </div>
        </div>
        <hr style="border:solid">
    @endif

    <script>
         $(document).ready(function(){
             var inputsChanged_Constitutional_form = false;
             var inputsChanged_HENT_form = false;
             var inputsChanged_Eyes_form = false;
             var inputsChanged_Respiratory_form = false;
             var inputsChanged_Cardiovascular_form = false;
             var inputsChanged_Musculoskeletal_form = false;
             var inputsChanged_Integumentary_form = false;
             var inputsChanged_Neurological_form = false;
             var inputsChanged_Psychological_form = false;

             $('#Constitutional_form').change(function() {
                 inputsChanged_Constitutional_form = true;
             });
             $('#HENT_form').change(function() {
                 inputsChanged_HENT_form = true;
             });
             $('#Eyes_form').change(function() {
                 inputsChanged_Eyes_form = true;
             });
             $('#Respiratory_form').change(function() {
                 inputsChanged_Respiratory_form = true;
             });
             $('#Cardiovascular_form').change(function() {
                 inputsChanged_Cardiovascular_form = true;
             });
             $('#Musculoskeletal_form').change(function() {
                 inputsChanged_Musculoskeletal_form = true;
             });
             $('#Integumentary_form').change(function() {
                 inputsChanged_Integumentary_form = true;
             });
             $('#Neurological_form').change(function() {
                 inputsChanged_Neurological_form = true;
             });
             $('#Psychological_form').change(function() {
                 inputsChanged_Psychological_form = true;
             });

             function unloadPage(){
                 if(inputsChanged_Psychological_form || inputsChanged_Constitutional_form || inputsChanged_HENT_form ||inputsChanged_Eyes_form || inputsChanged_Respiratory_form || inputsChanged_Cardiovascular_form || inputsChanged_Musculoskeletal_form || inputsChanged_Integumentary_form || inputsChanged_Neurological_form){
                     return "Do you want to leave this page?. Changes you made may not be saved.";
                 }
             }
             $("#btn_save_constitutional").click(function(){
                 inputsChanged_Constitutional_form = false;
             });
             $("#btn_save_HENT").click(function(){
                 inputsChanged_HENT_form = false;
             });
             $("#btn_save_eyes").click(function(){
                 inputsChanged_Eyes_form = false;
             });
             $("#btn_save_respiratory").click(function(){
                 inputsChanged_Respiratory_form = false;
             });
             $("#btn_save_cardiovascular").click(function(){
                 inputsChanged_Cardiovascular_form = false;
             });
             $("#btn_save_musculoskeletal").click(function(){
                 inputsChanged_Musculoskeletal_form = false;
             });
             $("#btn_save_integumentary").click(function(){
                 inputsChanged_Integumentary_form = false;
             });
             $("#btn_save_neurological").click(function(){
                 inputsChanged_Neurological_form = false;
             });
             $("#btn_save_psychological").click(function(){
                 inputsChanged_Psychological_form = false;
             });
             window.onbeforeunload = unloadPage;
         });
     </script>

@endsection
