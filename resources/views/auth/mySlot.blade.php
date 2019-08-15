@extends('layouts.admin-lite')
@section('title')
    viewMySlots
@endsection
@section('page-header')
Create Sessions
    @endsection
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
                            <label for="parent_id" class="col-md-4 col-form-label text-md-right">{{ __('Session Type') }}</label>

                            <div class="col-md-6">
                                <select id="type" name="type" data-placeholder="Select a student" class="selectpicker"  data-live-search="true" required autofocus>
                                    <option value="live Session">Live Session</option>
                                    <option value="High">High</option>
                                    <option value="Mid">Mid</option>
                                    <option value="Low">Low</option>

                                </select>

                            </div>
                        </div>

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
                    <button id="button" type="submit" align="left"  style="margin-bottom:15px; "  class="btn btn-primary" data-dismiss="modal">Create a New Conversation</button>
                <br/>
                </form>
                 @endisset
            <div id="chats" class="col-md-10">
                @isset($conver)
                    @foreach($conver as $conv)
                        <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">

                        <div id="conversation{{$conv->id}}">
                            <h3>Conversation - <strong>{{$conv->type}}</strong></h3>
                            <form method="GET" action="{{ route('getConv', ['id' => $conv->id]) }}" enctype="multipart/form-data">


                                <div class="card" align="center">
                                    <button id="button" type="submit" align="center" style="margin-bottom:15px; width: 500px;"  class="btn btn-primary" data-dismiss="modal">Join Conversation</button>
                                    @isset($teacher)
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Student ID</th>
                                            <th>Attempt</th>
                                            <th>Marks</th>
                                            <th>Attempted At</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @isset($marks[$loop->index])
                                            @foreach($marks[$loop->index] as $st)
                                                <tr>
                                                    <td>{{$st->name}}</td>
                                                    <td>{{$st->id}}</td>
                                                    <td>{{$st->attempt}}</td>
                                                    <td>{{$st->mark}}</td>
                                                    <td>{{$st->created_at}}</td>
                                                </tr>
                                            @endforeach
                                        @endisset
                                        </tbody>
                                    </table>
                                        @endisset


                                    @isset($stud)
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                            <tr>
                                                <th>Student Name</th>
                                                <th>Student ID</th>
                                                <th>Attempt</th>
                                                <th>Marks</th>
                                                <th>Attempted At</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @isset($marks[$loop->index])
                                                @foreach($marks[$loop->index] as $st)
                                                    <tr>
                                                        <td>{{$st->name}}</td>
                                                        <td>{{$st->id}}</td>
                                                        <td>{{$st->attempt}}</td>
                                                        <td>{{$st->mark}}</td>
                                                        <td>{{$st->created_at}}</td>
                                                    </tr>
                                                @endforeach
                                            @endisset
                                            </tbody>
                                        </table>
                                    @endisset
                                </div>
                            </form>
                        </div>
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
