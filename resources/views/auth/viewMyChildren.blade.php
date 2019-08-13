@extends('layouts.admin-lite')
@section('title')
    View My Children
@endsection
@section('page-header')
    View My Children
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Parent</a></li>
        <li class="active">View My Children</li>
    </ol>
@endsection
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                @isset($children)
                    @foreach($children as $child)
                        <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 2px;">

                        <h2>{{$child->name}}</h2>
                        <div class="card" align="center">
                            <form method="get" action={{ route('viewstudent', ['id' => $child->id]) }}>
                                <button id="view"style="margin-bottom:15px; width: 500px;" type="submit"  class="btn btn-primary" data-dismiss="modal">View Quizzes</button>
                            </form>
                        </div>
                    @endforeach
                @endisset
                </div>
            </div>
        </div>

    <!-- /.modal -->
@endsection
@section('additional-scripts')

@endsection
