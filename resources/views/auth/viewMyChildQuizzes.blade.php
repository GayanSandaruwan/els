@extends('layouts.admin-lite')
@section('title')
    View My Quizzes
@endsection
@section('page-header')
    View My Quizzes
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Student</a></li>
        <li class="active">Quizzes</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @isset($quizzes)
                    @foreach($quizzes as $quiz)

                        <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 2px;">
                            <h2>{{$quiz->quiz_name}}</h2>
                        <div class="card-header">Create By - {{$quiz->created_by}}</div>
                            <div class="card-body">Marks - {{$quiz->mark}}</div>

{{--                                <form method="post" action={{ route('addComment') }}>--}}
{{--                                    @csrf--}}
                                    <input value={{$quiz->id}} id=student_quiz_id{{$quiz->id}} name="student_quiz_id" hidden="">
                                        <h4>Add Your Comment Here!</h4>
                                        <div id="body{{$quiz->id}}" class="panel-body panel-height" style="overflow-y:auto">
                                            @isset($comments[$loop->index])

                                                @foreach($comments[$loop->index] as $ct)
                                                    <ui class="left clearfix" id="list">
                                                        <div class="chat-body clearfix">
                                                            <div class="header">
                                                                <strong class="primary-font">{{$ct->úser_name}}  Created at -[{{$ct->created_at}}]</strong>
                                                            </div>
                                                            <p>{{$ct->comment}}</p>
                                                        </div>
                                                    </ui>
                                                @endforeach
                                        @endisset
                                    </div>
                                    <div class="input-group">
                                              <input id="btn-input{{$quiz->id}}" type="text" name="message" class="form-control input-sm" placeholder="Type your comment here..." v-model="newMessage" @keyup.enter="sendMessage">

                                             <span class="input-group-btn">
                                            <button class="btn btn-primary btn-sm" id="btn-chat" onclick="sendComment({{$quiz->id}})">
                                                Comment
                                            </button>
                                        </span>
                                    </div>
{{--                                </form>--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-6">--}}
{{--                                    <button class="btn-primary">Activate</button>--}}
{{--                                </div>--}}
                        </div>
            <br/>
                    @endforeach
                @endisset
                </div>
            </div>
        </div>

    <!-- /.modal -->
@endsection
@section('additional-scripts')
    <style>
        .panel-height {
            height: 70px; / change according to your requirement/

        }
    </style>
    <script type="text/javascript">
        function add(data){
        console.log(data)
            var id=data['id']
            var el = document.getElementById("body"+id);
            var node = document.createElement("ui");


            var chatbody = document.createElement('div');
            chatbody.setAttribute('class', 'chat-body clearfix');

            var header = document.createElement('div');
            header.setAttribute('class', 'header');

            var strong = document.createElement('strong');
            strong.setAttribute('class', 'primary-font');
            strong.textContent = data["úser_name"]+" Created at -["+data["created_at"]+"]"
            header.appendChild(strong);

            var body=document.createElement('p');
            body.textContent = data["comment"];

            chatbody.appendChild(header);
            chatbody.appendChild(body);
            node.appendChild(chatbody);
            el.appendChild(node);

        }

        function sendComment(id) {
            console.log("ogt")
            var input = document.getElementById("btn-input"+id).value;
            var student_quiz_id = document.getElementById("student_quiz_id"+id).value;
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                /* the route pointing to the post function */
                url: '/parent/addComment',
                type: 'POST',
                data: {_token: CSRF_TOKEN, comment:input, student_quiz_id:student_quiz_id},
                success: function (data) {
                    console.log("This is Id ="+data['id']);
                    add(data);
                    document.getElementById("btn-input"+data['id']).value="";
                    var div = $("#body"+data['id']);
                    div.scrollTop(div.prop('scrollHeight'));
                }
            });

        }
    </script>
@endsection
