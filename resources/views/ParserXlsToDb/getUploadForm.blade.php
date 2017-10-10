@extends('ParserXlsToDb.index')
@section('tittle','Upload File')
@section('content')
    <div class="row" style="padding-top: 10%">
        <div class="col-md-4 col-md-offset-4">
            <h2>Загрузите Excel в БД:</h2>
        </div>
    </div>
    <div class="row" style="padding-top: 30px">
        <div class="col-md-4 col-md-offset-4">
            <form action="{{ URL::to('import') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                {!! csrf_field() !!}
                <label class="btn btn-default" for="my-file-selector">
                    <input id="my-file-selector" type="file" name="document" style="display:none"
                           onchange="$('#upload-file-info').html(this.files[0].name)">
                    Выбрать файл...
                </label>
                <span class='label label-info' id="upload-file-info"></span>
                <button type="submit" class="btn btn-primary">Импортировать в БД</button>
            </form>
            @if(isset($file_err))
                <span class="label label-danger">
                 <strong>{{ $file_err }}</strong>
            </span>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            @if(!empty(Session::get('errorUpload')))
                <div class="alert alert-warning">
                    <strong>Warning!</strong> {{Session::get('errorUpload')}}
                </div>
            @endif
        </div>
    </div>
@endsection
