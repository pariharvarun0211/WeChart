{{--@extends('layouts.app')--}}
{{--@extends('patient.vital_signs_header')--}}
@extends('patient.active_record')

@section('documentation_panel')
{{--@parent--}}
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                    <h4 style="margin-top: 0" id="hpi_heading">History of Present Illness (HPI)</h4>
                </div>

                <div class="panel-body col-md-offset-1">
                   <form class="form-horizontal" method="POST" action="{{ url('HPI') }}">
                        <!-- List of Surgeries -->
                        <div class="row">
                            <div class="col-md-9">
                                <h4>History of Present Illness:</h4>
                                <textarea id="HPI" name="HPI" rows="6" style="width: 575px"></textarea>
                            </div>
                        </div>

                        <h4>Comments:</h4>

                        <textarea id="HPI_comment" rows="6" style="width: 575px"
                                  name="HPI_comment" placeholder="Enter your comments here.">  </textarea>
                        <br>
                        <br>
                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-8">
                                <button id="save_button" type="save" class="btn btn-primary">
                                    <i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;Save HPI
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection