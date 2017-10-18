<div class="modal fade" id="modalCreateWorker" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="error"></div>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Новый работник:</h4>
                    </div>
                    <div class="modal-body">
                        {!! Form::open(['route' => 'workers.store', 'id' => 'formCreateWorker']) !!}
                        @foreach($current_table as $key => $value)
                            {{ Form::label($value['db_value'], $value['ru']) }}
                            {{ Form::text($value['db_value'], null, ['class' => 'form-control']) }}
                        @endforeach
                        {{ Form::submit('Добавить работника', ['class' => 'hidden']) }}
                        {!! Form::close() !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default createWorkerForm">Добавить</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

