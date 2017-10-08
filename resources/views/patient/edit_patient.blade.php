@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="row col-md-8">
                    <a href="{{url('/StudentHome')}}" class="btn btn-success" style="float: left">
                        <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                        Back to Dashboard</a>
                </div>
                <br><br>
                <div class="panel panel-default">
                    <div class="panel-heading" style="backgroundd-color: lightblue">
                        <h4>Edit Patient</h4>
                    </div>

                    <div class="panel-body">
                        <form class="form-horizontal" method="POST" action="{{ route('patient.store', ['patient_id' => $patient->patient_id]) }}">
                            {{ csrf_field() }}
                            <div class="form-group{{ $errors->has('gender') ? ' has-error' : '' }}">
                                <label for="gender" class="col-md-4 control-label">Sex*</label>

                                <div class="col-md-6">
                                    <input type="radio" class="form-check-input inline" name="gender" value="Male" id="genderMale" {{ $patient->gender === "Male" ? 'checked' : ''  }}> Male
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="radio" class="form-check-input inline" name="gender" value="Female" id="genderFemale" {{ $patient->gender === "Female" ? 'checked' : '' }}> Female
                                    @if ($errors->has('gender'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('gender') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }}">
                                <label for="age" class="col-md-4 control-label">Age*</label>

                                <div class="col-md-6">
                                    <input id="age" type="text" class="form-control" name="age" value="{{ $patient->age }}" required>
                                    @if ($errors->has('age'))
                                        <span class="help-block">
                                                <strong>{{ $errors->first('age') }}</strong>
                                            </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('height') ? ' has-error' : '' }}">
                                <label for="height" class="col-md-4 control-label">Height*</label>

                                <div class="col-md-6">
                                    <input id="height" type="text" class="form-control" name="height" value="{{ $patient->height }}" required >
                                    @if ($errors->has('height'))
                                        <span class="help-block">
                                                        <strong>{{ $errors->first('height') }}</strong>
                                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('weight') ? ' has-error' : '' }}">
                                <label for="weight" class="col-md-4 control-label">Weight*</label>

                                <div class="col-md-6">
                                    <input id="weight" type="text" class="form-control" name="weight" value="{{ $patient->weight }}" required >
                                    @if ($errors->has('weight'))
                                        <span class="help-block">
                                                        <strong>{{ $errors->first('height') }}</strong>
                                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group{{ $errors->has('visit_date') ? ' has-error' : '' }}">
                                <label for="height" class="col-md-4 control-label">Visit Date*</label>

                                <div class="col-md-6">
                                    <input id="visit_date" type="text" class="form-control" name="visit_date" value="{{ $patient->visit_date }}"  required>
                                    @if ($errors->has('visit_date'))
                                        <span class="help-block">
                                                                <strong>{{ $errors->first('visit_date') }}</strong>
                                                </span>
                                    @endif
                                </div>
                            </div>

                            <br>
                            <br>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;Save
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
                <!-- After user submits request -->

                <div>
                    <div>
                    </div>
@endsection