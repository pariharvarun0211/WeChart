@extends('layouts.app')

@section('content')
{{--<script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>--}}
{{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>--}}

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<div class="container">
    <div class="row">
        <h3 align="center">Remove Emails</h3>
    </div>
    <div class="row">
        <div class="col-md-2 col-md-offset-1">
                <a href="{{url('/home')}}" class="btn btn-success" style="float: left">
                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                Back to Dashboard</a>
        </div>
    </div>
    <br>

    <!-- Display all Student Email Ids -->
    <div class="row">
            <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: grey; padding-bottom: 0">
                                <h4 style="margin-top: 0">All Student Emails</h4>                
                            </div>

                            <div class="panel-body" style="height: 210px; overflow-y: scroll">
                            <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr class="bg-info">
                                        <th >Email Address</th>
                                        <th >Role</th>
                                        <th >Creation Date</th>
                                        <th >Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($studentEmails as $email)
                                            <tr>
                                                <td><p><?php echo ($email->email); ?></p></td>
                                                <td><p><?php echo ($email->role); ?></p></td>
                                                <td><p><?php echo (date('m-d-Y',strtotime($email->created_at))); ?></p></td>

                                                <td style="text-align: right">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['deleteuser', $email->id],'id' => 'FormDeleteTime','class' =>'form-inline form-delete', 'onsubmit' => 'return ConfirmDelete()'])!!}

                                                    {!! Form::hidden('case_id', $email->id, ['class' => 'form-control']) !!}

                                                    <button id="student_minus_delete" data-id='<?php echo $email->id ;?>' style="margin:auto;  text-align:center; display:block; width:100%;" class="btn btn-danger btn-sm">
                                                        Delete </button>

                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                            @endforeach
                                    </tbody>
                                </table>                              
                            </div>
                        </div>
            </div>
        </div>

    <!-- Display all Instructors Email Ids -->
    <div class="row">
             <div class="col-md-10 col-md-offset-1">
                        <div class="panel panel-default">
                            <div class="panel-heading" style="background-color: grey; padding-bottom: 0">
                                <h4 style="margin-top: 0">All Instructor Emails</h4>                
                            </div>

                            <div class="panel-body" style="height: 210px; overflow-y: scroll">
                            <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr class="bg-info">
                                        <th >Email Address</th>
                                        <th >Role</th>
                                        <th >Creation Date</th>
                                        <th >Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                            @foreach ($instructorEmails as $email)
                                            <tr>
                                                <td><p><?php echo ($email->email); ?></p></td>
                                                <td><p><?php echo ($email->role); ?></p></td>
                                                <td><p><?php echo (date('m-d-Y',strtotime($email->created_at))); ?></p></td>
                                                <td style="text-align: right">
                                                    {!! Form::open(['method' => 'DELETE', 'route' => ['deleteuser', $email->id],'id' => 'FormDeleteTime','class' =>'form-inline form-delete', 'onsubmit' => 'return ConfirmDelete()'])!!}

                                                    {!! Form::hidden('case_id', $email->id, ['class' => 'form-control']) !!}

                                                    <button id="student_minus_delete" data-id='<?php echo $email->id ;?>' style="margin:auto;  text-align:center; display:block; width:100%;" class="btn btn-danger btn-sm">
                                                        Delete </button>

                                                    {!! Form::close() !!}
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>                              
                            </div>
                        </div>
             </div>
         </div>
</div>
<script>
    function ConfirmDelete()
    {
        var x = confirm("Are you sure you want to delete? This action is irreversible.");
        if (x)
            return true;
        else
            return false;
    }
</script>
@endsection
