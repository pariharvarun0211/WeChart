@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3 style="text-align: center"> Student Dashboard</h3>
    </div>
         <div style="text-align: center" class="alert alert-info">Work in progress. Please visit after sometime.</div>
     <!-- <div class="row">
        <div class="col-md-10 col-md-offset-1">   
            <a class="btn btn-success" style="float: right"> Configure Modules</a>
        </div>
    </div> 

    <br>

     <div class="row">
        <div class="col-md-10 col-md-offset-1">        
            <div class="panel panel-default">
                <div class="panel-heading" style="background-color: grey; padding-bottom: 0">
                    <h4 style="margin-top: 0">Patients</h4>                
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
                                @foreach ($patients as $patient)
                                <tr>
                                    <td>
                                        <p><?php echo ($patient->firstname); ?>  &nbsp;<?php echo ($patient->lastname); ?></p></td>
                                    <td><p><?php echo ($patient->email); ?></p></td>
                                    <td> <p><?php echo ($patient->contactno); ?></p></td>
                                    <td style="text-align: right">
                                      <a>Delete</a>      
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>  
                    <a href="{{url('/AddStudentEmails')}}" class="btn btn-primary" style="float: right">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                     Add New Patient</a>        
                </div>
            </div>
        </div>
    </div>-->
</div>
  
@endsection
