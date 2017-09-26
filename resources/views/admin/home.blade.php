@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="padding-top: 0;margin: 0">
        <h3 id="lblAdminHeader" style="text-align: center;padding-top: 0;margin: 0"><img src="logos\LogoAdmin.png" width="4%"> Admin Dashboard <img src="logos\LogoAdmin.png" width="4%"></h3>
    </div>

    <div class="row">
            <div class="col-md-2 col-md-offset-1">   
                <a href="{{url('/ManageEmails')}}" class="btn btn-success"> 
                <i class="fa fa-envelope-o" aria-hidden="true"></i> Manage Emails</a>
            </div>
            <div class="col-md-8">   
                <a class="btn btn-success" style="float: right"> 
                <i class="fa fa-cog" aria-hidden="true"></i> Configure Modules</a>
            </div>
    </div>
    <br>
    <!-- Students -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">        
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: grey; padding-bottom: 0">
                    <h4 style="margin-top: 0">Students</h4>                
                </div>

                <div class="panel-body" style="height: 220px; overflow-y: scroll">
                <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr class="bg-info">
                            <th>Name</th>
                            <th><i class="fa fa-envelope-o" aria-hidden="true"></i> Email Address</th>
                            <th><i class="fa fa-phone" aria-hidden="true"></i> Contact Number</th>
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                                @foreach ($students as $student)
                                <tr>
                                    <td>
                                        <p><?php echo ($student->firstname); ?>  &nbsp;<?php echo ($student->lastname); ?></p></td>
                                    <td><p><?php echo ($student->email); ?></p></td>
                                    <td> <p><?php echo ($student->contactno); ?></p></td>
                                    <td style="text-align: right">
                                        <a href="" style="margin:auto; text-align:center; display:block;" class="btn btn-danger btn-sm" style="float: right">
                                            <i class="fa fa-minus-circle" aria-hidden="true"> Delete</a></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br>
                <a id="addStudentEmails" href="{{url('/AddStudentEmails')}}" class="btn btn-primary" style="float: right">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Add Student Email Address</a>
            </div>
        </div>
    </div>
<br>
      <!-- Instructors -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">        
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: grey; padding-bottom: 0">
                    <h4 style="margin-top: 0">Instructors</h4>                
                </div>

                <div class="panel-body" style="height: 220px; overflow-y: scroll">
                <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr class="bg-info">
                            <th>Name</th>
                            <th><i class="fa fa-envelope-o" aria-hidden="true"></i> Email Address</th>
                            <th><i class="fa fa-phone" aria-hidden="true"></i> Contact Number</th>
                            <th><i class="fa fa-newspaper-o" aria-hidden="true"></i> Department Name</th>                            
                            <th colspan="2">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                                @foreach ($instructors as $instructor)
                                <tr>
                                    <td>
                                        <p><?php echo ($instructor->firstname); ?>  &nbsp;<?php echo ($instructor->lastname); ?></p></td>
                                    <td><p><?php echo ($instructor->email); ?></p></td>
                                    <td> <p><?php echo ($instructor->contactno); ?></p></td>
                                    <td> <p><?php echo ($instructor->departmentName ); ?></p></td>
                                    <td style="text-align: right">
                                        <p style="text-align:center"><a href="" style="margin:auto; text-align:center; display:block;" class="btn btn-danger btn-sm" style="float: right">
                                                <i class="fa fa-minus-circle" aria-hidden="true"> Delete</a></i>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>    
                </div>
                <br>
                <a id="addInstructorEmails" href="{{url('/AddInstructorEmails')}}" class="btn btn-primary" style="float: right">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Add Instructor Email Address</a>

            </div>
        </div>
    </div>
  
</div>
@endsection
