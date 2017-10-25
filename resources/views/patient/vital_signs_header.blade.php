@section('content')
    {{--@parent--}}
<!--This is a container for vital signs header -->
<div class="container-fluid" style="padding-top: 0;margin-top:0; padding-bottom: 0;margin-bottom: 0;">
    <div class="row" >
     <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">
        <i class="fa fa-window-minimize" aria-hidden="true"></i>
     </button>
        <div class="panel-heading" style="padding-left: 0">
            <a href="{{url('/StudentHome')}}" class="btn btn-success" style="float: left">
                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                Back to Dashboard
            </a>
            <h3 align="center" style="margin-top: 0;"><b>Patient Active Record</b></h3>
        </div>
        <div id="demo" class="panel-body collapse" style="margin-bottom: 0;padding-bottom: 0;background-color: #FFFAF0;margin-top: 0;padding-top: 0">
            <table class="table" style=" margin-top: 0;padding-top: 0;margin-bottom: 0;padding-bottom: 0">
                <!--This is the first row in the vital signs panel -->
                <tr style=" margin-top: 0;padding-top: 0;">
                    <td style="padding-left: 10%">
                        <label >Name: {{$patient->first_name}} {{$patient->last_name}}</label>
                    </td>
                    <td style="padding-left: 10%">
                        <label >Age: {{$patient->age}} </label>
                      </td>
                    <td style="padding-left: 10%">
                        <label >Sex: {{$patient->gender}}</label>
                    </td>
                </tr>

                <!--This is the second row in the vital signs panel -->
                <tr >
                    <td style="padding-left: 10%">
                        <label >Blood Pressure(BP)Systolic: </label>
                    </td>
                    <td style="padding-left: 10%">
                        <label >Respiratory Rate(RR):</label>
                    </td>
                    <td style="padding-left: 10%">
                        <label >Temperature:</label>
                    </td>
                </tr>
                <!--This is the third row in the vital signs panel -->
                <tr >
                <td style="padding-left: 10%">
                    <label >Blood Pressure(BP)Diastolic: </label>
                </td>
                <td style="padding-left: 10%">
                    <label >Heart Rate(HR): </label>
                </td>
                <td style="padding-left: 10%">
                    <label >Pain: </label>
                </td>
            </tr>
            </table>
        </div>
    </div>
    <div class="row" style="padding-bottom: 0;margin-bottom: 0">
        @yield('Maincontent')
    </div>
</div>
@endsection
