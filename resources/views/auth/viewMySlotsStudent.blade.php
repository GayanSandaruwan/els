@extends('layouts.admin-lite')
@section('title')
    View My Time Slots
@endsection
@section('page-header')
    View My Time Slots
    @endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Student</a></li>
        <li class="active">View My Slots</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @isset($slots)
                    @foreach($slots as $slot)
                        <h3>{{$slot->date}} from {{$slot->start_time}} to {{$slot->end_time}}</h3>
                        <form method="GET" action="{{ route('getStudentConversations', ['id' => $slot->id]) }}" enctype="multipart/form-data">
{{--                            @csrf--}}
                        <div class="card">
                            <input value="${{$slot->id}}" hidden>
                            <button id="button" type="submit" align="left" class="btn btn-primary" data-dismiss="modal">Start</button>
                        </div>
                        </form>
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




    </script>
@endsection
