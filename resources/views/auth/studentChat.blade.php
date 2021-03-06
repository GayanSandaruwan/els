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
        <div class="col-md-6">
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

        channel.bind('my-event', function(data) {
            alert(JSON.stringify(data))
            add(data);
            document.getElementById( 'body' ).scrollIntoView();
            //adding a new message element in the mesage list
        });




    </script>
@endsection