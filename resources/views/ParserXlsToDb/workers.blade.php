@extends('ParserXlsToDb.index')
@section('tittle','Workers')
@section('content')
    @if(!empty(Session::get('success')))
        <div class="alert alert-success">
            <strong>Success!</strong> {{Session::get('success')}}
        </div>
    @endif
    <table class="table table-striped">
        <thead>
        <tr>
            @foreach($current_table as $key => $value)
                <th>{{$value['ru']}}</th>
            @endforeach
        </tr>
        </thead>
        <tbody>
        @foreach($workers as $worker)
            <tr>
                @foreach($current_table as $key => $value)
                    <td>{{ $worker[$value['db_value']] }}</td>
                @endforeach
                <td>
                    <a href="{{ URL::to('workers/' . $worker->id) . '/edit'  }}" class="btn btn-default" style="float:left; margin-right:10px">Редактировать</a>

                    {!! Form::open(['method' => 'DELETE', 'route' => ['workers.destroy', $worker->id]]) !!}
                    {!!  Form::submit('Удалить',['class'=>'btn btn-danger'] ) !!}
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <div class="row">
        <div class="col-md-4" style="margin-top: 30px; float: right">
                <button type="button" onclick="location.href = '/workers/create';" class="btn btn-default">Добавить работника</button>
                <button type="button" onclick="location.href = '/export/xlsx';" class="btn btn-primary">Експорт в Ексель</button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4" style="margin-top: 10px; float: right">
                <button type="button" onclick="location.href = '/export/xlsx/1';" class="btn btn-danger">Експорт в Ексель и очистить БД</button>
        </div>
    </div>
@endsection
