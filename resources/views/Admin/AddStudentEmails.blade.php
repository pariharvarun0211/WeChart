@extends('layouts.app')

@section('content')
<div class="container">
<div class="row">
         <div class="col-md-8 col-md-offset-2">
            <div class="row col-md-8">
                <a href="{{url('/home')}}" class="btn btn-success" style="float: left"> 
                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                Back to Dashboard</a>
            </div>
            <br><br>
            <div class="panel panel-default">
                <div class="panel-heading" style="backgroundd-color: lightblue">
                        <h4>Add Student Email Ids</h4>
                </div>

                <div class="panel-body">
<!--                   <p class="col-md-10"><strong>Note:</strong> You can enter multiple email addresses by seperating them by (,) comma. Example: 'abc@gmail.com,xyz@gmail.com' </p>
 -->
                    <form class="form-horizontal" method="POST" action="{{ url('AddStudentEmails') }}">
                        {{ csrf_field() }}
                                @for ($i = 0; $i < $counter ; $i++)
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">Enter E-Mail Address:</label>
                                    
                                        <div class="col-md-6">
                                            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                            @if ($errors->has('email'))
                                                <span class="help-block">
                                                    <strong>{{ $errors->first('email') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @endfor

                                @if ($counter != '1')
                                 <div class="col-md-4" style="float:right">
                                    <a type="button" href="{{url('RemoveStudentEmails')}}">
                                        <i class="fa fa-minus-circle" aria-hidden="true"></i> Remove row
                                    </a>
                                </div>
                                @endif

                                <div class="col-md-4" style="float:right">
                                    <a type="button" href="{{url('AddMoreStudentEmails')}}">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i> Add row
                                    </a>
                                </div>
                                <br>
                                <br>

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="btn btn-primary">
                                            <i class="fa fa-floppy-o" aria-hidden="true"></i> &nbsp;Save 
                                        </button>
                                    </div>
                                </div>
                    </form>
                </div>
               
            </div>
             <!-- After user submits request --> 
                 @if(!empty($EmailSubmitted))
                 <div class="alert alert-success">Success! Email id (s) saved in the database.</div
                 @endif
 <div>                
<div>
@endsection