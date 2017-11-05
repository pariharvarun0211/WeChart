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
                            <label id="name_label" style="align-self: center">Name:</label>
                            <label id="name" >{{$vital_signs_header->name}}</label>
                        </td>
                        <td style="padding-top: 0;padding-bottom: 0%">
                            <label id="age_label">Age: </label>
                            <label id="age">{{$vital_signs_header->age}} </label>
                        </td>
                        <td style="padding-top: 0;padding-bottom: 0%">
                            <label id="sex_label">Sex:</label>
                            <label id="sex">{{$vital_signs_header->gender}}</label>
                        </td>
                        <td style="padding-top: 0;padding-bottom: 0%">
                            <label id="room_number_label">Room No:</label>
                            <label id="room_number">{{$vital_signs_header->room_number}}</label>
                        </td>
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <label id="visit_date_label">Visit Date:</label>
                            <label id="visit_date">{{$vital_signs_header->visit_date}}</label>
                        </td>
                        <td style="padding-top: 0;padding-bottom: 0%">
                            <label id="RR_label" style="align-self: center">Respiratory Rate (RR):</label>
                            @foreach($vital_signs_header->respiratory_rate as $key=>$respiratory_rate)
                                @if($respiratory_rate != null)
                                    <label id="respiratory_rate">{{$vital_signs_header->respiratory_rate[$key]}}</label>
                                    @break
                                @endif
                            @endforeach
                        </td>

                    </tr>
                    <!--This is the second row in the vital signs panel -->
                    <tr style="padding-top: 0;padding-bottom: 0%; border-style: hidden">
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <label id="temperature_label">Temperature:</label>
                            @foreach($vital_signs_header->temperature as $key=>$temperature)
                                @if($temperature != ' ')
                                    <label id="temperature">{{$vital_signs_header->temperature[$key]}}</label>
                                    @break
                                @endif
                            @endforeach
                        </td>
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <label id="oxygen_saturation_label">Oxygen Saturation:</label>
                            @foreach($vital_signs_header->oxygen_saturation as $key=>$oxygen_saturation)
                                @if($oxygen_saturation != null)
                                    <label id="oxygen_saturation">{{$vital_signs_header->oxygen_saturation[$key]}}</label>
                                    @break
                                @endif
                            @endforeach
                        </td>
                        <td style="padding-top: 0;padding-bottom: 0%">
                            <label id="bp_systolic_label" style="align-self: center">Blood Pressure (BP) Systolic: </label>
                            @foreach($vital_signs_header->BP_systolic as $key=>$BP_systolic)
                                @if($BP_systolic != null)
                                    <label id="bp_systolic">{{$vital_signs_header->BP_systolic[$key]}}</label>
                                    @break
                                @endif
                            @endforeach
                        </td>
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <label id="bp_diastolic_label">Blood Pressure (BP) Diastolic: </label>
                            @foreach($vital_signs_header->BP_diastolic as $key=>$BP_diastolic)
                                @if($BP_diastolic != null)
                                    <label id="bp_diastolic">{{$vital_signs_header->BP_diastolic[$key]}}</label>
                                    @break
                                @endif
                            @endforeach
                        </td>
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <label id="hr_label">Heart Rate (HR): </label>
                            @foreach($vital_signs_header->heart_rate as $key=>$heart_rate)
                                @if($heart_rate != null)
                                    <label id="heart_rate">{{$vital_signs_header->heart_rate[$key]}}</label>
                                    @break
                                @endif
                            @endforeach

                        </td>
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <label id="pain_label">Pain: </label>
                            @foreach($vital_signs_header->pain as $key=>$pain)
                                @if($pain != null)
                                    <label id="pain">{{$vital_signs_header->pain[$key]}}</label>
                                    @break
                                @endif
                            @endforeach
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