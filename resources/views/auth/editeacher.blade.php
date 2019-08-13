@extends('layouts.admin-lite')
@section('title')
    Edit Teacher
@endsection
@section('page-header')
    Edit Teacher
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Edit Teacher</li>
    </ol>
@endsection
@section('content') Edit Teacher
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @isset($teacher)
                <div class="card">
                    @isset($new_user)
                        <div class="card-header" style="color: green; font-size: large">Successfully edited {{$new_user->email }}</div>
                    @endisset
                    <div class="card-body">
                        <form method="POST" action="{{ route('editTeacher') }}" enctype="multipart/form-data">
                            @csrf
{{--                            <input type="hidden" name="teacherId" t>--}}

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$teacher->name}}" required autocomplete="name" autofocus>

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
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $teacher->email}}" required autocomplete="email" readonly>

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
                                    <input id="address" type="address" class="form-control @error('email') is-invalid @enderror" name="address" value="{{ $teacher->address }}" required>

                                    @error('address')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Educational Qualification') }}</label>

                                <div class="col-md-6">
                                    <select class="form-control select2" name="edu_qual" id="edu_qual" style="width: 100%;">
                                        @if($teacher->edu_qual)
                                            <option selected="selected">{{$teacher->edu_qual}}</option>
                                        @else
                                            <option selected="selected">Select Highest Achievement</option>
                                        @endif
                                            <option value="degree">Degree</option>
                                            <option value="diploma">Diploma</option>
                                            <option value="AL">A/L</option>
                                            {{--@foreach($types as $type)--}}
                                            {{--<option>{{$type}}</option>--}}
                                            {{--@endforeach--}}
                                    </select>
                                    @error('type')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="prof_qual" class="col-md-4 col-form-label text-md-right">{{ __('Professional Qualification') }}</label>

                                <div class="col-md-6">
                                    <textarea class="form-control" id="prof_qual" name="prof_qual" rows="3" placeholder="Enter ..."  >{{ $teacher->prof_qual}}</textarea>
                                    @error('prof_qual')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="specialization" class="col-md-4 col-form-label text-md-right">{{ __('Specialization') }}</label>

                                <div class="col-md-6">
                                    <input id="specialization" type="text" class="form-control @error('specialization') is-invalid @enderror" name="specialization" value="{{$teacher->specialization}}" required autofocus>

                                    @error('specialization')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="nic" class="col-md-4 col-form-label text-md-right">{{ __('National Identification Number') }}</label>

                                <div class="col-md-6">
                                    <input id="nic" type="text" class="form-control @error('nic') is-invalid @enderror" name="nic" value="{{ $teacher->nic}}" required autofocus>

                                    @error('nic')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label for="contact" class="col-md-4 col-form-label text-md-right">{{ __('Contact Number') }}</label>

                                <div class="col-md-6">
                                    <input id="contact" type="text" class="form-control @error('contact') is-invalid @enderror" name="contact" value="{{$teacher->contact}}" required autofocus data-inputmask='"mask": "(999) 999-9999"' data-mask>

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
                                        {{ __('Edit Teacher') }}
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
                    <h4 class="modal-title text-center">Successfully Edited the Teacher</h4>
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
