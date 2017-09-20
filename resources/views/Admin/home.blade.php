@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3 style="text-align: center"> Admin Dashboard</h3>
    </div>

    <div class="row">
    <div class="col-md-10 col-md-offset-1">   
            <a class="btn btn-success" style="float: left"> Emails Management</a>
        </div>
        <div class="col-md-10 col-md-offset-1">   
            <a class="btn btn-success" style="float: right"> Configure Modules</a>
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

                <div class="panel-body">
                <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr class="bg-info">
                            <th>Name</th>
                            <th>Email Id</th>
                            <th>Contact Number</th>
                            <th colspan="2"></th>
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
                                      <a>Delete</a>      
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>  
                    <a href="{{url('/AddStudentEmails')}}" class="btn btn-primary" style="float: right">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                     Add Student Email Id</a>        
                </div>
            </div>
        </div>
    </div>

      <!-- Instructors -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">        
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: grey; padding-bottom: 0">
                    <h4 style="margin-top: 0">Instructors</h4>                
                </div>

                <div class="panel-body">
                <table class="table table-striped table-bordered table-hover">
                        <thead>
                        <tr class="bg-info">
                            <th>Name</th>
                            <th>Email Id</th>
                            <th>Contact Number</th>
                            <th>Department Name</th>                            
                            <th colspan="2"></th>
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
                                      <a>Delete</a>      
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>    
                    <a href="{{url('/AddInstructorEmails')}}" class="btn btn-primary" style="float: right"> 
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Add Instructor Email Id</a>             
                </div>
            </div>
        </div>
    </div>
  
</div>
@endsection
