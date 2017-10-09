@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <h3 style="text-align: center"><img src="logos\LogoStudent.png" width="4%"> Student Dashboard <img src="logos\LogoStudent.png" width="4%"></h3>
        </div>
        <!-- This button will take the user to a new page where new patient's demographic will be entered -->
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <a id="addPatient" href="{{url('/add_patient')}}" class="btn btn-success" style="float: right">
                    <i class="fa fa-plus-circle" aria-hidden="true"></i>
                    Add new Patient</a>
            </div>
        </div>
        <br>
        <!-- Saved -->
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default" style="margin-bottom: 0;padding-bottom: 0">
                    <div class="panel-heading" style="background-color: #5DADE2; padding-bottom: 0">
                        <h4 style="margin-top: 0">Saved Patients</h4>
                    </div>
                    <div class="panel-body" style="margin-bottom: 0;padding-bottom: 0">
                        @if($modules)
                            @foreach($modules as $module)
                                <div class="panel panel-default">
                                    <div class="panel-heading" style="background-color: grey; padding-bottom: 0">
                                        <h4 id="savedModuleName" style="margin-top: 0">{{$module}}</h4>
                                    </div>

                                    <div class="panel-body">
                                    @if($patients)
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr class="bg-info">
                                                    <th>Patient Name</th>
                                                    <th>Age</th>
                                                    <th>Sex</th>
                                                    <th>Height</th>
                                                    <th>Weight</th>
                                                    <th>Visit Date</th>
                                                    <th colspan="2">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                        @foreach($patients as $patient)
                                            <!-- To check the patient records with "Saved" status -->
                                                @if($patient->module)
                                                   @if($patient->status === 1 && $patient->module->module_name === $module && $patient->archived === f)
                                                           <tr>
                                                                <td><a href="{{ route( 'patient.view', ['patient_id' => $patient->patient_id ] ) }}" id="patientName"><?php echo $patient->first_name.' '.$patient->last_name; ?></a></td>
                                                                <td><p id="patientAge">{{$patient->age}}</p></td>
                                                                <td><p id="patientSex">{{$patient->gender}}</p></td>
                                                                <td><p id="patientHeight">{{$patient->height}}</p></td>
                                                                <td><p id="patientWeight">{{$patient->weight}}</p></td>
                                                                <td><p id="visitDate">{{$patient->visit_date}}</p></td>
                                                                <td style="text-align: left">
                                                                    {{--<a id="edit" href="{{  route('patient.edit', ['id' => $patient->patient_id]) }}"> Edit</a>--}}
                                                                    <a id="delete" href="{{ route('patient.destroy', ['patient_id' => $patient->patient_id ]) }}"> Delete</a>
                                                                </td>
                                                            </tr>
                                                    @endif
                                                @endif
                                            @endforeach
                                                </tbody>
                                            </table>
                                    @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            {{$message}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <br>
        <!-- Submitted -->
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading" style="background-color: #5DADE2; padding-bottom: 0">
                        <h4 style="margin-top: 0">Submitted Patients</h4>
                    </div>
                    <div class="panel-body">
                        <p>There are no submitted patients.</p>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>

    </div>
@endsection
