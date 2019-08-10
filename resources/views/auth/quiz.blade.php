@extends('layouts.admin-lite')
@section('title')
    Quiz
@endsection
@section('page-header')
    Quiz
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Student</a></li>
        <li class="active">Quiz</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('submitQuiz') }}" onsubmit="submitForm()" enctype="multipart/form-data">
                            @csrf
                            @isset($url)
                              <input name="quizUrl" type="hidden" value="{{$url}}">
                            @endisset
                            @isset($questions)
                                @foreach($questions as $question)
                                <div class="form-group row">
                                    <fieldset id="{{$question->id}}">
                                        <legend>{{$question->question}}</legend>
                                        <div class="col-md-3">
                                            <input type="radio" name="{{$question->id}}" id="nameA" value="A">
                                            <label for="nameA">{{$question->A}}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="{{$question->id}}" id="nameA" value="B">
                                            <label for="nameA">{{$question->B}}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="{{$question->id}}" id="nameA" value="C">
                                            <label for="nameA">{{$question->C}}</label>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="radio" name="{{$question->id}}" id="nameA" value="D">
                                            <label for="nameA">{{$question->D}}</label>
                                        </div>
                                    </fieldset>
                                    @error('student_id')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                @endforeach
                            @endisset
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Submit') }}
                                    </button>

                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- /.modal -->
    <div class="modal fade" id="modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">Successfully Added submited</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="window.close()" data-dismiss="modal">Close</button>
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


        @isset($submitted)
        $('#modal').modal('show');
        @endisset


    </script>
@endsection
