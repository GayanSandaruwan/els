@extends('layouts.admin-lite')
@section('title')
    Request Slot
@endsection
@section('page-header')
    Request Slot
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Request Slot</a></li>
        <li class="active">Request Slot</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @isset($new_request)
                        <script>
                            console.log("Test")
                        </script>
                        <div class="card-header" style="color: green; font-size: large">Successfully Added A New Slot Request {{$new_request->id }}</div>
                    @endisset
                    <div class="card-body">
                        <form method="POST" action="{{ route('submitTimeRequest') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Subject') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" id="quizName"
                                            name="quizName" class="form-control @error('quizName') is-invalid @enderror" name="quizName" value="11 ICT" readonly required autofocus>



                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Reason') }}</label>

                                <div class="col-md-6">
                                    <input  type="text" id="reason"
                                            name="reason" class="form-control @error('reason') is-invalid @enderror" name="quizName" required autofocus>
                                    @error('reason')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror

                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Request a Slot') }}
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
@endsection
@section('additional-scripts')
    <script type="text/javascript">


{{--        @if (session()->has('new_request'))--}}
{{--        $('#user-registered-modal').modal('show');--}}
{{--        console.log("Goi the shit")--}}
{{--        @endif--}}

        @isset($new_request)
            $('#user-registered-modal').modal('show');
            console.log("Goi the shit")
        @endisset

    </script>
@endsection
