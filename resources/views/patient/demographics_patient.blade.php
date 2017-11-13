{{--@extends('layouts.app')--}}
{{--@extends('patient.vital_signs_header')--}}
@extends('patient.active_record')

@section('documentation_panel')
{{--@parent--}}

<div class="row" style="padding-left: 0;padding-right: 0;margin-right: 0;margin-left: 0">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: lightblue; padding-bottom: 0">
                <h4 style="margin-top: 0">Demographics</h4>
            </div>

            <div class="panel-body" >
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="form-horizontal" method="POST" action="{{ url('Demographics') }}" id="demographics_form">
                    {{ csrf_field() }}
                    <input id="patient_id" name="patient_id" type="hidden" value="{{ $patient->patient_id }}">
                    <table class="table table-striped table-bordered table-hover">
                    <tr>
                        <td>
                            <p>Name :</p>
                        </td>
                        <td>
                            <label>{{$patient->first_name}} {{$patient->last_name}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p>Visit Date :</p>
                        </td>
                        <td>
                            <label>{{$patient->visit_date}}</label>
                        </td>
                    </tr>
                    <tr>
                        <td><p>Sex* :</p></td>
                        <td>
                            @if($patient->gender == "Male")
                                  <input name="gender" type="radio" value="Male" checked>&nbsp;Male
                               &nbsp;&nbsp; <input name="gender" type="radio" value="Female">&nbsp;Female
                            @else
                                  <input name="gender" type="radio" value="Male" >&nbsp;Male
                                &nbsp;&nbsp;<input name="gender" type="radio" value="Female" checked>&nbsp;Female
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><p>Room Number* :</p></td>
                        <td><input type="text" name="room_number" value="{{$patient->room_number}}" required></td>
                    </tr>
                    <tr>
                        <td><p>Age* :</p></td>
                        <td><input type="text" name="age" value="{{$patient->age}}" required></td>
                    </tr>
                    {{--<tr>--}}
                        {{--<td><p>Height* :</p></td>--}}
                        {{--<td>--}}
                            {{--<input type="text" name="height" value="{{$height}}" required>--}}
                            {{--<br>--}}
                            {{--<select name="height_unit" value="{{ old('height_unit') }}">--}}
                                {{--@if($height_unit == "cms")--}}
                                    {{--<option value="cms" selected="selected">cms</option>--}}
                                    {{--<option value="inches">inches</option>--}}
                                {{--@else--}}
                                    {{--<option value="cms" >cms</option>--}}
                                    {{--<option value="inches" selected="selected">inches</option>--}}
                                {{--@endif--}}
                            {{--</select>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td><p>Weight* :</p></td>--}}
                        {{--<td>--}}
                            {{--<input type="text" name="weight" value="{{$weight}}" required>--}}
                            {{--<br>--}}
                            {{--<select name="weight_unit" value="{{ old('weight_unit') }}">--}}
                                {{--@if($weight_unit == "kgs")--}}
                                    {{--<option value="kgs" selected="selected">kgs</option>--}}
                                    {{--<option value="lbs">lbs</option>--}}
                                {{--@else--}}
                                    {{--<option value="kgs">kgs</option>--}}
                                    {{--<option value="lbs" selected="selected">lbs</option>--}}
                                {{--@endif--}}
                            {{--</select>--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                </table>
                    <div class="col-md-offset-4" style="float: right">
                      <button type="submit" id="btn_save_demographics" class="btn btn-primary">
                          Update Demographics
                      </button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        var inputsChanged = false;
        $('#demographics_form').change(function() {
            inputsChanged = true;
        });

        function unloadPage(){
            if(inputsChanged){
                return "Do you want to leave this page?. Changes you made may not be saved.";
            }
        }

        $("#btn_save_demographics").click(function(){
            inputsChanged = false;
        });

        window.onbeforeunload = unloadPage;
    });
</script>
@endsection
