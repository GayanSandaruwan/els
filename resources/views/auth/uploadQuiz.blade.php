@extends('layouts.admin-lite')
@section('title')
    Upload Quiz
@endsection
@section('page-header')
    Upload Quiz
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Teacher</a></li>
        <li class="active">Add Quiz</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @isset($new_quiz)
                        <script>
                            console.log("Test")
                        </script>
                        <div class="card-header" style="color: green; font-size: large">Successfully Added new Quiz {{$new_quiz->id }}</div>
                    @endisset
                    <div class="card-body">
                        <form method="POST" action="{{ route('uploadQuiz') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Unit') }}</label>

                                <div class="col-md-6">
                                    <select id="unit" name="unit" data-placeholder="Select a student" class="selectpicker"  data-live-search="true" required>
                                        <option value=1>Unit 1</option>
                                        <option value=2>Unit 2</option>
                                        <option value=3>Unit 3</option>
                                        <option value=4>Unit 4</option>
                                        <option value=5>Unit 5</option>
                                        <option value=6>Unit 6</option>
                                        <option value=7>Unit 7</option>
                                        <option value=8>Unit 8</option>
                                        <option value=9>Unit 9</option>
                                        <option value=10>Unit 10</option>
                                        <option value=11>Unit 11</option>
                                        <option value=12>Unit 12</option>
                                        <option value=13>Unit 13</option>
                                    </select>
                                    @error('date')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Quiz Name') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" id="quizName"
                                            name="quizName" class="form-control @error('quizName') is-invalid @enderror" name="quizName" value="{{ old('quizName') }}" required autofocus>

                                    @error('date')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('Quiz File') }}</label>

                                <div class="col-md-6">
                                    <input  type="file" id="fileToUpload"
                                            name="fileToUpload" class="form-control @error('fileToUpload') is-invalid @enderror" name="fileToUpload" value="{{ old('fileToUpload') }}" required autofocus>


                                    @error('fileToUpload')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            @isset($students)
                                <div class="form-group row">
                                    <label for="parent_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Students') }}</label>

                                    <div class="col-md-6">
                                        <select id="students" name="students[]" data-placeholder="Select a student" class="selectpicker" multiple data-live-search="true" required autofocus>
                                            @foreach($students as $student)
                                                <option value={{$student->id}}>{{$student->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                        <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>
                                </div>
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
    </div>

    <div class="modal fade" id="user-registered-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">Successfully Uploaded the new quiz!</h4>
                </div>
                <div class="modal-body">
                    <img src="/images/success.png" class="center-block" style="width: 100px">
                    @isset($new_quiz)
                        <h4 class="modal-title text-center">Student with quiz id: {{$new_quiz->id}} successfully Added</h4>
                    @endisset
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


    //error
    <div class="modal fade" id="error">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">Couldn't upload!</h4>
                </div>
                <div class="modal-body">
                    <img src="/images/error.png" class="center-block" style="width: 100px">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@endsection
@section('additional-scripts')
    <script type="text/javascript">
        function SetMinDate() {
            var date = new Date();
            $('#date').val(new Date(date.getTime() - (date.getTimezoneOffset() * 60000)).toJSON().slice(0,16));
        }
        SetMinDate();

        $('[data-mask]').inputmask()
{{--        @isset($new_quiz)--}}
        @if (session()->has('new_quiz'))
          $('#user-registered-modal').modal('show');
          @endif

          @if (session()->has('error'))
          $('#error').modal('show');
                @endif
{{--                @endisset--}}

        var dateToday = new Date();

    </script>
@endsection
