@extends('patient.active_record')

@section('documentation_panel')

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
                                    <table>
                                        <br>
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
    @if(in_array("28", $navIds))
        {{--Psychological--}}
        <div class="container-fluid" id="hent">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                    <h4 style="margin-top: 0">Physical Exam- HENT</h4>
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
                                    <table>
                                        <br>
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
             var inputsChanged_Psychological_form = false;
             $('#Psychological_form').change(function() {
                 inputsChanged_Psychological_form = true;
             });

             function unloadPage(){
                 if(inputsChanged_Psychological_form ){
                     return "Do you want to leave this page?. Changes you made may not be saved.";
                 }
             }

             $("#btn_save_psychological").click(function(){
                 inputsChanged_Psychological_form = false;
             });

             window.onbeforeunload = unloadPage;
         });
     </script>

@endsection
