@extends('layouts.admin-lite')
@section('title')
    Upload Assignment
@endsection
@section('page-header')
    Upload Assignment
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Teacher</a></li>
        <li class="active">Add Assignment</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @isset($new_ass)
                        <script>
                            console.log("Test")
                        </script>
                        <div class="card-header" style="color: green; font-size: large">Successfully Added new Assignment {{$new_ass->id }}</div>
                    @endisset
                    <div class="card-body">
                        <form method="POST" action="{{ route('uploadAss') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Assignment Name') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" id="assName"
                                            name="assName" class="form-control @error('assName') is-invalid @enderror" name="assName" value="{{ old('assName') }}" required autofocus>

                                    @error('date')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('Assignment File') }}</label>

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
                    <h4 class="modal-title text-center">Successfully Added the time slot</h4>
                </div>
                <div class="modal-body">
                    <img src="/images/success.png" class="center-block" style="width: 100px">
                    @isset($new_ass)
                        <h4 class="modal-title text-center">Student with quiz id: {{$new_ass->id}} successfully Added</h4>
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
@endsection
@section('additional-scripts')
    <script type="text/javascript">
        function SetMinDate() {
            var date = new Date();
            $('#date').val(new Date(date.getTime() - (date.getTimezoneOffset() * 60000)).toJSON().slice(0,16));
        }

        SetMinDate();
        $('[data-mask]').inputmask()
        @isset($new_ass)
        $('#user-registered-modal').modal('show');
                @endisset

        var dateToday = new Date();

    </script>
@endsection
