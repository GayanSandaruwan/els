@extends('layouts.admin-lite')
@section('title')
    Assign Academics to Time Slot
@endsection
@section('page-header')
    Assign Academics to Time Slot
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Assign Academics to Time Slot</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <body  background="/images/background.png">
        <div  class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('assignStudentToSlot') }}" enctype="multipart/form-data">
                            @csrf
                            @isset($students)
                            <div class="form-group row">
                                <label for="parent_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Students') }}</label>

                                <div class="col-md-6">
                                        <select id="students" name="students[]" data-placeholder="Select a student" class="selectpicker" multiple data-live-search="true" required>
                                        @foreach($students as $student)
                                                <option value="{{$student->user_id}}-{{$student->id}}"><strong>Student Email </strong> {{$student->email}} -[ <strong>REASON - </strong>{{$student->reason}}]</option>
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

                            <div class="form-group row">
                                <label for="student_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Session') }}</label>
                                @isset($students)
                                <div class="col-md-6">
                                    <select id="slot" name="slot" class="form-control select2"  data-placeholder="Select a Student"
                                            style="width: 100%;" required>
                                        @foreach($slots as $slot)
                                            <option value="{{$slot->id}}">{{$slot->date}} from {{$slot->start_time}} to {{$slot->end_time}}</option>
                                        @endforeach
                                    </select>
                                    @foreach($slots as $slot)
                                        <input id="slot{{$slot->id}}" type="text" name="slot{{$slot->id}}"  value="{{(int)$slot->no_of_slots}}-{{(int)$slot->current_slots}}" hidden>
                                    @endforeach
                                    @error('student_id')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                    @endisset
                            </div>
                                <div class="form-group row">
                                    <label for="student_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Teacher') }}</label>
                                @isset($teachers)
                                    <div class="col-md-6">
                                        <select id="teacher" name="teacher" class="form-control select2"  required data-placeholder="Select a Student"
                                                style="width: 100%;">
                                            @foreach($teachers as $teacher)
                                                <option value="{{$teacher->id}}">{{$teacher->name}}</option>
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

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Assign to Virtual Class') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </body>
    </div>
<div class="modal fade" id="user-registered-modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title text-center">Successfully Added the Virtual Class</h4>
            </div>
            <div class="modal-body">
                <img src="/images/success.png" class="center-block" style="width: 100px">
{{--                @isset($new_user)--}}
{{--                    <h4 class="modal-title text-center">Student with email id: {{$new_user->email}} successfully Added</h4>--}}
{{--                @endisset--}}
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
        var available=5

        @if (session()->has('success_stu_add'))
        $('#user-registered-modal').modal('show');
        @endif
        // var available=
        //limiting the number of selection as per the available slots
        $(document).ready(function() {
            var last_valid_selection = null;
            $('#students').change(function(event) {
                console.log($(this).val())
                if ($(this).val().length >available ) {
                    $(this).val(last_valid_selection);
                    $("#students  option").each(function(){
                        this.selected=false;
                    });
                    alert("There are only 5 slots available")
                } else {
                    last_valid_selection = $('#students option:selected').val();
                }
            });
            $('#slot').change(function(event) {
                console.log('#slot'+$('#slot').val())
                var slotid='#slot'+$('#slot').val()
                console.log($(slotid).val())
            });

        });

    </script>
@endsection
