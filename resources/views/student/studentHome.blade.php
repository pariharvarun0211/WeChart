@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <h3 style="text-align: center"><img src="logos\LogoStudent.png" width="4%"> Student Dashboard <img src="logos\LogoStudent.png" width="4%"></h3>
    </div>
    <a id="addPatient" href="{{url('/add_patient')}}" class="btn btn-primary" style="float: right">
        <i class="fa fa-plus-circle" aria-hidden="true"></i>
        Add new Patient</a>
</div>
  
@endsection
