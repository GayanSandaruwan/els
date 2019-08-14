@extends('layouts.admin-lite')
@section('title')
    viewTimeSlotRequests
@endsection
@section('page-header')
    View Virtual Class Requests.
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Teacher</a></li>
        <li class="active"> View Virtual Class Requests. </li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @isset($requests)
                    @foreach($requests as $req)
                        <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                        <h3>{{$req->reason}}</h3>

                            <div class="card-header"><strong>Create By - {{$req->name}} [{{$req->email}}] at {{$req->created_at}}</strong></div>
                            <div class="card" align="center">
{{--                                    <form method="get" action={{$quiz->path}}>--}}
                                        <button id="button{{$req->id}}" type="button" onclick="markRead({{$req->id}})" style="margin-bottom:15px; width: 500px;" align="left" class="btn btn-primary" data-dismiss="modal">Mark As Read</button>
{{--                                    </form>--}}
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

        $('.select2').select2();


        // $('input:checked').removeAttr('checked');
        //
        // $("#download").click(function(link) {
        //     // // hope the server sets Content-Disposition: attachment!
        //     window.location = link;
        // });
        function markRead(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                /* the route pointing to the post function */
                url: 'markasread',
                type: 'POST',
                data: {_token: CSRF_TOKEN, id:id},
                success: function (data) {
                    console.log("button"+id)
                    var div = $("#body");
                    div.scrollTop(div.prop('scrollHeight'));
                    document.getElementById("button"+id).disabled = true;
                    $('#user-registered-modal').modal('show');
                }
            });

        }

    </script>
@endsection
