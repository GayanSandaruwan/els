@extends('layouts.admin-lite')
@section('title')
    View Lessons
@endsection
@section('page-header')
    View Lessons
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Lessons</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-10">
                <h1>Unit 1</h1>
                @isset($assignments)
                    @foreach($assignments as $assignment)
                        @if($assignment->Unit==1)
                            <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                <h2>{{$assignment->quiz_name}}</h2>
                                {{--                        <div class="card">--}}
                                <div class="card-header">Create By - {{$assignment->created_by}}</div>
                                <div class="card-body">Create at - {{$assignment->created_at}}</div>
                                <div class="card" align="center">
                                    {{--                                <div class="card" align="center">--}}
                                    <form method="get" action={{$assignment->path}}>
                                        <button id="download" align="center" style="margin-bottom:15px; width: 500px;" type="button" onclick="window.open('{{$assignment->path}}')" class="btn btn-primary" data-dismiss="modal">Download</button>
                                    </form>
                                </div>
                                {{--                            </div>--}}
                                {{--                            <div class="row">--}}
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <button class="btn-primary">Activate</button>--}}
                                {{--                                </div>--}}
                            </div>
                            {{--                        </div>--}}
                            <br/>
                        @endif
                    @endforeach
                @endisset
            </div>





            <div class="col-md-10">
                <h1>Unit 2</h1>
                @isset($assignments)
                    @foreach($assignments as $assignment)
                        @if($assignment->Unit==2)
                            <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                <h2>{{$assignment->quiz_name}}</h2>
                                {{--                        <div class="card">--}}
                                <div class="card-header">Create By - {{$assignment->created_by}}</div>
                                <div class="card-body">Create at - {{$assignment->created_at}}</div>
                                <div class="card" align="center">
                                    {{--                                <div class="card" align="center">--}}
                                    <form method="get" action={{$assignment->path}}>
                                        <button id="download" align="center" style="margin-bottom:15px; width: 500px;" type="button" onclick="window.open('{{$assignment->path}}')" class="btn btn-primary" data-dismiss="modal">Download</button>
                                    </form>
                                </div>
                                {{--                            </div>--}}
                                {{--                            <div class="row">--}}
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <button class="btn-primary">Activate</button>--}}
                                {{--                                </div>--}}
                            </div>
                            {{--                        </div>--}}
                            <br/>
                        @endif
                    @endforeach
                @endisset
            </div>


            <div class="col-md-10">
                <h1>Unit 3</h1>
                @isset($assignments)
                    @foreach($assignments as $assignment)
                        @if($assignment->Unit==3)
                            <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                <h2>{{$assignment->quiz_name}}</h2>
                                {{--                        <div class="card">--}}
                                <div class="card-header">Create By - {{$assignment->created_by}}</div>
                                <div class="card-body">Create at - {{$assignment->created_at}}</div>
                                <div class="card" align="center">
                                    {{--                                <div class="card" align="center">--}}
                                    <form method="get" action={{$assignment->path}}>
                                        <button id="download" align="center" style="margin-bottom:15px; width: 500px;" type="button" onclick="window.open('{{$assignment->path}}')" class="btn btn-primary" data-dismiss="modal">Download</button>
                                    </form>
                                </div>
                                {{--                            </div>--}}
                                {{--                            <div class="row">--}}
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <button class="btn-primary">Activate</button>--}}
                                {{--                                </div>--}}
                            </div>
                            {{--                        </div>--}}
                            <br/>
                        @endif
                    @endforeach
                @endisset
            </div>

            <div class="col-md-10">
                <h1>Unit 4</h1>
                @isset($assignments)
                    @foreach($assignments as $assignment)
                        @if($assignment->Unit==4)
                            <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                <h2>{{$assignment->quiz_name}}</h2>
                                {{--                        <div class="card">--}}
                                <div class="card-header">Create By - {{$assignment->created_by}}</div>
                                <div class="card-body">Create at - {{$assignment->created_at}}</div>
                                <div class="card" align="center">
                                    {{--                                <div class="card" align="center">--}}
                                    <form method="get" action={{$assignment->path}}>
                                        <button id="download" align="center" style="margin-bottom:15px; width: 500px;" type="button" onclick="window.open('{{$assignment->path}}')" class="btn btn-primary" data-dismiss="modal">Download</button>
                                    </form>
                                </div>
                                {{--                            </div>--}}
                                {{--                            <div class="row">--}}
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <button class="btn-primary">Activate</button>--}}
                                {{--                                </div>--}}
                            </div>
                            {{--                        </div>--}}
                            <br/>
                        @endif
                    @endforeach
                @endisset
            </div>


            <div class="col-md-10">
                <h1>Unit 4</h1>
                @isset($assignments)
                    @foreach($assignments as $assignment)
                        @if($assignment->Unit==4)
                            <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                <h2>{{$assignment->quiz_name}}</h2>
                                {{--                        <div class="card">--}}
                                <div class="card-header">Create By - {{$assignment->created_by}}</div>
                                <div class="card-body">Create at - {{$assignment->created_at}}</div>
                                <div class="card" align="center">
                                    {{--                                <div class="card" align="center">--}}
                                    <form method="get" action={{$assignment->path}}>
                                        <button id="download" align="center" style="margin-bottom:15px; width: 500px;" type="button" onclick="window.open('{{$assignment->path}}')" class="btn btn-primary" data-dismiss="modal">Download</button>
                                    </form>
                                </div>
                                {{--                            </div>--}}
                                {{--                            <div class="row">--}}
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <button class="btn-primary">Activate</button>--}}
                                {{--                                </div>--}}
                            </div>
                            {{--                        </div>--}}
                            <br/>
                        @endif
                    @endforeach
                @endisset
            </div>

            <div class="col-md-10">
                <h1>Unit 5</h1>
                @isset($assignments)
                    @foreach($assignments as $assignment)
                        @if($assignment->Unit==5)
                            <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                <h2>{{$assignment->quiz_name}}</h2>
                                {{--                        <div class="card">--}}
                                <div class="card-header">Create By - {{$assignment->created_by}}</div>
                                <div class="card-body">Create at - {{$assignment->created_at}}</div>
                                <div class="card" align="center">
                                    {{--                                <div class="card" align="center">--}}
                                    <form method="get" action={{$assignment->path}}>
                                        <button id="download" align="center" style="margin-bottom:15px; width: 500px;" type="button" onclick="window.open('{{$assignment->path}}')" class="btn btn-primary" data-dismiss="modal">Download</button>
                                    </form>
                                </div>
                                {{--                            </div>--}}
                                {{--                            <div class="row">--}}
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <button class="btn-primary">Activate</button>--}}
                                {{--                                </div>--}}
                            </div>
                            {{--                        </div>--}}
                            <br/>
                        @endif
                    @endforeach
                @endisset
            </div>

            <div class="col-md-10">
                <h1>Unit 6</h1>
                @isset($assignments)
                    @foreach($assignments as $assignment)
                        @if($assignment->Unit==6)
                            <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                <h2>{{$assignment->quiz_name}}</h2>
                                {{--                        <div class="card">--}}
                                <div class="card-header">Create By - {{$assignment->created_by}}</div>
                                <div class="card-body">Create at - {{$assignment->created_at}}</div>
                                <div class="card" align="center">
                                    {{--                                <div class="card" align="center">--}}
                                    <form method="get" action={{$assignment->path}}>
                                        <button id="download" align="center" style="margin-bottom:15px; width: 500px;" type="button" onclick="window.open('{{$assignment->path}}')" class="btn btn-primary" data-dismiss="modal">Download</button>
                                    </form>
                                </div>
                                {{--                            </div>--}}
                                {{--                            <div class="row">--}}
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <button class="btn-primary">Activate</button>--}}
                                {{--                                </div>--}}
                            </div>
                            {{--                        </div>--}}
                            <br/>
                        @endif
                    @endforeach
                @endisset
            </div>

            <div class="col-md-10">
                <h1>Unit 7</h1>
                @isset($assignments)
                    @foreach($assignments as $assignment)
                        @if($assignment->Unit==7)
                            <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                <h2>{{$assignment->quiz_name}}</h2>
                                {{--                        <div class="card">--}}
                                <div class="card-header">Create By - {{$assignment->created_by}}</div>
                                <div class="card-body">Create at - {{$assignment->created_at}}</div>
                                <div class="card" align="center">
                                    {{--                                <div class="card" align="center">--}}
                                    <form method="get" action={{$assignment->path}}>
                                        <button id="download" align="center" style="margin-bottom:15px; width: 500px;" type="button" onclick="window.open('{{$assignment->path}}')" class="btn btn-primary" data-dismiss="modal">Download</button>
                                    </form>
                                </div>
                                {{--                            </div>--}}
                                {{--                            <div class="row">--}}
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <button class="btn-primary">Activate</button>--}}
                                {{--                                </div>--}}
                            </div>
                            {{--                        </div>--}}
                            <br/>
                        @endif
                    @endforeach
                @endisset
            </div>

            <div class="col-md-10">
                <h1>Unit 8</h1>
                @isset($assignments)
                    @foreach($assignments as $assignment)
                        @if($assignment->Unit==8)
                            <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                <h2>{{$assignment->quiz_name}}</h2>
                                {{--                        <div class="card">--}}
                                <div class="card-header">Create By - {{$assignment->created_by}}</div>
                                <div class="card-body">Create at - {{$assignment->created_at}}</div>
                                <div class="card" align="center">
                                    {{--                                <div class="card" align="center">--}}
                                    <form method="get" action={{$assignment->path}}>
                                        <button id="download" align="center" style="margin-bottom:15px; width: 500px;" type="button" onclick="window.open('{{$assignment->path}}')" class="btn btn-primary" data-dismiss="modal">Download</button>
                                    </form>
                                </div>
                                {{--                            </div>--}}
                                {{--                            <div class="row">--}}
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <button class="btn-primary">Activate</button>--}}
                                {{--                                </div>--}}
                            </div>
                            {{--                        </div>--}}
                            <br/>
                        @endif
                    @endforeach
                @endisset
            </div>

            <div class="col-md-10">
                <h1>Unit 9</h1>
                @isset($assignments)
                    @foreach($assignments as $assignment)
                        @if($assignment->Unit==9)
                            <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                <h2>{{$assignment->quiz_name}}</h2>
                                {{--                        <div class="card">--}}
                                <div class="card-header">Create By - {{$assignment->created_by}}</div>
                                <div class="card-body">Create at - {{$assignment->created_at}}</div>
                                <div class="card" align="center">
                                    {{--                                <div class="card" align="center">--}}
                                    <form method="get" action={{$assignment->path}}>
                                        <button id="download" align="center" style="margin-bottom:15px; width: 500px;" type="button" onclick="window.open('{{$assignment->path}}')" class="btn btn-primary" data-dismiss="modal">Download</button>
                                    </form>
                                </div>
                                {{--                            </div>--}}
                                {{--                            <div class="row">--}}
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <button class="btn-primary">Activate</button>--}}
                                {{--                                </div>--}}
                            </div>
                            {{--                        </div>--}}
                            <br/>
                        @endif
                    @endforeach
                @endisset
            </div>

            <div class="col-md-10">
                <h1>Unit 10</h1>
                @isset($assignments)
                    @foreach($assignments as $assignment)
                        @if($assignment->Unit==10)
                            <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                <h2>{{$assignment->quiz_name}}</h2>
                                {{--                        <div class="card">--}}
                                <div class="card-header">Create By - {{$assignment->created_by}}</div>
                                <div class="card-body">Create at - {{$assignment->created_at}}</div>
                                <div class="card" align="center">
                                    {{--                                <div class="card" align="center">--}}
                                    <form method="get" action={{$assignment->path}}>
                                        <button id="download" align="center" style="margin-bottom:15px; width: 500px;" type="button" onclick="window.open('{{$assignment->path}}')" class="btn btn-primary" data-dismiss="modal">Download</button>
                                    </form>
                                </div>
                                {{--                            </div>--}}
                                {{--                            <div class="row">--}}
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <button class="btn-primary">Activate</button>--}}
                                {{--                                </div>--}}
                            </div>
                            {{--                        </div>--}}
                            <br/>
                        @endif
                    @endforeach
                @endisset
            </div>

            <div class="col-md-10">
                <h1>Unit 11</h1>
                @isset($assignments)
                    @foreach($assignments as $assignment)
                        @if($assignment->Unit==11)
                            <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                <h2>{{$assignment->quiz_name}}</h2>
                                {{--                        <div class="card">--}}
                                <div class="card-header">Create By - {{$assignment->created_by}}</div>
                                <div class="card-body">Create at - {{$assignment->created_at}}</div>
                                <div class="card" align="center">
                                    {{--                                <div class="card" align="center">--}}
                                    <form method="get" action={{$assignment->path}}>
                                        <button id="download" align="center" style="margin-bottom:15px; width: 500px;" type="button" onclick="window.open('{{$assignment->path}}')" class="btn btn-primary" data-dismiss="modal">Download</button>
                                    </form>
                                </div>
                                {{--                            </div>--}}
                                {{--                            <div class="row">--}}
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <button class="btn-primary">Activate</button>--}}
                                {{--                                </div>--}}
                            </div>
                            {{--                        </div>--}}
                            <br/>
                        @endif
                    @endforeach
                @endisset
            </div>

            <div class="col-md-10">
                <h1>Unit 12</h1>
                @isset($assignments)
                    @foreach($assignments as $assignment)
                        @if($assignment->Unit==12)
                            <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                <h2>{{$assignment->quiz_name}}</h2>
                                {{--                        <div class="card">--}}
                                <div class="card-header">Create By - {{$assignment->created_by}}</div>
                                <div class="card-body">Create at - {{$assignment->created_at}}</div>
                                <div class="card" align="center">
                                    {{--                                <div class="card" align="center">--}}
                                    <form method="get" action={{$assignment->path}}>
                                        <button id="download" align="center" style="margin-bottom:15px; width: 500px;" type="button" onclick="window.open('{{$assignment->path}}')" class="btn btn-primary" data-dismiss="modal">Download</button>
                                    </form>
                                </div>
                                {{--                            </div>--}}
                                {{--                            <div class="row">--}}
                                {{--                                <div class="col-md-6">--}}
                                {{--                                    <button class="btn-primary">Activate</button>--}}
                                {{--                                </div>--}}
                            </div>
                            {{--                        </div>--}}
                            <br/>
                        @endif
                    @endforeach
                @endisset
            </div>





            </div>
        </div>

    <!-- /.modal -->
@endsection
@section('additional-scripts')
    <script type="text/javascript">
        $('.select2').select2();
        @isset($success_parent)
        $('#user-registered-modal').modal('show');
        @endisset
        // $('input:checked').removeAttr('checked');
        //
        // $("#download").click(function(link) {
        //     // // hope the server sets Content-Disposition: attachment!
        //     window.location = link;
        // });

    </script>
@endsection
