@extends('layouts.admin-lite')
@section('title')
    Create a Time Slot
@endsection
@section('page-header')
    Create a Time Slot
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Admin</a></li>
        <li class="active">Add Student</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    @isset($new_slot)
                        <script>
                            console.log("Test")
                        </script>
                        <div class="card-header" style="color: green; font-size: large">Successfully Added slot in {{$new_slot->date }}</div>
                    @endisset
                    <div class="card-body">
                        <form method="POST" action="{{ route('addSlot') }}" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group row">
                                <label for="dob" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                                <div class="col-md-6">
                                    <input  type="datetime-local" id="date"
                                           name="date" class="form-control @error('dob') is-invalid @enderror" name="dob" value="{{ old('dob') }}" required autofocus>

                                    @error('date')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('Duration') }}</label>

                                <div class="col-md-6">
                                    <input value=15  id="duration" type="number" class="form-control @error('duration') is-invalid @enderror" name="duration" value="{{ old('duration') }}" required autofocus>

                                    @error('duration')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="no_of_slots" class="col-md-4 col-form-label text-md-right">{{ __('Slots') }}</label>

                                <div class="col-md-6">
                                    <input value=5  id="no_of_slots" type="number" class="form-control @error('no_of_slots') is-invalid @enderror" name="no_of_slots" value="{{ old('no_of_slots') }}" required autocomplete="number">

                                    @error('no_of_slots')
                                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Create TimeSlot') }}
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
                    <h4 class="modal-title text-center">Successfully Added the time slot</h4>
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
        function SetMinDate() {
                    var date = new Date();
                $('#date').val(new Date(date.getTime() - (date.getTimezoneOffset() * 60000)).toJSON().slice(0,16));
        }
        SetMinDate();
        $('[data-mask]').inputmask()
        @if (session()->has('new_slot'))
        $('#user-registered-modal').modal('show');
        @endif

        var dateToday = new Date();

    </script>
@endsection
