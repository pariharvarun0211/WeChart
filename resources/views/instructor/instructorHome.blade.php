@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3 style="text-align: center"><img src="logos\LogoInstructor.png" width="4%"> Instructor Dashboard <img src="logos\LogoInstructor.png" width="4%"></h3>
    </div>
    <!-- Students -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #5DADE2; padding-bottom: 0">
                    <h4 style="margin-top: 0">Ready for Review</h4>
                </div>
                <div class="panel-body" style="height: 220px; overflow-y: scroll">
                    <p> There are no patients for review.</p>

                </div>
                <br>
            </div>
        </div>
    </div>
    <br>
    <!-- Instructors -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: #5DADE2; padding-bottom: 0">
                    <h4 style="margin-top: 0">Reviewed</h4>
                </div>
                <div class="panel-body" style="height: 220px; overflow-y: scroll">
                    <p> No patients have been reviewed.</p>
                </div>
            </div>

            <br>
        </div>
    </div>
@endsection
