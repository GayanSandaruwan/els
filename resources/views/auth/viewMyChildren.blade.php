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
            <div class="col-md-8">
                @isset($children)
                    @foreach($children as $child)
                        <h2>{{$child->name}}</h2>
                        <div class="card">
                            <form method="get" action={{ route('viewstudent', ['id' => $child->id]) }}>
                                <button id="view" type="submit"  class="btn btn-primary" data-dismiss="modal">View Quizzes</button>
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
