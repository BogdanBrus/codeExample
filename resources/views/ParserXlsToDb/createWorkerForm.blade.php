@extends('ParserXlsToDb.index')
@section('tittle','Create worker')
@section('content')
    <!-- Form for create Worker -->
    {!! Form::open(['route' => 'workers.store']) !!}
    <div class="form-group">
        <div class="col-md-3 col-md-offset-3">
            @foreach($current_table as $key => $value)
                {{ Form::label($value['db_value'], $value['ru']) }}
                {{ Form::text($value['db_value'], null, ['class' => 'form-control']) }}
            @endforeach
            {{ Form::submit('Добавить работника', ['class' => 'col-md-12 btn btn-primary center-block']) }}
        </div>
    </div>
    {!! Form::close() !!}
    <!-- Validation -->
    @if (isset($errors) && count($errors) > 0)
        <div class="col-md-8 col-md-offset-2">
            <div class="alert alert-danger" style="margin-top: 30px">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif
@endsection
