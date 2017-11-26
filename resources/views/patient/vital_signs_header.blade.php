@section('content')
    {{--@parent--}}
    <!--This is a container for vital signs header -->
    <div class="container-fluid">
        <div class="row" >
            <div class="panel-heading" style="padding-left: 0">
                <a href="{{url('/StudentHome')}}" class="btn btn-success" style="float: left">
                    <i id="back_to_dashboard" class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    Back to Dashboard
                </a>
                <h3 id="patient_active_record" align="center" style="margin-top: 0;"><b>Patient Active Record</b></h3>
            </div>
            <div class="panel-body" style="margin-bottom: 0;padding-bottom: 0;background-color: #FFFAF0;margin-top: 0;padding-top: 0">
                <table class="table" style=" margin-top: 0;padding-top: 0;margin-bottom: 0;padding-bottom: 0">
                    <!--This is the first row in the vital signs panel -->
                    <tr style="padding-top: 0;padding-bottom: 0%; border-style: hidden">
                        <td style="padding-top: 0;padding-bottom: 0%">
                            <p id="name_label" style="align-self: center"><strong>Name:</strong>
                            {{$vital_signs_header->name}}
                            </p>
                        </td>
                        <td style="padding-top: 0;padding-bottom: 0%">
                            <p id="age_label"><strong>Age: </strong>
                            {{$vital_signs_header->age}}
                            </p>
                        </td>
                        <td style="padding-top: 0;padding-bottom: 0%">
                            <p id="sex_label"><strong>Sex: </strong>
                            {{$vital_signs_header->gender}}
                            </p>
                        </td>
                        <td style="padding-top: 0;padding-bottom: 0%">
                            <p id="room_number_label"> <strong>Room No: </strong>
                                {{$vital_signs_header->room_number}}</p>
                        </td>
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <p id="visit_date_label"><strong>Visit Date: </strong>
                            {{$vital_signs_header->visit_date}}</p>
                        </td>
                        <td style="padding-top: 0;padding-bottom: 0%">
                            <p id="RR_label" style="align-self: center"><strong>Respiratory Rate (RR):</strong>
                            @foreach($vital_signs_header->respiratory_rate as $key=>$respiratory_rate)
                                @if($respiratory_rate != null)
                                    {{$vital_signs_header->respiratory_rate[$key]}}
                                    @break
                                @endif
                            @endforeach
                            </p>
                        </td>

                    </tr>
                    <!--This is the second row in the vital signs panel -->
                    <tr style="padding-top: 0;padding-bottom: 0%; border-style: hidden">
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <p id="temperature_label"><strong>Temperature: </strong>
                            @foreach($vital_signs_header->temperature as $key=>$temperature)
                                @if($temperature != ' ')
                                    {{$vital_signs_header->temperature[$key]}}
                                    @break
                                @endif
                            @endforeach
                            </p>
                        </td>
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <p id="oxygen_saturation_label"><strong>Oxygen Saturation: </strong>
                            @foreach($vital_signs_header->oxygen_saturation as $key=>$oxygen_saturation)
                                @if($oxygen_saturation != null)
                                    {{$vital_signs_header->oxygen_saturation[$key]}}
                                    @break
                                @endif
                            @endforeach
                            </p>
                        </td>
                        <td style="padding-top: 0;padding-bottom: 0%">
                            <p id="bp_systolic_label" style="align-self: center"><strong>Blood Pressure (BP) Systolic: </strong>
                            @foreach($vital_signs_header->BP_systolic as $key=>$BP_systolic)
                                @if($BP_systolic != null)
                                    {{$vital_signs_header->BP_systolic[$key]}}
                                    @break
                                @endif
                            @endforeach
                            </p>
                        </td>
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <p id="bp_diastolic_label"><strong>Blood Pressure (BP) Diastolic: </strong>
                            @foreach($vital_signs_header->BP_diastolic as $key=>$BP_diastolic)
                                @if($BP_diastolic != null)
                                    {{$vital_signs_header->BP_diastolic[$key]}}
                                    @break
                                @endif
                            @endforeach
                            </p>
                        </td>
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <p id="hr_label"><strong>Heart Rate (HR): </strong>
                            @foreach($vital_signs_header->heart_rate as $key=>$heart_rate)
                                @if($heart_rate != null)
                                    {{$vital_signs_header->heart_rate[$key]}}
                                    @break
                                @endif
                            @endforeach
                            </p>
                        </td>
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <p id="pain_label"><strong>Pain:  </strong>
                            @foreach($vital_signs_header->pain as $key=>$pain)
                                @if($pain != null)
                                    {{$vital_signs_header->pain[$key]}}/10
                                    @break
                                @endif
                            @endforeach
                            </p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
        <br>
        <div class="row" style="padding-bottom: 0;margin-bottom: 0">
            @yield('Maincontent')
        </div>
    </div>
@endsection