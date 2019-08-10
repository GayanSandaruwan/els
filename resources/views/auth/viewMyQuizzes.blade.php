@extends('layouts.admin-lite')
@section('title')
    View My Quizzes
@endsection
@section('page-header')
    View My Quizzes
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Student</a></li>
        <li class="active">Quizzes</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @isset($quizzes)
                    @foreach($quizzes as $quiz)
                        <h2>{{$quiz->quiz_name}}</h2>
                        <div class="card">
                            <div class="card-header">Create By - {{$quiz->created_by}}</div>
                            <div class="card-body">Create at - {{$quiz->created_at}}</div>
                            <div class="card-body">Marks - {{$quiz->mark}}</div>
                            @if($quiz->active==True)
                                <form method="get" action={{$quiz->url}}>
                                    <button id="view" type="button" onclick="window.open('quiz/{{$quiz->url}}')" class="btn btn-primary" data-dismiss="modal">Attempt Quiz</button>
                                </form>
                            @else()
                                <div>No attempted are allowed</div>
                            @endif
                            <h4>Parent Comments</h4>
                            <div id="body{{$quiz->id}}" class="panel-body panel-height" style="overflow-y:auto">
                                @isset($comments[$loop->index])

                                    @foreach($comments[$loop->index] as $ct)
                                        <ui class="left clearfix" id="list">
                                            <div class="chat-body clearfix">
                                                <div class="header">
                                                    <strong class="primary-font">{{$ct->úser_name}}  Created at -[{{$ct->created_at}}]</strong>
                                                </div>
                                                <p>{{$ct->comment}}</p>
                                            </div>
                                        </ui>
                                    @endforeach
                                @endisset
                            </div>


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
