@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-4 col-md-offset-4">
            <div class="row col-md-8">
                <a href="{{url('/StudentHome')}}" class="btn btn-success" style="float: left">
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    Back to Dashboard</a>
            </div>
            <br/>
            <br/>
            <br/>
            <h1 style="color:black; text-align:center;">Patient Details</h1>
            <table class="table table-striped table-bordered table-hover">
                <tbody>
                <tr class="bg-info"/>
                <tr>
                    <td>Patient First Name</td>
                    <td><?php echo ($patient['first_name']); ?></td>
                </tr>
                <tr>
                    <td>Patient Last Name</td>
                    <td><?php echo ($patient['last_name']); ?></td>
                </tr>
                <tr>
                    <td>Age</td>
                    <td><?php echo ($patient['age']); ?></td>
                </tr>
                <tr>
                    <td>Sex</td>
                    <td><?php echo ($patient['gender']); ?></td>
                </tr>
                <tr>
                    <td>Height</td>
                    <td><?php echo ($patient['height']); ?></td>
                </tr>
                <tr>
                    <td>Weight</td>
                    <td><?php echo ($patient['weight']); ?></td>
                </tr>
                <tr>
                    <td>Visit Date</td>
                    <td><?php echo ($patient['visit_date']); ?></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection