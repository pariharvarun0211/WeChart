@extends('layouts.app')

@section('content')

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

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
                                    @if($saved_patients)
                                        <table class="table table-striped table-bordered table-hover">
                                            <thead>
                                                <tr class="bg-info">
                                                    <th colspan="2">Patient Name</th>
                                                    <th>Age</th>
                                                    <th>Sex</th>
                                                    <th>Visit Date</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($saved_patients as $patient)
                                                <!-- To check the patient records with "Saved" status -->
                                                    @if($patient->module)
                                                       @if($patient->status === 1 && $patient->module->module_name === $module)
                                                               <tr>
                                                                    <td colspan="2">
                                                                        <a href="{{ route( 'patient.view', ['patient_id' => $patient->patient_id ] ) }}" id="patientName">
                                                                             <?php echo $patient->first_name.' '.$patient->last_name; ?>
                                                                         </a>
                                                                    </td>
                                                                    <td><p id="patientAge">{{$patient->age}}</p></td>
                                                                    <td><p id="patientSex">{{$patient->gender}}</p></td>
                                                                    <td><p id="visitDate">{{$patient->visit_date}}</p></td>
                                                                    <td>
                                                                        <a href="{{ route( 'patient.view', ['patient_id' => $patient->patient_id ] ) }}" class="btn btn-primary" id="edit">
                                                                            <i class="fa fa-pencil-square-o" aria-hidden="true"></i> View & Edit
                                                                        </a>
                                                                        <a class="btn btn-danger" id="delete" >
                                                                            <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                                        </a>
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
                            <p>{{$saved_message}}</p>
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
                        <div class="panel-body" style="margin-bottom: 0;padding-bottom: 0">
                            @if($modules)
                                @foreach($modules as $module)
                                    <div class="panel panel-default">
                                        <div class="panel-heading" style="background-color: grey; padding-bottom: 0">
                                            <h4 id="savedModuleName" style="margin-top: 0">{{$module}}</h4>
                                        </div>

                                        <div class="panel-body">
                                            @if($submitted_patients)
                                                <table class="table table-striped table-bordered table-hover">
                                                    <thead>
                                                    <tr class="bg-info">
                                                        <th>Patient Name</th>
                                                        <th>Submitted Date</th>
                                                        <th>Visit Date</th>
                                                        <th colspan="3"></th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($submitted_patients as $patient)
                                                        <!-- To check the patient records with "Saved" status -->
                                                        @if($patient->module)                                                       
                                                            @if($patient->completed_flag == 1 && $patient->module->module_name === $module)
                                                                <tr>                                                               
                                                                    <td>
                                                                        <?php echo $patient->first_name.' '.$patient->last_name; ?>                                                                    
                                                                    </td>
                                                                    <td><p id="patient_submitted_date">{{$patient->submitted_date}}</p></td>
                                                                    <td><p id="visitDate">{{$patient->visit_date}}</p></td>
                                                                    <td style="text-align: left">
                                                                        <a href="{{ route( 'patient_preview', ['patient_id' => $patient->patient_id ] ) }}" class="btn btn-primary" id="preview">
                                                                            <i class="fa fa-file-text" aria-hidden="true"></i> Preview
                                                                        </a>
                                                                        <a href="{{ route( 'pdf_generate', ['patient_id' => $patient->patient_id ] ) }}" class="btn btn-success" id="generate_report">
                                                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Generate PDF
                                                                        </a>
                                                                        <a class="btn btn-danger" id="delete">
                                                                            <i class="fa fa-trash-o" aria-hidden="true"></i> Delete
                                                                        </a>
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
                                <p>{{$submitted_message}}</p>
                            @endif
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>

    </div>
   @endsection
