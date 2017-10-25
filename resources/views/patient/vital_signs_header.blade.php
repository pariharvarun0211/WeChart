@section('content')
    {{--@parent--}}
 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

<!--This is a container for vital signs header -->
<div class="container-fluid" style="padding-top: 0;margin-top:0; padding-bottom: 0;margin-bottom: 0;">
    <div class="row" >    
        <div class="panel-heading" style="padding-left: 0">
            <a href="{{url('/StudentHome')}}" class="btn btn-success" style="float: left">
                <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                Back to Dashboard
            </a>
            <h3 align="center" style="margin-top: 0;"><b>Patient Active Record</b></h3>
             <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo" style="float: right">
                <i class="fa fa-window-minimize" aria-hidden="true"></i>
            </button>
        </div>
        <div id="demo" class="panel-body collapse in" style="margin-bottom: 0;padding-bottom: 0;background-color: #FFFAF0;margin-top: 0;padding-top: 0">
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
