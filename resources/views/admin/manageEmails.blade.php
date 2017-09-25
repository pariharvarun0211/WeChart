@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3 align="center">Manage Emails</h4>
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
                                                <td>
                                                  <a><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>      
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
                                                <td>
                                                  <a> <i class="fa fa-trash-o" aria-hidden="true"></i> Delete</a>      
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

@endsection
