@extends('layouts.admin-lite')
@section('title')
    Edit Teachers
@endsection
@section('page-header')
    Edit Teachers
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Edit Teachers</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @isset($new_user)
                        <div class="card-header" style="color: green; font-size: large">Successfully Added {{$new_user->email }}</div>
                    @endisset
                    <div class="card-body">
                        <form method="POST" action="{{ route('editTeacherForm') }}" enctype="multipart/form-data">
                            @csrf

                                    <div class="form-group row">
                                        <label for="student_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Teacher') }}</label>
                                        @isset($teachers)
                                            <div class="col-md-6">
                                                <select id="teacher" name="teacher" class="form-control select2"  required data-placeholder="Select a Student"
                                                        style="width: 100%;">
                                                    @foreach($teachers as $teacher)
                                                        <option value="{{$teacher->id}}">{{$teacher->name}} - {{$teacher->email}}</option>
                                                    @endforeach
                                                </select>
                                                @error('student_id')
                                                <span class="help-block" style="color: red" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                                @enderror
                                            </div>
                                    </div>
                                @endisset
                            </div>
{{--                        @endisset--}}
                            </div>
                            <div class="form-group row">
                                <label for="student_id" class="col-md-4 col-form-label text-md-right">{{ __('Select the Option') }}</label>
                                    <div class="col-md-6">
                                        <input type="radio" name="change" value="edit"> Edit<br>
                                        <input type="radio" name="change" value="delete"> Delete<br>

                                    </div>
                            </div>
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <input type="radio" name="change" value="edit"> Edit<br>--}}
{{--                                <input type="radio" name="change" value="delete"> Delete<br>--}}
{{--                            </div>--}}
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

    <div class="modal fade" id="user-registered-modal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title text-center">Successfully Deleted the Teacher</h4>
                </div>
                <div class="modal-body">
                    <img src="/images/success.png" class="center-block" style="width: 100px">
                    @isset($new_user)
                        <h4 class="modal-title text-center">Student with email id: {{$new_user->email}} successfully Added</h4>
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
        $('#dob').datepicker({
        autoclose: true
        })
        $('[data-mask]').inputmask()
        @isset($edited)
        $('#user-registered-modal').modal('show');
        @endisset
    </script>
@endsection
