@extends('layouts.app')
@extends('patient.vital_signs_header')
@section('Maincontent')
    {{--@parent--}}

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    {{--Three Panels--}}
    <div class="container-fluid" style="margin-top: 0;padding-top: 0;padding-left: 1%;">
        <div class="row" style="border: solid;padding-top: 0;border-top:0;">
            {{--Navigation Panel--}}
            <div class="col-md-2" style="float: left;padding-left: 0;padding-right: 0">
                <ul class="list-group" style="cursor: pointer">
                    <li class="list-group-item">
                        {{--Adding Demographics to existing nav modules--}}
                        <a
                                id="Demographics_tab"
                                href="{{ URL::route('Demographics', $patient->patient_id)}}"
                        >
                            <b>Demographics</b>
                        </a>
                    </li>

                    @foreach ($navs as $key=>$nav)
                        @if($nav[0]->parent_id === NULL)
                            <li class="list-group-item">
                                <a id="{{$nav[0]->navigation_name}}_tab" href="{{ URL::route($nav[0]->navigation_name, $patient->patient_id)}}">
                                   <b>{{ $nav[0]->navigation_name }}</b>
                                </a>
                            </li>
                        @else
                            <li class="list-group-item" style="padding-left: 20%">
                                <a id="{{$nav[0]->navigation_name}}_tab" href="{{ URL::route($nav[0]->navigation_name.$nav[0]->parent_id, $patient->patient_id)}}">
                                    <b>{{ $nav[0]->navigation_name }}</b>
                                </a>
                            </li>
                        @endif
                    @endforeach

                    <li class="list-group-item">
                        @if(!((count($disposition)> 0) && $status_id === 1))
                            <a href="{{ URL::route('AssignInstructor', $patient->patient_id) }}" class="btn btn-primary" id="submit-button" style="margin:auto; text-align:center; display:block; width:100%;" title = "assign instructor" disabled>Submit</a>
                        @else
                            <a href="{{ URL::route('AssignInstructor', $patient->patient_id) }}" class="btn btn-primary" id="submit-button" style="margin:auto; text-align:center; display:block; width:100%;" title = "assign instructor">Submit</a>
                        @endif
                    </li>
                </ul>
            </div>

            {{--Documentation Panel--}}
            <div class="col-md-7" style="border-right: solid;border-left:solid;padding-left: 0;margin-left: 0;padding-right: 0;margin-right: 0">
                @yield('documentation_panel')
            </div>

            {{--Pink Panel--}}
            <div class="col-md-3" style="float: right;background-color: lightpink;" id="pink_panel">
                Guidance Panel
            </div>

        </div>
    </div>

    <script>
//        $(".list-group-item").on("click", function() {
//            $('ul li').css('background-color','none');
//            $(this).css("background-color", "blue");
//        })
//    $('ul.list-group li.list-group-item a').click(function() {
//        $('ul.list-group li.list-group-item').css('background','none');
//        $(this).parent().css('background','red');
//    });
    </script>
@endsection