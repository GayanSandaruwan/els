@extends('layouts.admin-lite')
@section('title')
    Chat
@endsection
@section('page-header')
    Chat
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li class="active">Chat</li>
    </ol>
@endsection
@section('content')
<div class="container">
{{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}
    <div class="row justify-content-center">
        @if(Auth::user()->type == 'teacher')
        <div class="col-md-6">
            @endif

            @if(Auth::user()->type == 'student')
               <div class="col-md-10">
            @endif

            <div class="panel panel-primary">
                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <div class="panel-heading">Live Chat</div>
                @isset($conv_id)
                    <input id="conId"  name="conId" value={{$conv_id}} hidden>
                   @endisset
                <div id="body" class="panel-body panel-height" style="overflow-y:auto">
                    @isset($chat)
                        @foreach($chat as $ct)
                            <li class="left clearfix" id="list">
                                <div class="chat-body clearfix">
                                    <div class="header">
                                        <strong class="primary-font">{{$ct->user_name}}[{{$ct->user_id}}]</strong>
                                    </div>
                                    <p>{{$ct->text}}</p>
                                </div>
                            </li>
                        @endforeach
                    @endisset
                 </div>
            </div>
            <div class="input-group">
                <input id="btn-input" type="text" name="message" class="form-control input-sm" placeholder="Type your message here..." v-model="newMessage" @keyup.enter="sendMessage">

                <span class="input-group-btn">
            <button class="btn btn-primary btn-sm" id="btn-chat" onclick="sendMessage()">
                Send
            </button>
        </span>
            </div>
        </span>
            </div>
{{--        </div>--}}

                @if(Auth::user()->type == 'teacher')

    <div class="col-md-4">
        <div class="card-body">
<h3>Upload the Quiz Here!</h3>
            <form>
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


{{--            @isset($students)--}}
{{--                @foreach($students as $student)--}}
{{--                {--}}
{{--                    <input type="hidden" name="students[]" value=$student>;--}}
{{--                }--}}
{{--                @endforeach--}}
{{--            @endisset--}}

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
            <div class="form-group row">
                <label for="end_time" class="col-md-4 col-form-label text-md-right">{{ __('Time') }}</label>

                <div class="col-md-6">
                    <input value=30  id="quizTime" type="quizTime" class="form-control @error('no_of_slots') is-invalid @enderror" name="no_of_slots" value="{{ old('no_of_slots') }}" required autocomplete="number">


                    @error('fileToUpload')
                    <span class="help-block" style="color: red" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row mb-0">
                <div class="col-md-6 offset-md-4">
                    <button type="button" id="btn1" onclick="uploadQuiz()" class="btn btn-primary">
                        {{ __('Submit') }}
                    </button>
                </div>
            </div>

        </form>
    </div>
{{--        <button type="button" onclick="getMarks()" class="btn btn-primary">--}}
{{--            {{ __('Get Marks') }}--}}
{{--        </button>--}}
{{--        <div>--}}
{{--            <table id="example" class="table table-striped table-bordered" style="width:100%">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Student Name</th>--}}
{{--                    <th>Student ID</th>--}}
{{--                    <th>Attempt</th>--}}
{{--                    <th>Marks</th>--}}
{{--                    <th>Attempted At</th>--}}
{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @isset($studnetQuiz)--}}
{{--                    @foreach($studnetQuiz as $st)--}}
{{--                        <tr>--}}
{{--                            <td>{{$st->name}}</td>--}}
{{--                            <td>{{$st->id}}</td>--}}
{{--                            <td>{{$st->mark}}</td>--}}
{{--                            <td>{{$st->attempt}}</td>--}}
{{--                            <td>{{$st->updated_at}}</td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                @endisset--}}
{{--                </tbody>--}}
{{--            </table>--}}

{{--        </div>--}}



</div>
                @endif


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
@endsection
@section('additional-scripts')
    <style>
        .panel-height {
            height: 350px; / change according to your requirement/

        }
    </style>
    <script src="https://js.pusher.com/4.4/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;
        var pusher = new Pusher('78bdbb90df752b46775c', {
            cluster: 'ap2',
            forceTLS: true
        });
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        var quiz_id=0;
        var langs ={!! json_encode($channel) !!};
{{--        var students =JSON.parse('{{ json_encode($students) }}');--}}
//         var students ={ !!$students!!};
        var students =@json($students);
        var channel = pusher.subscribe('my-channel');

        //adding function
        function add(data) {
            var el = document.getElementById("body");
            var node = document.createElement("li");


            var chatbody = document.createElement('div');
            chatbody.setAttribute('class', 'chat-body clearfix');

                var header = document.createElement('div');
                header.setAttribute('class', 'header');

                    var strong = document.createElement('strong');
                    strong.setAttribute('class', 'primary-font');
                    strong.textContent = data["sender"]
                header.appendChild(strong);

                var body=document.createElement('p');
                body.textContent = data["message"];

            chatbody.appendChild(header);
            chatbody.appendChild(body);
            node.appendChild(chatbody);
            el.appendChild(node);

        }
        function sendMessage() {
            var input = document.getElementById("btn-input").value;
            var conver_id = document.getElementById("conId").value;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                /* the route pointing to the post function */
                url: '/chat',
                type: 'POST',
                data: {_token: CSRF_TOKEN, message:input, conver_id:conver_id},
                success: function (data) {
                    document.getElementById("btn-input").value="";
                    var div = $("#body");
                    div.scrollTop(div.prop('scrollHeight'));
                }
            });

        }


        //uploadquiz

{{--        @if (session()->has('students'))--}}
{{--                console.log("we got studets yo")--}}
{{--        $('#error').modal('show');--}}
{{--        @endif--}}


             $("#btn-input").keyup(function(event) {
                // Number 13 is the "Enter" key on the keyboard
                if (event.keyCode === 13) {
                    // Cancel the default action, if needed
                    event.preventDefault();
                    // Trigger the button element with a click
                    sendMessage();
                }
            });
        function uploadQuiz() {
            document.getElementById('btn1').setAttribute("disabled", "disabled");
            console.log(students);
            var quizName = document.getElementById("quizName").value;
            var fileToUpload = document.getElementById("fileToUpload").value;
            var quizTime = document.getElementById("quizTime").value;
            var con_id=document.getElementById("conId").value;
            // var students=document.getElementById("students").value

            var formData = new FormData();
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            formData.append('quizName', quizName);
            formData.append('quizTime', quizTime);
            formData.append('con_id', con_id);
            formData.append('CSRF_TOKEN', CSRF_TOKEN);
            formData.append('fileToUpload', $('input[type=file]')[0].files[0]);


            $.ajax({
                url: '/uploadQuizApi',
                type: 'POST',
                contentType: false, // NEEDED, DON'T OMIT THIS (requires jQuery 1.6+)
                processData: false, // NEEDED, DON'T OMIT THIS
                data: formData,
                success: function (data) {
                    this.quiz_id=data;
                    $('#user-registered-modal').modal('show');
                }
            });

        }

        channel.bind('my-event', function(data) {
            // alert(JSON.stringify(data))
            add(data);
            document.getElementById( 'body' ).scrollIntoView();
            //adding a new message element in the mesage list
        });


        function getMarks() {
            if(this.quiz_id===0){
                alert("Please upload the quiz first!");
            }
            else{
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    /* the route pointing to the post function */
                    url: '/getMarks',
                    type: 'GET',
                    data: {quiz_id: this.quiz_id},
                    success: function (data) {
                        aleart(data);
                    }
                });

            }
        }

    </script>
@endsection