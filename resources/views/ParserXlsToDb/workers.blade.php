@extends('ParserXlsToDb.index')
@section('tittle','Workers')
@section('content')
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="info"></div>
            {{--<div class="error"></div>--}}
            <table class="table table-striped" id="workersTable">
                <thead>
                <tr>
                    @foreach($current_table as $key => $value)
                        <th>{{$value['ru']}}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                @foreach($workers as $worker)
                    <tr id="{{ $worker->id }}">
                        @foreach($current_table as $key => $value)
                            <td id="{{ $value['db_value'] }}">{{ $worker[$value['db_value']] }}</td>
                        @endforeach
                        <td>
                            <div class="btn-group-vertical btn-group-sm">
                                <button type="button" id="{{ $worker['id'] }}" class="btn btn-info showWorkerBtn">Инфо</button>
                                <button type="button" id="{{ $worker['id'] }}" class="btn btn-default editWorkerBtn">Редактировать</button>
                                <button type="button" id="{{ $worker['id'] }}" class="btn btn-danger deleteWorkerBtn">Удалить</button>
                            </div>
                            <form action="{{ URL::route('workers.destroy', $worker['id']) }}" method="POST" id="formDeleteWorker">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>




    <div class="row">
        <div class="col-4">
            <button type="button" class="btn btn-success createWorkerBtn">Добавить работника</button>
        </div>
        <div class="col-4 col-md-offset-6">
            <div class="btn-group controlPanelExcel btn-group-md">
                <button type="button" class="btn btn-primary exportExcelBtn">Експорт в Ексель</button>
                <button type="button" class="btn btn-danger exportExcelDeleteBtn">Експорт c очисткой</button>
            </div>
        </div>
    </div>
    <div class="response"></div>

@endsection