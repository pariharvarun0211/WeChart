@extends('layouts.app')
@extends('patient.vital_signs_header')
@section('Maincontent')
    {{--@parent--}}



    {{--<!--down one is required-->--}}
    {{--<!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script-->--}}
    {{--<link href="http://demo.expertphp.in/css/jquery.ui.autocomplete.css" rel="stylesheet">--}}
    {{--<script src="http://demo.expertphp.in/js/jquery.js"></script>--}}
    {{--<script src="http://demo.expertphp.in/js/jquery-ui.min.js"></script>--}}

    {{--Three Panels--}}
    <div class="container-fluid" style="margin-top: 0;padding-top: 0;padding-left: 1%">
        <div class="row" style="border: solid;padding-top: 0;border-top:0;">
            {{--Navigation Panel--}}
            <div class="col-md-2" style="float: left;padding-left: 0;padding-right: 0">
                <ul class="list-group" style="cursor: pointer">
                    {{--Adding Demographics to existing nav modules--}}
                    <a class="list-group-item active"  id="Demographics_tab" href="{{ URL::route('Demographics', $patient->patient_id)}}">
                        <b>Demographics</b>
                    </a>

                    @foreach ($navs as $key=>$nav)
                        <a class="list-group-item" id="{{$nav[0]}}_tab" href="{{ URL::route($nav[0], $patient->patient_id)}}" onclick="selectTab({{$key}})" >
                           <b>{{ $nav[0] }}</b>
                        </a>
                    @endforeach
                </ul>
            </div>

            {{--Documentation Panel--}}
            <div class="col-md-7" style="border-right: solid;border-left:solid;padding-left: 0">
                @yield('documentation_panel')
            </div>

            {{--Pink Panel--}}
            <div class="col-md-3" style="float: right;background-color: lightpink;" id="pink_panel">
                Pink Panel
            </div>

        </div>
    </div>

    {{--<script>--}}
        {{--function selectTab(index){--}}
            {{--@foreach ($navs as $key1=>$nav)--}}
                {{--$('#{{$nav[0]}}_tab').css({"background-color":"red"});--}}
            {{--@endforeach--}}
        {{--};--}}
    {{--</script>--}}
@endsection