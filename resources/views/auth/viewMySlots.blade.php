@extends('layouts.admin-lite')
@section('title')
    View My Virtual Classes
@endsection
@section('page-header')
    View My Virtual Classes
    @endsection

@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Teacher</a></li>
        <li class="active">View My Virtual Classes</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @isset($slots)
                    @foreach($slots as $slot)
                        <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">

                            <h3>Starts in <strong>{{$slot->date}}</strong> from  <strong>{{$slot->start_time}}</strong> to <strong>{{$slot->end_time}}</strong></h3>
                        <form method="GET" action="{{ route('teacherMySlot', ['id' => $slot->id]) }}" enctype="multipart/form-data">
{{--                            @csrf--}}
                        <div class="card" align="center">
                            <input value="${{$slot->id}}" hidden>
                            <button id="button" type="submit" align="center" style="margin-bottom:15px; width: 500px;" class="btn btn-primary" data-dismiss="modal">Start</button>
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




    </script>
@endsection
