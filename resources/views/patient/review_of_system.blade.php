@extends('patient.active_record')

@section('documentation_panel')

    @if(in_array("10", $navIds))
        {{--ros_constitutional--}}
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                    <h4 style="margin-top: 0">ROS- Constitutional</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('ros_constitutional') }}" id="ros_constitutional_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <table>
                                        <br>
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
                                        <textarea rows="4" id="ros_constitutional_comment" name="ros_constitutional_comment" style="width: 575px">
                                            </textarea>
                                    @else
                                        <textarea rows="4" id="ros_constitutional_comment" name="ros_constitutional_comment" style="width: 575px">
                                            {{$ros_constitutional_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="reset" id="btn_clear_ros_constitutional_comment" class="btn btn-success" style="float: left">
                                        Reset Comment
                                    </button>
                                </div>
                                <div class="col-md-12" >
                                    <button type="submit" id="btn_save_ros_constitutional" class="btn btn-primary" style="float: right">
                                        Save ROS Constitutional
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

    @if(in_array("11", $navIds))
        {{--ros_hent--}}
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                    <h4 style="margin-top: 0">ROS- HENT</h4>
                </div>
                <div class="panel-body">
                    <br>
                    <form class="form-horizontal" method="POST" action="{{ route('ros_hent') }}" id="ros_hent_form">
                        {{ csrf_field() }}
                        <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                        <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                        <input type=hidden id="user_id" name="user_id" value="{{ Auth::user()->id }}">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <table>
                                        <br>
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
                                        <textarea rows="4" id="ros_hent_comment" name="ros_hent_comment" style="width: 575px">
                                            </textarea>
                                    @else
                                        <textarea rows="4" id="ros_hent_comment" name="ros_hent_comment" style="width: 575px">
                                            {{$ros_hent_comment[0]}}</textarea>
                                    @endif
                                </div>
                            </div>
                            <br>
                            {{--Buttons--}}
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="reset" id="btn_clear_ros_hent_comment" class="btn btn-success" style="float: left">
                                        Reset Comment
                                    </button>
                                </div>
                                <div class="col-md-12" >
                                    <button type="submit" id="btn_save_ros_hent" class="btn btn-primary" style="float: right">
                                        Save ROS HENT
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
            var inputsChanged_ros_constitutional_form = false;
            $('#ros_constitutional_form').change(function() {
                inputsChanged_ros_constitutional_form = true;
            });

            var inputsChanged_ros_hent_form = false;
            $('#ros_hent_form').change(function() {
                inputsChanged_ros_hent_form = true;
            });

            function unloadPage(){
                if(inputsChanged_ros_constitutional_form ){
                    return "Do you want to leave this page?. Changes you made may not be saved.";
                }
            }

            function unloadPage(){
                if(inputsChanged_ros_hent_form ){
                    return "Do you want to leave this page?. Changes you made may not be saved.";
                }
            }

            $("#btn_save_ros_constitutional").click(function(){
                inputsChanged_ros_constitutional_form = false;
            });

            $("#btn_save_ros_hent").click(function(){
                inputsChanged_ros_hent_form = false;
            });

            window.onbeforeunload = unloadPage;
        });
    </script>

@endsection
