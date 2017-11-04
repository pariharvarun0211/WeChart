@section('content')
    {{--@parent--}}
    <!--This is a container for vital signs header -->
    <div class="container-fluid" style="padding-top: 0;margin-top:0; padding-bottom: 0;margin-bottom: 0;">
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
                            <label id="name" >{{$patient->first_name}} {{$patient->last_name}}</label>
                        </td>
                        <td style="padding-top: 0;padding-bottom: 0%">
                            <label id="age_label">Age: </label>
                            <label id="age">{{$patient->age}} </label>
                        </td>
                        <td style="padding-top: 0;padding-bottom: 0%">
                            <label id="sex_label">Sex:</label>
                            <label id="sex">{{$patient->gender}}</label>
                        </td>
                        <td style="padding-top: 0;padding-bottom: 0%">
                            <label id="room_number_label">Room No:</label>
                            <label id="room_number">{{$patient->room_number}}</label>
                        </td>
                        <td style="padding-top: 0;padding-bottom: 0%">
                            <label id="bp_systolic_label" style="align-self: center">Blood Pressure (BP) Systolic: </label>
                            {{--<label id="bp_systolic">{{$patient->bp}}</label>--}}
                        </td>
                        <td style="padding-top: 0;padding-bottom: 0%">
                            <label id="RR_label" style="align-self: center">Respiratory Rate (RR):</label>
                            {{--<label id="rr">{{$patient->rr}}</label>--}}
                        </td>

                    </tr>
                    <!--This is the second row in the vital signs panel -->
                    <tr style="padding-top: 0;padding-bottom: 0%; border-style: hidden">
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <label id="temperature_label">Temperature:</label>
                            {{--<label id="temperature">{{$patient->temperature}}</label>--}}
                        </td>
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <label id="oxygen_saturation_label">Oxygen Saturation:</label>
                            {{--<label id="oxygen_saturation">{{$patient->oxygen_saturation}}</label>--}}
                        </td>
                        {{--</tr>--}}
                        {{--<tr style="padding-top: 0;padding-bottom: 0%; border-style: hidden">--}}
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <label id="bp_diastolic_label">Blood Pressure (BP) Diastolic: </label>
                            {{--<label id="bp_diastolic">{{$patient->bp_diastolic}}</label>--}}
                        </td>
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <label id="hr_label">Heart Rate (HR): </label>
                            {{--<label id="hr">{{$patient->hr}}</label>--}}
                        </td>
                        <td style="padding-top: 0%;padding-bottom: 0%">
                            <label id="pain_label">Pain: </label>
                            {{--<label id="pain">{{$patient->pain}}</label>--}}
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