@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3 style="text-align: center"> Admin Dashboard</h3>
    </div>

    <div class="row">
        <div class="col-md-10 col-md-offset-1">   
            <a class="btn btn-success" style="float: right"> Configure Modules</a>
        </div>
    </div>

    <br>

<!-- Students -->
    <div class="row">
        <div class="col-md-10 col-md-offset-1">        
            <div class="panel panel-default">
                <div class="panel-heading">
                <h4 style="margin-top: 0">Students</h4>
                   <div class="row">
                          <div class="col-md-3">
                            <p>Name</p>
                          </div>
                          <div class="col-md-3">
                            <p>Email Id</p>
                          </div>
                          <div class="col-md-3">
                            <p>Contact Number</p>
                          </div>
                          <div class="col-md-3">
                            <p>Action</p>
                          </div>
                    </div>
                </div>

                <div class="panel-body">
                   <ul>
                   </ul>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
