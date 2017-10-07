@extends('ParserXlsToDb.index')
@section('tittle','Worker info')
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
        </tbody>
    </table>
@endsection