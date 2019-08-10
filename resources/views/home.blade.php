@extends('layouts.admin-lite')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('quiz_mark'))
                        <div class="alert alert-success" role="alert">
                           You got  {{ session('quiz_mark') }}% marks for quiz "{{ session('quiz_name') }}"
                        </div>
                    @endif
                    You are logged in as a {{Auth::user()->type}} !
                </div>

            </div>
        </div>
    </div>
</div>
</br>
    <div class="row">
        <div style="background-color: #3c8dbc ; padding: 10px; height:150px; border: 1px solid green;" class="col-md-3">ICT Grade 6</div>
        <div style="background-color: #3c8dbc ; padding: 10px; height:150px; border: 1px solid green;" class="col-md-3">ICT Grade 7</div>
        <div style="background-color: #3c8dbc ; padding: 10px; height:150px; border: 1px solid green;" class="col-md-3">ICT Grade 8</div>
        <div style="background-color: #3c8dbc ; padding: 10px; height:150px; border: 1px solid green;" class="col-md-3">ICT Grade 9</div>
    </div>
    <div class="row">
        <div style="background-color: #3c8dbc ; padding: 10px; height:150px; border: 1px solid green;" class="col-md-3">ICT Grade 10</div>
        <div style="background-color: #3c8dbc ; padding: 10px; height:150px; border: 1px solid green;" class="col-md-3">ICT Grade 11</div>
        <div style="background-color: #3c8dbc ; padding: 10px; height:150px; border: 1px solid green;" class="col-md-3">ICT Grade 12</div>
    </div>
</div>
<div class="modal fade" id="modal">
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
@endsection
@section('additional-scripts')
    <script type="text/javascript">
        @isset($submitted)
         $('#modal').modal('show');
        @endisset
    </script>
@endsection

