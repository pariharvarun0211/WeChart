{{--@extends('layouts.app')--}}
{{--@extends('patient.vital_signs_header')--}}
@extends('patient.active_record')

@section('documentation_panel')

    
    {{--Personal History--}}
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                <h4 style="margin-top: 0">Personal History</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('personal_history') }}">
                     {{ csrf_field() }}
                    <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                    <div class="container-fluid">
                        <!-- Search For Diagnosis -->
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                                <label for="Diagnosis"> Diagnosis:</label>
                            </div>
                            <div class="col-md-6 ">
                                <select id="search_diagnosis_personal_history" class="js-example-basic-multiple js-states form-control" name="search_diagnosis_personal_history[]" multiple></select>
                            </div>
                        </div>                      
                        <br>
                        <br>
                        <!-- Comment box -->
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                                <label for="Comment"> Comments:</label>
                            </div>
                            <div class="col-md-6">
                            <textarea rows="4" id="personal_history_comment" style="width: 480px" placeholder="Enter your comments here.">
                            </textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-8" style="float: right">
                        <button type="submit" id="btn_save_personal_history" class="btn btn-primary">
                            Save Personal History
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <hr style="border:solid">

    {{--Family History--}}
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                <h4 style="margin-top: 0">Family History</h4>
            </div>
            <div class="panel-body">
                <br>
                <div class="container-fluid">
                    <!-- Add button -->
                    <div class="row" style="padding-left: 2%">
                        <div class="col-md-offset-1">
                                <a id="addFamilyMember" href="" class="btn btn-primary" style="float: left">
                                                <i class="fa fa-plus-circle" aria-hidden="true"></i>
                                                Add Family Member</a>
                        </div>
                    </div>
                    <br>
                    {{--Family Member Panel--}}
                    <div class="row">
                        <div class="col-md-offset-1 col-md-11" style="border: solid" id="family_member_id">
                            <div class="row" style="padding-top: 2%;padding-left: 1%;padding-right: 1%">
                                    <div class="col-md-6">
                                        <label id="familyMember" for="SearchForDiagnosis">Family Member</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input id="SearchForDiagnosis_family_history" type="text" name="SearchForDiagnosis">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="SearchForDiagnosis" >Search For Diagnosis</label>&nbsp;&nbsp;&nbsp;&nbsp;
                                        <input id="SearchForDiagnosis_family_history" type="text" name="SearchForDiagnosis">
                                    </div>
                            </div>
                            <br>
                            <div class="row" style="padding-right: 1%;padding-left: 1%">
                                <div class="col-md-12">
                                    <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr class="bg-info">
                                                    <th>Diagnosis</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td><p>Father</p></td>
                                                <td style="text-align: left">
                                                    <a class="btn btn-danger" id="Delete_family_history" style="float: right"> Delete</a>
                                                </td>
                                            </tr>
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <!-- Comment box -->
                    <div class="row">
                        <div class="col-md-3 col-md-offset-1">
                            <label for="Comment"> Comments:</label>
                        </div>
                        <div class="col-md-6">
                            <textarea rows="4" id="family_history_comment" style="width: 400px" placeholder="Enter your comments here.">
                            </textarea>
                        </div>
                    </div>
                    <br>
                    {{--Save button--}}
                    <div class="row">
                        <div class="col-md-8" style="float: right">
                            <button type="submit" id="btn_save_family_history" class="btn btn-primary">
                                Save Family History
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr style="border: solid">

    {{--Surgical History--}}
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                <h4 style="margin-top: 0">Surgical History</h4>
            </div>
          <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('surgical_history') }}">
                     {{ csrf_field() }}
                    <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">
                    <div class="container-fluid">
                        <!-- Search For Diagnosis -->
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                                <label for="Diagnosis"> Diagnosis:</label>
                            </div>
                            <div class="col-md-6 ">
                                <select id="search_diagnosis_surgical_history" class="js-example-basic-multiple js-states form-control" name="search_diagnosis_surgical_history[]" multiple></select>
                            </div>
                        </div>                      
                        <br>
                        <br>
                        <!-- Comment box -->
                        <div class="row">
                            <div class="col-md-3 col-md-offset-1">
                                <label for="Comment"> Comments:</label>
                            </div>
                            <div class="col-md-6">
                            <textarea rows="4" id="personal_history_comment" style="width: 480px" placeholder="Enter your comments here.">
                            </textarea>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                    <div class="col-md-8" style="float: right">
                        <button type="submit" id="btn_save_surgical_history" class="btn btn-primary">
                            Save Surgical History
                        </button>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
    <hr style="border: solid">

    {{--Social History--}}
    <div class="container-fluid">
        <div class="panel panel-default">
            <div class="panel-heading" style="background-color: lightblue;padding-bottom: 0">
                <h4 style="margin-top: 0">Social History</h4>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="{{ route('social_history') }}">
                 {{ csrf_field() }}
                 <input id="module_id" name="module_id" type="hidden" value="{{ $patient->module_id }}">                   
                {{--Smoke Tobaco--}}
                <div class="row">
                    <div class="col-md-3 col-md-offset-1">
                        <label id="smoke_tobacco">Smoke Tobacco?: </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" class="form-check-input inline" name="smoke_tobacco" value="YES" id="smoke_tobacco_yes" >&nbsp;YES
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="form-check-input inline" name="smoke_tobacco" value="NO" id="smoke_tobacco_yes">&nbsp;NO
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-md-offset-1">
                        <label id="smoke_tobacco_comment_label">Comments: </label>
                    </div>
                    <div class="col-md-3">
                        <textarea rows="3" style="width: 400px" id="smoke_tobacco_comment" placeholder="Enter your comments here."> </textarea>
                    </div>
                 </div>
                <br>

                {{--Non smoke Tobacco--}}
                <div class="row">
                    <div class="col-md-3 col-md-offset-1">
                        <label id="non_smoke_tobacco">Non-Smoke Tobacco?: </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" class="form-check-input inline" name="non_smoke_tobacco" value="YES" id="non_smoke_tobacco_yes" >&nbsp;YES
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="form-check-input inline" name="non_smoke_tobacco" value="NO" id="non_smoke_tobacco_yes">&nbsp;NO
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-md-offset-1">
                        <label id="non_smoke_tobacco_comment_label">Comments: </label>
                    </div>
                    <div class="col-md-3">
                        <textarea rows="3" style="width: 400px" id="non_smoke_tobacco_comment" placeholder="Enter your comments here."> </textarea>
                    </div>
                </div>

                <br>
                {{--Alcohol--}}
                <div class="row">
                    <div class="col-md-3 col-md-offset-1">
                        <label id="alcohol">Drink Alcohol?: </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" class="form-check-input inline" name="alcohol" value="YES" id="alcohol_yes" >&nbsp;YES
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="form-check-input inline" name="alcohol" value="NO" id="alcohol_no">&nbsp;NO
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-md-offset-1">
                        <label id="alcohol_comment_label">Comments: </label>
                    </div>
                    <div class="col-md-3">
                        <textarea rows="3" style="width: 400px" id="alcohol_comment" placeholder="Enter your comments here."> </textarea>
                    </div>
                </div>

                <br>
                {{--Sexual Avtivity--}}
                <div class="row">
                    <div class="col-md-3 col-md-offset-1">
                        <label id="sexual_activity">Sexual Activity?: </label>
                    </div>
                    <div class="col-md-3">
                        <input type="radio" class="form-check-input inline" name="sexual_activity" value="Active" id="sexual_activity_active" >&nbsp;Active
                        &nbsp;&nbsp;&nbsp;&nbsp;
                        <input type="radio" class="form-check-input inline" name="sexual_activity" value="Not Active" id="sexual_activity_not_active">&nbsp;Not Active
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 col-md-offset-1">
                        <label id="sexual_activity_comment_label">Comments: </label>
                    </div>
                    <div class="col-md-3">
                        <textarea rows="3" style="width: 400px" id="sexual_activity_comment" placeholder="Enter your comments here."> </textarea>
                    </div>
                </div>

                <br>
                <div class="row">
                <div class="col-md-8" style="float: right">
                    <button type="submit" id="btn_save_social_history" class="btn btn-primary">
                        Save Social History
                    </button>
                </div>
                </div>
                </form>
            </div>
        </div>
    </div>

    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
    
     <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
     <script>
         $('#search_diagnosis_personal_history').select2({
             placeholder: "Choose Diagnosis...",
             minimumInputLength: 2,
             ajax: {
                 url: '{{route('diagnosis_find')}}',
                 dataType: 'json',
                 data: function (params) {
                     return {
                         q: $.trim(params.term)
                     };
                 },
                 processResults: function (data) {
                     return {
                         results: data
                     };
                 },
                 cache: true
             }
         });
         
          $('#search_diagnosis_surgical_history').select2({
             placeholder: "Choose Diagnosis...",
             minimumInputLength: 2,
             ajax: {
                 url: '{{route('diagnosis_find')}}',
                 dataType: 'json',
                 data: function (params) {
                     return {
                         q: $.trim(params.term)
                     };
                 },
                 processResults: function (data) {
                     return {
                         results: data
                     };
                 },
                 cache: true
             }
         });
     </script>

@endsection
