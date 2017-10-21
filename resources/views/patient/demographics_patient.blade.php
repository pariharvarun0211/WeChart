{{--@extends('layouts.app')--}}
{{--@extends('patient.vital_signs_header')--}}
@extends('patient.active_record')

@section('documentation_panel')
{{--@parent--}}
<!-- Javie Alba 10-16-17 Demographics -->
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: lightblue; padding-bottom: 0">
                <h4 style="margin-top: 0">Demographics</h4>
            </div>

            <div class="panel-body" >
                <form class="form-horizontal" method="POST" action="{{ url('Demographics') }}">
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
                        <td><p><label class="heading">Sex :</label></p></td>
                        <td>
                            @if($patient->gender=="Male")
                                <input name="gender" type="radio" value="male" checked>&nbsp;Male
                               &nbsp;&nbsp; <input name="gender" type="radio" value="female">&nbsp;Female
                            @else
                                <input name="gender" type="radio" value="male" >&nbsp;Male
                                &nbsp;&nbsp; <input name="gender" type="radio" value="female" checked>&nbsp;Female
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td><p>Age :</p></td>
                        <td><input type="text" name="age" value="{{$patient->age}}" >&nbsp; Years</td>
                    </tr>
                    <tr>
                        <td><p>Height :</p></td>
                        <td><input type="text" name="height" value="{{$patient->height}}" ></td>
                    </tr>
                    <tr>
                        <td><p>Weight :</p></td>
                        <td><input type="text" name="weight" value="{{$patient->weight}}" ></td>
                    </tr>
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
@endsection