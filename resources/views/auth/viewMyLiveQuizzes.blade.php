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
            <div class="col-md-10">
                @isset($quizzes)
                    @foreach($quizzes as $quiz)
                        <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 2px;">

                        <h2>{{$quiz->quiz_name}}</h2>
                            <div class="card-header"><strong>Create By -</strong> {{$quiz->created_by}}</div>
                            <div class="card-body"><strong>Create at -</strong>{{$quiz->created_at}}</div>
                            <div class="card-body"><strong>Marks -</strong> {{$quiz->mark}}</div>
                            @if($quiz->active==True)
                                <form method="get" action={{$quiz->url}}>
                                    <button id="view" type="button" onclick="window.open('quiz/{{$quiz->url}}')" class="btn btn-primary" data-dismiss="modal">Attempt Quiz</button>
                                </form>
                            @else()
                                <div><strong>No attempted are allowed!</strong></div>
                            @endif
{{--                            <div class="card" style="background-color: whitesmoke ; padding: 10px; padding-bottom: 0px;">--}}



{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <button class="btn-primary">Activate</button>--}}
{{--                                </div>--}}
                        </div>
                    <br/>
{{--                        </div>--}}



                    @endforeach
                @endisset
                </div>

{{--        </div>--}}
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
