@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3 style="text-align: center"><img src="logos\LogoStudent.png" width="4%"> Student Dashboard <img src="logos\LogoStudent.png" width="4%"></h3>
    </div>
<<<<<<< HEAD
    <a id="addPatient" href="{{url('/add_patient')}}" class="btn btn-primary" style="float: right">
        <i class="fa fa-plus-circle" aria-hidden="true"></i>
        Add new Patient</a>
=======
    <br>
    <!-- Students -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: grey; padding-bottom: 0">
                    <h4 style="margin-top: 0">Saved</h4>
                </div>
                <div class="panel-body" style="height: 220px; overflow-y: scroll">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color: grey; padding-bottom: 0">
                            <h4 style="margin-top: 0">Module 1</h4>
                        </div>
                        <div class="panel-body" style="height: 220px; overflow-y: scroll">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr class="bg-info">
                                    <th>Patient Name</th>
                                    <th>Age</th>
                                    <th>Sex</th>
                                    <th>Height</th>
                                    <th>Weight</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><p>Name</p></td>
                                    <td><p>27</p></td>
                                    <td> <p>Male</p></td>
                                    <td> <p>6'10</p></td>
                                    <td> <p>150</p></td>
                                    <td style="text-align: left">
                                        <a href=""> Edit</a>
                                        <a href=""> Delete</a>
                                        <a href=""> View</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
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
                <div class="panel-heading" style="background-color: grey; padding-bottom: 0">
                    <h4 style="margin-top: 0">Submitted</h4>
                </div>
                <div class="panel-body" style="height: 220px; overflow-y: scroll">
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background-color: grey; padding-bottom: 0">
                            <h4 style="margin-top: 0">Module 1</h4>
                        </div>
                        <div class="panel-body" style="height: 220px; overflow-y: scroll">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr class="bg-info">
                                    <th>Patient Name</th>
                                    <th>Age</th>
                                    <th>Sex</th>
                                    <th>Height</th>
                                    <th>Weight</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td><p>Name</p></td>
                                    <td><p>27</p></td>
                                    <td> <p>Male</p></td>
                                    <td> <p>6'10</p></td>
                                    <td> <p>150</p></td>
                                    <td style="text-align: left">
                                        <a href=""> Edit</a>
                                        <a href=""> Delete</a>
                                        <a href=""> View</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <br>
            </div>
        </div>
    </div>
>>>>>>> 347fea3be96a083ab2b56fea802ed91f793cd4e9
</div>
@endsection