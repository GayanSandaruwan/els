@extends('layouts.admin-lite')
@section('title')
    View Quizzes
@endsection
@section('page-header')
    View Quizzes
@endsection
@section('optional-header')
@endsection
@section('level')
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Teacher</a></li>
        <li class="active">View Quizzes</li>
    </ol>
@endsection
@section('content')
    <div class="container">
           <div class="row justify-content-center">


               <div class="col-md-10">
                   @isset($quizzes)
                       <h1>Unit 1</h1>
                       @foreach($quizzes as $quiz)
                           @if($quiz->Unit==1)
                               <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                   <h2>{{$quiz->quiz_name}}</h2>

                                   <form method="POST" action="{{ route('updateQuiz') }}" enctype="multipart/form-data">
                                       @csrf
                                       <div class="card-header"><strong>Create By -</strong> {{$quiz->created_by}}</div>
                                       <div class="card-body"><strong>Create at -</strong>  {{$quiz->created_at}}</div>
                                       <div class="row">
                                           <div class="col-md-4">
                                               {{--                                         <input type="text" id="myInput{{$quiz->id}}"  readonly value='/quiz/{{$quiz->url}}' >--}}
                                               <input type="hidden" name="id" id="myInput{{$quiz->id}}"   value={{$quiz->id}} readonly>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-2">
                                               @if($quiz->status=='deactivate')
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;"  data-dismiss="modal">Activate</button>
                                                   <input id="newState" name="newState" type="hidden" value="active">

                                               @else()
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;" data-dismiss="modal">Deactivate</button>
                                                   <input id="newState" name="newState" type="hidden" value="deactivate">
                                               @endif
                                           </div>
                                           <br/>
                                           <div class="col-md-2">
                                               {{--                                    <form method="get" action={{$quiz->path}}>--}}
                                               {{--                                        <button id="download" type="button" onclick="myFunction({{$quiz->id}})" class="btn btn-primary" data-dismiss="modal">Copy Link</button>--}}
                                               {{--                                    </form>--}}
                                           </div>
                                       </div>
                                       <div>
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
                                               @isset($studnetQuiz[$loop->index])
                                                   @foreach($studnetQuiz[$loop->index] as $st)
                                                       <tr>
                                                           <td>{{$st->name}}</td>
                                                           <td>{{$st->id}}</td>
                                                           <td>{{$st->mark}}</td>
                                                           <td>{{$st->attempt}}</td>
                                                           <td>{{$st->updated_at}}</td>
                                                       </tr>
                                                   @endforeach
                                               @endisset
                                               </tbody>
                                           </table>
                                       </div>
                                   </form>
                               </div>
                           @endif
                       @endforeach
                   @endisset
               </div>



               <div class="col-md-10">
                   @isset($quizzes)
                       <h1>Unit 2</h1>
                       @foreach($quizzes as $quiz)
                           @if($quiz->Unit==2)
                               <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                   <h2>{{$quiz->quiz_name}}</h2>

                                   <form method="POST" action="{{ route('updateQuiz') }}" enctype="multipart/form-data">
                                       @csrf
                                       <div class="card-header"><strong>Create By -</strong> {{$quiz->created_by}}</div>
                                       <div class="card-body"><strong>Create at -</strong>  {{$quiz->created_at}}</div>
                                       <div class="row">
                                           <div class="col-md-4">
                                               {{--                                         <input type="text" id="myInput{{$quiz->id}}"  readonly value='/quiz/{{$quiz->url}}' >--}}
                                               <input type="hidden" name="id" id="myInput{{$quiz->id}}"   value={{$quiz->id}} readonly>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-2">
                                               @if($quiz->status=='deactivate')
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;"  data-dismiss="modal">Activate</button>
                                                   <input id="newState" name="newState" type="hidden" value="active">

                                               @else()
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;" data-dismiss="modal">Deactivate</button>
                                                   <input id="newState" name="newState" type="hidden" value="deactivate">
                                               @endif
                                           </div>
                                           <br/>
                                           <div class="col-md-2">
                                               {{--                                    <form method="get" action={{$quiz->path}}>--}}
                                               {{--                                        <button id="download" type="button" onclick="myFunction({{$quiz->id}})" class="btn btn-primary" data-dismiss="modal">Copy Link</button>--}}
                                               {{--                                    </form>--}}
                                           </div>
                                       </div>
                                       <div>
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
                                               @isset($studnetQuiz[$loop->index])
                                                   @foreach($studnetQuiz[$loop->index] as $st)
                                                       <tr>
                                                           <td>{{$st->name}}</td>
                                                           <td>{{$st->id}}</td>
                                                           <td>{{$st->mark}}</td>
                                                           <td>{{$st->attempt}}</td>
                                                           <td>{{$st->updated_at}}</td>
                                                       </tr>
                                                   @endforeach
                                               @endisset
                                               </tbody>
                                           </table>
                                       </div>
                                   </form>
                               </div>
                           @endif
                       @endforeach
                   @endisset
               </div>


               <div class="col-md-10">
                   @isset($quizzes)
                       <h1>Unit 3</h1>
                       @foreach($quizzes as $quiz)
                           @if($quiz->Unit==3)
                               <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                   <h2>{{$quiz->quiz_name}}</h2>

                                   <form method="POST" action="{{ route('updateQuiz') }}" enctype="multipart/form-data">
                                       @csrf
                                       <div class="card-header"><strong>Create By -</strong> {{$quiz->created_by}}</div>
                                       <div class="card-body"><strong>Create at -</strong>  {{$quiz->created_at}}</div>
                                       <div class="row">
                                           <div class="col-md-4">
                                               {{--                                         <input type="text" id="myInput{{$quiz->id}}"  readonly value='/quiz/{{$quiz->url}}' >--}}
                                               <input type="hidden" name="id" id="myInput{{$quiz->id}}"   value={{$quiz->id}} readonly>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-2">
                                               @if($quiz->status=='deactivate')
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;"  data-dismiss="modal">Activate</button>
                                                   <input id="newState" name="newState" type="hidden" value="active">

                                               @else()
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;" data-dismiss="modal">Deactivate</button>
                                                   <input id="newState" name="newState" type="hidden" value="deactivate">
                                               @endif
                                           </div>
                                           <br/>
                                           <div class="col-md-2">
                                               {{--                                    <form method="get" action={{$quiz->path}}>--}}
                                               {{--                                        <button id="download" type="button" onclick="myFunction({{$quiz->id}})" class="btn btn-primary" data-dismiss="modal">Copy Link</button>--}}
                                               {{--                                    </form>--}}
                                           </div>
                                       </div>
                                       <div>
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
                                               @isset($studnetQuiz[$loop->index])
                                                   @foreach($studnetQuiz[$loop->index] as $st)
                                                       <tr>
                                                           <td>{{$st->name}}</td>
                                                           <td>{{$st->id}}</td>
                                                           <td>{{$st->mark}}</td>
                                                           <td>{{$st->attempt}}</td>
                                                           <td>{{$st->updated_at}}</td>
                                                       </tr>
                                                   @endforeach
                                               @endisset
                                               </tbody>
                                           </table>
                                       </div>
                                   </form>
                               </div>
                           @endif
                       @endforeach
                   @endisset
               </div>


               <div class="col-md-10">
                   @isset($quizzes)
                       <h1>Unit 4</h1>
                       @foreach($quizzes as $quiz)
                           @if($quiz->Unit==4)
                               <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                   <h2>{{$quiz->quiz_name}}</h2>

                                   <form method="POST" action="{{ route('updateQuiz') }}" enctype="multipart/form-data">
                                       @csrf
                                       <div class="card-header"><strong>Create By -</strong> {{$quiz->created_by}}</div>
                                       <div class="card-body"><strong>Create at -</strong>  {{$quiz->created_at}}</div>
                                       <div class="row">
                                           <div class="col-md-4">
                                               {{--                                         <input type="text" id="myInput{{$quiz->id}}"  readonly value='/quiz/{{$quiz->url}}' >--}}
                                               <input type="hidden" name="id" id="myInput{{$quiz->id}}"   value={{$quiz->id}} readonly>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-2">
                                               @if($quiz->status=='deactivate')
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;"  data-dismiss="modal">Activate</button>
                                                   <input id="newState" name="newState" type="hidden" value="active">

                                               @else()
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;" data-dismiss="modal">Deactivate</button>
                                                   <input id="newState" name="newState" type="hidden" value="deactivate">
                                               @endif
                                           </div>
                                           <br/>
                                           <div class="col-md-2">
                                               {{--                                    <form method="get" action={{$quiz->path}}>--}}
                                               {{--                                        <button id="download" type="button" onclick="myFunction({{$quiz->id}})" class="btn btn-primary" data-dismiss="modal">Copy Link</button>--}}
                                               {{--                                    </form>--}}
                                           </div>
                                       </div>
                                       <div>
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
                                               @isset($studnetQuiz[$loop->index])
                                                   @foreach($studnetQuiz[$loop->index] as $st)
                                                       <tr>
                                                           <td>{{$st->name}}</td>
                                                           <td>{{$st->id}}</td>
                                                           <td>{{$st->mark}}</td>
                                                           <td>{{$st->attempt}}</td>
                                                           <td>{{$st->updated_at}}</td>
                                                       </tr>
                                                   @endforeach
                                               @endisset
                                               </tbody>
                                           </table>
                                       </div>
                                   </form>
                               </div>
                           @endif
                       @endforeach
                   @endisset
               </div>
               <div class="col-md-10">
                   @isset($quizzes)
                       <h1>Unit 5</h1>
                       @foreach($quizzes as $quiz)
                           @if($quiz->Unit==5)
                               <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                   <h2>{{$quiz->quiz_name}}</h2>

                                   <form method="POST" action="{{ route('updateQuiz') }}" enctype="multipart/form-data">
                                       @csrf
                                       <div class="card-header"><strong>Create By -</strong> {{$quiz->created_by}}</div>
                                       <div class="card-body"><strong>Create at -</strong>  {{$quiz->created_at}}</div>
                                       <div class="row">
                                           <div class="col-md-4">
                                               {{--                                         <input type="text" id="myInput{{$quiz->id}}"  readonly value='/quiz/{{$quiz->url}}' >--}}
                                               <input type="hidden" name="id" id="myInput{{$quiz->id}}"   value={{$quiz->id}} readonly>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-2">
                                               @if($quiz->status=='deactivate')
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;"  data-dismiss="modal">Activate</button>
                                                   <input id="newState" name="newState" type="hidden" value="active">

                                               @else()
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;" data-dismiss="modal">Deactivate</button>
                                                   <input id="newState" name="newState" type="hidden" value="deactivate">
                                               @endif
                                           </div>
                                           <br/>
                                           <div class="col-md-2">
                                               {{--                                    <form method="get" action={{$quiz->path}}>--}}
                                               {{--                                        <button id="download" type="button" onclick="myFunction({{$quiz->id}})" class="btn btn-primary" data-dismiss="modal">Copy Link</button>--}}
                                               {{--                                    </form>--}}
                                           </div>
                                       </div>
                                       <div>
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
                                               @isset($studnetQuiz[$loop->index])
                                                   @foreach($studnetQuiz[$loop->index] as $st)
                                                       <tr>
                                                           <td>{{$st->name}}</td>
                                                           <td>{{$st->id}}</td>
                                                           <td>{{$st->mark}}</td>
                                                           <td>{{$st->attempt}}</td>
                                                           <td>{{$st->updated_at}}</td>
                                                       </tr>
                                                   @endforeach
                                               @endisset
                                               </tbody>
                                           </table>
                                       </div>
                                   </form>
                               </div>
                           @endif
                       @endforeach
                   @endisset
               </div>



               <div class="col-md-10">
                   @isset($quizzes)
                       <h1>Unit 6</h1>
                       @foreach($quizzes as $quiz)
                           @if($quiz->Unit==6)
                               <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                   <h2>{{$quiz->quiz_name}}</h2>

                                   <form method="POST" action="{{ route('updateQuiz') }}" enctype="multipart/form-data">
                                       @csrf
                                       <div class="card-header"><strong>Create By -</strong> {{$quiz->created_by}}</div>
                                       <div class="card-body"><strong>Create at -</strong>  {{$quiz->created_at}}</div>
                                       <div class="row">
                                           <div class="col-md-4">
                                               {{--                                         <input type="text" id="myInput{{$quiz->id}}"  readonly value='/quiz/{{$quiz->url}}' >--}}
                                               <input type="hidden" name="id" id="myInput{{$quiz->id}}"   value={{$quiz->id}} readonly>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-2">
                                               @if($quiz->status=='deactivate')
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;"  data-dismiss="modal">Activate</button>
                                                   <input id="newState" name="newState" type="hidden" value="active">

                                               @else()
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;" data-dismiss="modal">Deactivate</button>
                                                   <input id="newState" name="newState" type="hidden" value="deactivate">
                                               @endif
                                           </div>
                                           <br/>
                                           <div class="col-md-2">
                                               {{--                                    <form method="get" action={{$quiz->path}}>--}}
                                               {{--                                        <button id="download" type="button" onclick="myFunction({{$quiz->id}})" class="btn btn-primary" data-dismiss="modal">Copy Link</button>--}}
                                               {{--                                    </form>--}}
                                           </div>
                                       </div>
                                       <div>
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
                                               @isset($studnetQuiz[$loop->index])
                                                   @foreach($studnetQuiz[$loop->index] as $st)
                                                       <tr>
                                                           <td>{{$st->name}}</td>
                                                           <td>{{$st->id}}</td>
                                                           <td>{{$st->mark}}</td>
                                                           <td>{{$st->attempt}}</td>
                                                           <td>{{$st->updated_at}}</td>
                                                       </tr>
                                                   @endforeach
                                               @endisset
                                               </tbody>
                                           </table>
                                       </div>
                                   </form>
                               </div>
                           @endif
                       @endforeach
                   @endisset
               </div>


               <div class="col-md-10">
                   @isset($quizzes)
                       <h1>Unit 7</h1>
                       @foreach($quizzes as $quiz)
                           @if($quiz->Unit==7)
                               <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                   <h2>{{$quiz->quiz_name}}</h2>

                                   <form method="POST" action="{{ route('updateQuiz') }}" enctype="multipart/form-data">
                                       @csrf
                                       <div class="card-header"><strong>Create By -</strong> {{$quiz->created_by}}</div>
                                       <div class="card-body"><strong>Create at -</strong>  {{$quiz->created_at}}</div>
                                       <div class="row">
                                           <div class="col-md-4">
                                               {{--                                         <input type="text" id="myInput{{$quiz->id}}"  readonly value='/quiz/{{$quiz->url}}' >--}}
                                               <input type="hidden" name="id" id="myInput{{$quiz->id}}"   value={{$quiz->id}} readonly>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-2">
                                               @if($quiz->status=='deactivate')
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;"  data-dismiss="modal">Activate</button>
                                                   <input id="newState" name="newState" type="hidden" value="active">

                                               @else()
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;" data-dismiss="modal">Deactivate</button>
                                                   <input id="newState" name="newState" type="hidden" value="deactivate">
                                               @endif
                                           </div>
                                           <br/>
                                           <div class="col-md-2">
                                               {{--                                    <form method="get" action={{$quiz->path}}>--}}
                                               {{--                                        <button id="download" type="button" onclick="myFunction({{$quiz->id}})" class="btn btn-primary" data-dismiss="modal">Copy Link</button>--}}
                                               {{--                                    </form>--}}
                                           </div>
                                       </div>
                                       <div>
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
                                               @isset($studnetQuiz[$loop->index])
                                                   @foreach($studnetQuiz[$loop->index] as $st)
                                                       <tr>
                                                           <td>{{$st->name}}</td>
                                                           <td>{{$st->id}}</td>
                                                           <td>{{$st->mark}}</td>
                                                           <td>{{$st->attempt}}</td>
                                                           <td>{{$st->updated_at}}</td>
                                                       </tr>
                                                   @endforeach
                                               @endisset
                                               </tbody>
                                           </table>
                                       </div>
                                   </form>
                               </div>
                           @endif
                       @endforeach
                   @endisset
               </div>


               <div class="col-md-10">
                   @isset($quizzes)
                       <h1>Unit 8</h1>
                       @foreach($quizzes as $quiz)
                           @if($quiz->Unit==8)
                               <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                   <h2>{{$quiz->quiz_name}}</h2>

                                   <form method="POST" action="{{ route('updateQuiz') }}" enctype="multipart/form-data">
                                       @csrf
                                       <div class="card-header"><strong>Create By -</strong> {{$quiz->created_by}}</div>
                                       <div class="card-body"><strong>Create at -</strong>  {{$quiz->created_at}}</div>
                                       <div class="row">
                                           <div class="col-md-4">
                                               {{--                                         <input type="text" id="myInput{{$quiz->id}}"  readonly value='/quiz/{{$quiz->url}}' >--}}
                                               <input type="hidden" name="id" id="myInput{{$quiz->id}}"   value={{$quiz->id}} readonly>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-2">
                                               @if($quiz->status=='deactivate')
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;"  data-dismiss="modal">Activate</button>
                                                   <input id="newState" name="newState" type="hidden" value="active">

                                               @else()
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;" data-dismiss="modal">Deactivate</button>
                                                   <input id="newState" name="newState" type="hidden" value="deactivate">
                                               @endif
                                           </div>
                                           <br/>
                                           <div class="col-md-2">
                                               {{--                                    <form method="get" action={{$quiz->path}}>--}}
                                               {{--                                        <button id="download" type="button" onclick="myFunction({{$quiz->id}})" class="btn btn-primary" data-dismiss="modal">Copy Link</button>--}}
                                               {{--                                    </form>--}}
                                           </div>
                                       </div>
                                       <div>
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
                                               @isset($studnetQuiz[$loop->index])
                                                   @foreach($studnetQuiz[$loop->index] as $st)
                                                       <tr>
                                                           <td>{{$st->name}}</td>
                                                           <td>{{$st->id}}</td>
                                                           <td>{{$st->mark}}</td>
                                                           <td>{{$st->attempt}}</td>
                                                           <td>{{$st->updated_at}}</td>
                                                       </tr>
                                                   @endforeach
                                               @endisset
                                               </tbody>
                                           </table>
                                       </div>
                                   </form>
                               </div>
                           @endif
                       @endforeach
                   @endisset
               </div>

               <div class="col-md-10">
                   @isset($quizzes)
                       <h1>Unit 9</h1>
                       @foreach($quizzes as $quiz)
                           @if($quiz->Unit==9)
                               <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                   <h2>{{$quiz->quiz_name}}</h2>

                                   <form method="POST" action="{{ route('updateQuiz') }}" enctype="multipart/form-data">
                                       @csrf
                                       <div class="card-header"><strong>Create By -</strong> {{$quiz->created_by}}</div>
                                       <div class="card-body"><strong>Create at -</strong>  {{$quiz->created_at}}</div>
                                       <div class="row">
                                           <div class="col-md-4">
                                               {{--                                         <input type="text" id="myInput{{$quiz->id}}"  readonly value='/quiz/{{$quiz->url}}' >--}}
                                               <input type="hidden" name="id" id="myInput{{$quiz->id}}"   value={{$quiz->id}} readonly>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-2">
                                               @if($quiz->status=='deactivate')
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;"  data-dismiss="modal">Activate</button>
                                                   <input id="newState" name="newState" type="hidden" value="active">

                                               @else()
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;" data-dismiss="modal">Deactivate</button>
                                                   <input id="newState" name="newState" type="hidden" value="deactivate">
                                               @endif
                                           </div>
                                           <br/>
                                           <div class="col-md-2">
                                               {{--                                    <form method="get" action={{$quiz->path}}>--}}
                                               {{--                                        <button id="download" type="button" onclick="myFunction({{$quiz->id}})" class="btn btn-primary" data-dismiss="modal">Copy Link</button>--}}
                                               {{--                                    </form>--}}
                                           </div>
                                       </div>
                                       <div>
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
                                               @isset($studnetQuiz[$loop->index])
                                                   @foreach($studnetQuiz[$loop->index] as $st)
                                                       <tr>
                                                           <td>{{$st->name}}</td>
                                                           <td>{{$st->id}}</td>
                                                           <td>{{$st->mark}}</td>
                                                           <td>{{$st->attempt}}</td>
                                                           <td>{{$st->updated_at}}</td>
                                                       </tr>
                                                   @endforeach
                                               @endisset
                                               </tbody>
                                           </table>
                                       </div>
                                   </form>
                               </div>
                           @endif
                       @endforeach
                   @endisset
               </div>



               <div class="col-md-10">
                   @isset($quizzes)
                       <h1>Unit 10</h1>
                       @foreach($quizzes as $quiz)
                           @if($quiz->Unit==10)
                               <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                   <h2>{{$quiz->quiz_name}}</h2>

                                   <form method="POST" action="{{ route('updateQuiz') }}" enctype="multipart/form-data">
                                       @csrf
                                       <div class="card-header"><strong>Create By -</strong> {{$quiz->created_by}}</div>
                                       <div class="card-body"><strong>Create at -</strong>  {{$quiz->created_at}}</div>
                                       <div class="row">
                                           <div class="col-md-4">
                                               {{--                                         <input type="text" id="myInput{{$quiz->id}}"  readonly value='/quiz/{{$quiz->url}}' >--}}
                                               <input type="hidden" name="id" id="myInput{{$quiz->id}}"   value={{$quiz->id}} readonly>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-2">
                                               @if($quiz->status=='deactivate')
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;"  data-dismiss="modal">Activate</button>
                                                   <input id="newState" name="newState" type="hidden" value="active">

                                               @else()
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;" data-dismiss="modal">Deactivate</button>
                                                   <input id="newState" name="newState" type="hidden" value="deactivate">
                                               @endif
                                           </div>
                                           <br/>
                                           <div class="col-md-2">
                                               {{--                                    <form method="get" action={{$quiz->path}}>--}}
                                               {{--                                        <button id="download" type="button" onclick="myFunction({{$quiz->id}})" class="btn btn-primary" data-dismiss="modal">Copy Link</button>--}}
                                               {{--                                    </form>--}}
                                           </div>
                                       </div>
                                       <div>
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
                                               @isset($studnetQuiz[$loop->index])
                                                   @foreach($studnetQuiz[$loop->index] as $st)
                                                       <tr>
                                                           <td>{{$st->name}}</td>
                                                           <td>{{$st->id}}</td>
                                                           <td>{{$st->mark}}</td>
                                                           <td>{{$st->attempt}}</td>
                                                           <td>{{$st->updated_at}}</td>
                                                       </tr>
                                                   @endforeach
                                               @endisset
                                               </tbody>
                                           </table>
                                       </div>
                                   </form>
                               </div>
                           @endif
                       @endforeach
                   @endisset
               </div>


               <div class="col-md-10">
                   @isset($quizzes)
                       <h1>Unit 11</h1>
                       @foreach($quizzes as $quiz)
                           @if($quiz->Unit==11)
                               <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                   <h2>{{$quiz->quiz_name}}</h2>

                                   <form method="POST" action="{{ route('updateQuiz') }}" enctype="multipart/form-data">
                                       @csrf
                                       <div class="card-header"><strong>Create By -</strong> {{$quiz->created_by}}</div>
                                       <div class="card-body"><strong>Create at -</strong>  {{$quiz->created_at}}</div>
                                       <div class="row">
                                           <div class="col-md-4">
                                               {{--                                         <input type="text" id="myInput{{$quiz->id}}"  readonly value='/quiz/{{$quiz->url}}' >--}}
                                               <input type="hidden" name="id" id="myInput{{$quiz->id}}"   value={{$quiz->id}} readonly>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-2">
                                               @if($quiz->status=='deactivate')
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;"  data-dismiss="modal">Activate</button>
                                                   <input id="newState" name="newState" type="hidden" value="active">

                                               @else()
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;" data-dismiss="modal">Deactivate</button>
                                                   <input id="newState" name="newState" type="hidden" value="deactivate">
                                               @endif
                                           </div>
                                           <br/>
                                           <div class="col-md-2">
                                               {{--                                    <form method="get" action={{$quiz->path}}>--}}
                                               {{--                                        <button id="download" type="button" onclick="myFunction({{$quiz->id}})" class="btn btn-primary" data-dismiss="modal">Copy Link</button>--}}
                                               {{--                                    </form>--}}
                                           </div>
                                       </div>
                                       <div>
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
                                               @isset($studnetQuiz[$loop->index])
                                                   @foreach($studnetQuiz[$loop->index] as $st)
                                                       <tr>
                                                           <td>{{$st->name}}</td>
                                                           <td>{{$st->id}}</td>
                                                           <td>{{$st->mark}}</td>
                                                           <td>{{$st->attempt}}</td>
                                                           <td>{{$st->updated_at}}</td>
                                                       </tr>
                                                   @endforeach
                                               @endisset
                                               </tbody>
                                           </table>
                                       </div>
                                   </form>
                               </div>
                           @endif
                       @endforeach
                   @endisset
               </div>


               <div class="col-md-10">
                   @isset($quizzes)
                       <h1>Unit 12</h1>
                       @foreach($quizzes as $quiz)
                           @if($quiz->Unit==12)
                               <div class="card" style="background-color: #97cbff ; padding: 10px; padding-bottom: 0px;">
                                   <h2>{{$quiz->quiz_name}}</h2>

                                   <form method="POST" action="{{ route('updateQuiz') }}" enctype="multipart/form-data">
                                       @csrf
                                       <div class="card-header"><strong>Create By -</strong> {{$quiz->created_by}}</div>
                                       <div class="card-body"><strong>Create at -</strong>  {{$quiz->created_at}}</div>
                                       <div class="row">
                                           <div class="col-md-4">
                                               {{--                                         <input type="text" id="myInput{{$quiz->id}}"  readonly value='/quiz/{{$quiz->url}}' >--}}
                                               <input type="hidden" name="id" id="myInput{{$quiz->id}}"   value={{$quiz->id}} readonly>
                                           </div>
                                       </div>
                                       <div class="row">
                                           <div class="col-md-2">
                                               @if($quiz->status=='deactivate')
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;"  data-dismiss="modal">Activate</button>
                                                   <input id="newState" name="newState" type="hidden" value="active">

                                               @else()
                                                   <button id="state" type="submit"  class="btn btn-primary" style="margin-bottom:15px;" data-dismiss="modal">Deactivate</button>
                                                   <input id="newState" name="newState" type="hidden" value="deactivate">
                                               @endif
                                           </div>
                                           <br/>
                                           <div class="col-md-2">
                                               {{--                                    <form method="get" action={{$quiz->path}}>--}}
                                               {{--                                        <button id="download" type="button" onclick="myFunction({{$quiz->id}})" class="btn btn-primary" data-dismiss="modal">Copy Link</button>--}}
                                               {{--                                    </form>--}}
                                           </div>
                                       </div>
                                       <div>
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
                                               @isset($studnetQuiz[$loop->index])
                                                   @foreach($studnetQuiz[$loop->index] as $st)
                                                       <tr>
                                                           <td>{{$st->name}}</td>
                                                           <td>{{$st->id}}</td>
                                                           <td>{{$st->mark}}</td>
                                                           <td>{{$st->attempt}}</td>
                                                           <td>{{$st->updated_at}}</td>
                                                       </tr>
                                                   @endforeach
                                               @endisset
                                               </tbody>
                                           </table>
                                       </div>
                                   </form>
                               </div>
                           @endif
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
                    <h4 class="modal-title text-center">Successfully Copied the Link</h4>
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
        function myFunction(id) {
            var copyText = document.getElementById("myInput"+id);
            copyText.select();
            document.execCommand("copy");
            $('#user-registered-modal').modal('show');
        }

    </script>
@endsection
