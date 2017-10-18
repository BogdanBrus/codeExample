@extends('ParserXlsToDb.index')
@section('tittle','Upload File')
@section('content')
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <h3>Загрузка табл. "Работники" (excel) в БД:</h3>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                    <div class="info"></div>
                    <div class="error">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    {{ $error }}
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="btn-group buttonUpload">
                        <button type="button" id="chooseUploadExcel" class="btn btn-default">Выбрать файл...</button>
                        <button type="button" id="importExcelBtn" class="btn btn-primary">Импорт</button>
                    </div>

                    {{ Form::open(array('url' => 'import', 'files'=>'true', 'id' => 'formExcelUpload', 'class' => 'hidden', 'method' => 'post')) }}
                    {{ Form::file('document') }}
                    {{ Form::submit('') }}
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>

@endsection