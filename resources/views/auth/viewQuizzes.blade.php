@extends('layouts.admin-lite')
@section('title')
    View Quizzes
@endsection
@section('page-header')
    View Quizzes
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Student</a></li>
        <li class="active">View Quizzes</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @isset($quizzes)
                    @foreach($quizzes as $quiz)
                        <h2>{{$quiz->quiz_name}}r</h2>
                        <div class="card">
                            <form method="POST" action="{{ route('updateQuiz') }}" enctype="multipart/form-data">
                                @csrf
                            <div class="card-header">Create By - {{$quiz->created_by}}</div>
                            <div class="card-body">Create at - {{$quiz->created_at}}</div>
                                <div class="row">
                                    <div class="col-md-4">
{{--                                         <input type="text" id="myInput{{$quiz->id}}"  readonly value='/quiz/{{$quiz->url}}' >--}}
                                            <input type="text" name="id" id="myInput{{$quiz->id}}"  readonly value=$quiz->id >
                                    </div>
                                </div>
                            <div class="row">
                                <div class="col-md-2">
                                    @if($quiz->state=='deactivate')
                                    <button id="state" type="submit"  class="btn btn-primary" data-dismiss="modal">Activate</button>
                                        <input id="newState" name="newState" type="hidden" value="active">

                                    @else()
                                    <button id="state" type="submit"  class="btn btn-primary" data-dismiss="modal">Deactivate</button>
                                        <input id="newState" name="newState" type="hidden" value="deactivate">
                                     @endif
                                </div>
                                <div class="col-md-2">
{{--                                    <form method="get" action={{$quiz->path}}>--}}
                                        <button id="download" type="button" onclick="myFunction({{$quiz->id}})" class="btn btn-primary" data-dismiss="modal">Copy Link</button>
{{--                                    </form>--}}
                                </div>
                            </div>
                            </form>
                        </div>
                    @endforeach
                @endisset
                </div>
            </div>
        </div>
    <div class="modal fade" id="user-registered-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">Successfully Copied the Link</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


    <!-- /.modal -->
@endsection
@section('additional-scripts')
    <script type="text/javascript">

        $('.select2').select2();


        // $('input:checked').removeAttr('checked');
        //
        // $("#download").click(function(link) {
        //     // // hope the server sets Content-Disposition: attachment!
        //     window.location = link;
        // });
        function myFunction(id) {
            var copyText = document.getElementById("myInput"+id);
            copyText.select();
            document.execCommand("copy");
            $('#user-registered-modal').modal('show');
        }

    </script>
@endsection
