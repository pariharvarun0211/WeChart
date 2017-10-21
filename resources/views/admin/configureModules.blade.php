@extends('layouts.app')
@section('content')
    {{--<meta charset="utf-8">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
    {{--<meta name="viewport" content="width=device-width, initial-scale=1">--}}
    {{--<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">--}}
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />--}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <div class="container">
        <div class="row" style="padding-top: 0; margin: 0">
            <h3 align = "center">Active Modules</h3>
        </div>

        <div class="row">
            <div class="col-md-2">
                <a href="{{url('/home')}}" class="btn btn-success" >
                    <i class="fa fa-arrow-circle-left" aria-hidden="true"></i>
                    Back to Dashboard</a>
            </div>
            <div class="col-md-2 col-md-offset-8">
                    <a href="#" title="" class="btn btn-success" id="add-record" style="float: right">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add new Module</a>
            </div>
        </div>
        <br>
        <br>
        <div class="row" style="overflow-x: scroll;width: 1200px">
            <table class="table-responsive table-striped" border="2">
                <thead >
                <tr >
                    <td style="background-color:#5DADE2;">
                        <h5 style="width: 150px;margin-left: 1%;margin-right: 1%">
                        <b>Module/Navigations</b>
                        </h5>
                    </td>
                    <td style="background-color:#5DADE2;" align="middle">
                        <h5 style="width: 150px"><b>Demographics</b></h5>
                    </td>
                    @foreach ($navs as $nav)
                        <td  style="background-color:#5DADE2;"  align="middle">
                            <h5 style="padding-left: 1%;padding-right: 1%;width: 100px"><b>{{ $nav->navigation_name }}</b></h5>
                        </td>
                    @endforeach
                    <td>
                    </td>
                </tr>
                </thead>
                <tbody style="overflow-x: scroll">
                @if($mods->isEmpty())
                    <tr id="onetimedisplay">
                        <td colspan="5" height="100" style="border: none">
                            There are no active modules.<br> Please click the "Add Module" button to add module.
                        </td>
                    </tr>

                @else
                @foreach ($mods as $mod)
                    <tr style="overflow-x: scroll">
                        <td align="middle">
                            {{ $mod->module_name }}
                        </td>
                        <td align="middle">
                            <input type="checkbox" checked onclick="return false">
                        </td>
                        @foreach ($navs as $nav)
                            <td align="middle">
                                <?php $check = 0; ?>
                                @foreach($navs_mods as $nm)
                                    @if($nm->module_id == $mod->module_id && $nm->navigation_id == $nav->navigation_id && $nm->visible ==1)
                                        <?php $check = 1; ?>
                                        @break;
                                    @else
                                        <?php $check = 0; ?>
                                    @endif
                                @endforeach

                                @if ($check == 1)
                                    <input type="checkbox" class="form-check-input inline" checked="checked">
                                @else
                                    <input type="checkbox" class="form-check-input inline">
                                @endif
                            </td>
                        @endforeach

                        <td>
                            {{ Form::open(array('method' => 'post', 'route' => array('deletemodule', $mod->module_id))) }}
                                <div class="form-group">
                                    <button name="delbutton" class="btn btn-danger btn-delete">Delete</button>
                                </div>
                            {{ Form::close() }}
                        </td>
                    </tr>
                @endforeach
                @endif
                </tbody>
            </table>
        </div>
        <br>
        <br>

        {{ Form::open(array('method' => 'post', 'route' => array('submitmodule'))) }}
        <div class="row" id="childTable" style="overflow-x: scroll;width: 1200px">
        <table border="2" >
            <tr>
                <td style="background-color:#5DADE2;width:200px "><b>Module/Navigations</b></td>
                @foreach ($navs as $nav)
                    <td style="background-color:#5DADE2" align="center">
                        <h5 style="padding-left: 1%;padding-right: 1%;width: 100px"> <b>{{ $nav->navigation_name }}</b>   </h5>
                    </td>
                @endforeach
            </tr>
            <tr>
               <td align="middle">
                   {{ Form::text('modulename', "") }}
               </td>
               @foreach ($navs as $nav)
                   <td align="middle">
                       {{ Form::checkbox('navs[]', $nav->navigation_id) }}
                   </td>
               @endforeach
               <td>
                   <button name="submitbutton" class="btn btn-success btn-submit">Add</button>
               </td>
            </tr>
        </table>
        </div>
        {{ Form::close() }}

    </div>

    <script>
        $(document).ready(function(){
            $('#childTable').hide();
            $("#add-record").click(function(){
                $('#onetimedisplay').hide();
                $('#childTable').show();
                $("#add-record").hide();
            });
        });
    </script>

@endsection



