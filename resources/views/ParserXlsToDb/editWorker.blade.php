<div class="modal fade" id="modalEditWorker" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="error"></div>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Работник: {{ $worker->first_name }}</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::model($worker, ['route' => ['workers.update', $worker->id], 'method' => 'PUT', 'id' => 'formUpdateWorker']) !!}
                        @foreach($current_table as $key => $value)
                            {{ Form::label($value['db_value'], $value['ru']) }}
                            {{ Form::text($value['db_value'], null, ['class' => 'form-control']) }}
                        @endforeach
                        {{ Form::submit('Сохранить изменения', ['class' => 'hidden']) }}
                        {!! Form::close() !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="{{ $worker->id }}" class="btn btn-default editWorkerForm">Сохранить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
