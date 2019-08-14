@extends('layouts.admin-lite')
@section('title')
    Edit Student
@endsection
@section('page-header')
    Edit Student
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Edit Student</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @isset($student)
                <div class="card">
                    @isset($new_user)
                        <div class="card-header" style="color: green; font-size: large">Successfully edited {{$new_user->email }}</div>
                    @endisset
                    <div class="card-body">
                        <form method="POST" action="{{ route('editStudent') }}" enctype="multipart/form-data">
                            @csrf
{{--                            <input type="hidden" name="teacherId" t>--}}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $student->name }}" required autocomplete="name" autofocus>

                                    @error('name')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $student->email }}" required autocomplete="email" readonly>

                                    @error('email')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                                <div class="col-md-6">
                                    <input id="address" type="address" class="form-control @error('email') is-invalid @enderror" name="address" value="{{ $student->address}}" required>

                                    @error('address')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="grade" class="col-md-4 col-form-label text-md-right">{{ __('Grade') }}</label>

                                <div class="col-md-6">
                                    <input id="grade" type="number" class="form-control @error('grade') is-invalid @enderror" name="grade" value="{{ $student->grade}}" required autofocus>

                                    @error('grade')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date Of Birth') }}</label>

                                <div class="col-md-6">
                                    <input id="dob" type="text" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ $student->dob }}" required autofocus>

                                    @error('dob')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                                <div class="col-md-6">
                                    <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{ $student->contact }}" required autofocus data-inputmask='"mask": "(999) 999-9999"' data-mask>

                                    @error('contact')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
{{--                            <div class="form-group row">--}}
{{--                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">--}}

{{--                                    @error('password')--}}
{{--                                    <span class="help-block" style="color:red" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                    @enderror--}}
{{--                                </div>--}}
{{--                            </div>--}}

{{--                            <div class="form-group row">--}}
{{--                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>--}}

{{--                                <div class="col-md-6">--}}
{{--                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            {{--<div class="form-group row">--}}
                                {{--<label for="profile_picture" class="col-md-4 col-form-label text-md-right">{{ __('Profile Picture') }}</label>--}}

                                {{--<div class="col-md-6">--}}
                                    {{--<input id="profile_picture" type="file" class="form-control" name="profile_picture" >--}}
                                    {{--@error('profile_picture')--}}
                                    {{--<span class="help-block" style="color:red" role="alert">--}}
                                        {{--<strong>{{ $message }}</strong>--}}
                                    {{--</span>--}}
                                    {{--@enderror--}}
                                {{--</div>--}}
                            {{--</div>--}}

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Edit Student') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
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
                    <h4 class="modal-title text-center">Successfully Edited the Student</h4>
                </div>
                <div class="modal-body">
                    <img src="/images/success.png" class="center-block" style="width: 100px">
                    @isset($new_user)
                        <h4 class="modal-title text-center">Teacher with email id: {{$new_user->email}} successfully Added</h4>
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
        {{--$('#datepicker').datepicker({--}}
        {{--autoclose: true--}}
        {{--})--}}
        $('[data-mask]').inputmask()
        @isset($saved)
            $('#user-registered-modal').modal('show');
        @endisset
    </script>
@endsection
