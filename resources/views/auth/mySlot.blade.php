@extends('layouts.admin-lite')
@section('title')
    viewMySlots
@endsection
@section('page-header')

@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Teacher</a></li>
        <li class="active">View My Slots</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
                @isset($teacher)
                <form method="POST" action="{{ route('createConv') }}" enctype="multipart/form-data">
                    @csrf
                        @isset($slot_id)
                        <input name="slot" value="{{$slot_id}}" hidden>
                        @endisset
                    @isset($students)
                        <div class="form-group row">
                            <label for="parent_id" class="col-md-4 col-form-label text-md-right">{{ __('Select Students') }}</label>

                            <div class="col-md-6">
                                <select id="students" name="students[]" data-placeholder="Select a student" class="selectpicker" multiple data-live-search="true" required autofocus>
                                    @foreach($students as $student)
                                        <option value="{{$student->student_id}}">{{$student->name}} (Student Id = {{$student->student_id}}  )</option>
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
                    <button id="button" type="submit" align="left"  class="btn btn-primary" data-dismiss="modal">Create a New Conversation</button>
                </form>
                 @endisset
            <div id="chats" class="col-md-8">
                @isset($conver)
                    @foreach($conver as $conv)
                        <div id="conversation{{$conv->id}}">
                            <h3>Conversation {{$conv->id}}</h3>
                            <form method="GET" action="{{ route('getConv', ['id' => $conv->id]) }}" enctype="multipart/form-data">
                                <div class="card">
                                    <button id="button" type="submit" align="left" class="btn btn-primary" data-dismiss="modal">Join</button>
                                </div>
                            </form>
                        </div>
            </br>
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
                    <h4 class="modal-title text-center">Successfully Marked as Read</h4>
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
    function createConversation() {
        // var input = document.getElementById("btn-input").value;
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            /* the route pointing to the post function */
            url: 'test',
            type: 'POST',
            data: {_token: CSRF_TOKEN, message:input},
            success: function (data) {

            }
        });
    }
    </script>
@endsection
