@extends('layouts.admin-lite')
@section('title')
    View Assignments
@endsection
@section('page-header')
    View Assignments
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Student</a></li>
        <li class="active">Assignment</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @isset($assignments)
                    @foreach($assignments as $assignment)
                        <h2>{{$assignment->quiz_name}}r</h2>
                        <div class="card">
                            <div class="card-header">Create By - {{$assignment->created_by}}</div>
                            <div class="card-body">Create at - {{$assignment->created_at}}</div>
                            <form method="get" action={{$assignment->path}}>
                                 <button id="download" type="button" onclick="window.open('{{$assignment->path}}')" class="btn btn-primary" data-dismiss="modal">Download</button>
                            </form>
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <button class="btn-primary">Activate</button>--}}
{{--                                </div>--}}
                        </div>
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
