@extends('layouts.app')

{{--<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>--}}

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

@section('content')
<div class="container">
    <div class="row" style="padding-top: 0;margin: 0">
        <h3 id="lblAdminHeader" style="text-align: center;padding-top: 0;margin: 0"><img src="logos\LogoAdmin.png" width="4%"> Admin Dashboard <img src="logos\LogoAdmin.png" width="4%"></h3>
    </div>

    <div class="row">
            <div class="col-md-2 col-md-offset-1">   
                <a href="{{url('/ManageEmails')}}" class="btn btn-success"> 
                <i class="fa fa-envelope-o" aria-hidden="true"></i> Remove Emails</a>
            </div>
            <div class="col-md-8">
                <a class="btn btn-success" style="float: right" href={{url('/ConfigureModules')}}>
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

                <div class="panel-body" >
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
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['archiveuser', $student->id],'id' => 'FormDeleteTime','class' =>'form-inline form-delete', 'onsubmit' => 'return ConfirmDelete()'])!!}

                                        {!! Form::hidden('case_id', $student->id, ['class' => 'form-control']) !!}

                                        <button id="student_minus_delete" data-id='<?php echo $student->id ;?>' style="margin:auto;  text-align:center; display:block; width:100%;" class="btn btn-danger btn-sm">
                                            Delete </button>

                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a id="addStudentEmails" href="{{url('/AddStudentEmails')}}" class="btn btn-primary" style="float: right">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        Add Student Email Address</a>
                </div>
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

                <div class="panel-body" >
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
                                        {!! Form::open(['method' => 'DELETE', 'route' => ['archiveuser', $instructor->id],'id' => 'FormDeleteTime','class' =>'form-inline form-delete', 'onsubmit' => 'return ConfirmDelete()'])!!}

                                        {!! Form::hidden('case_id', $instructor->id, ['class' => 'form-control']) !!}

                                        <button id="student_minus_delete" data-id='<?php echo $instructor->id ;?>' style="margin:auto;  text-align:center; display:block; width:100%;" class="btn btn-danger btn-sm">
                                            Delete </button>

                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <a id="addInstructorEmails" href="{{url('/AddInstructorEmails')}}" class="btn btn-primary" style="float: right">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i>
                        Add Instructor Email Address</a>
                </div>
              </div>
        </div>
    </div>
  
</div>
<script>
    function ConfirmDelete()
    {
        var x = confirm("Are you sure you want to delete?");
        if (x)
            return true;
        else
            return false;
    }

</script>
@endsection
