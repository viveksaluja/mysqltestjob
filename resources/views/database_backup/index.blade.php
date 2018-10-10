@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Backup Page</div>
                <div class="panel-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                    @if (session('warning'))
                    <div class="alert alert-warning message_show">
                        {{ session('warning') }}
                    </div>
                   @endif
                

                    {!! Form::open(array('url' => 'create-backup', 'method' => 'POST','id'=>'database_backup_form')) !!}
                        {!! Form::submit('Create Backup',['class'=>'btn btn-primary']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
