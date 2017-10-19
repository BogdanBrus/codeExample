/**************************************************************************************************************
 ***************************************************   CRUD WORKER    *****************************************
 **************************************************************************************************************/

/********************Button ShowWorker********************/
$('body').delegate('.showWorkerBtn', 'click', function() {
    var worker_id = $(this).attr('id');

    $.ajax({
        url: '/workers/' + worker_id,
        method: 'GET',
        success: function(result) {
            $("div.response").html(result);
            $("#modalShowWorker").modal();
        },
        error: function(data, msg){
            validatedError(data, msg);
        }
    });
});

$('body').delegate('.closeInfo', 'click', function () {
    var modal_id = $(this).attr('name');
    $('#'+modal_id).hide();
});
/*******************************************************************/


/********************Button UploadExcel********************/
$('#chooseUploadExcel').on('click', function () {
    $('input[name="document"]').click();
});

$('input[name="document"]').change(function() {
    $("#chooseUploadExcel").html(this.value);
});

$('#importExcelBtn').on('click', function () {
    $('#formExcelUpload').submit();
});
/*******************************************************************/


/********************Button ExportExcel********************/
$(".exportExcelBtn").on('click', function () {
    $(location).attr('href', '/export/');
});


$(".exportExcelDeleteBtn").on('click', function () {
    $(location).attr('href', '/export/1');
    $("#workersTable").find('tbody').empty();
});
/*******************************************************************/

/********************Form Edit Worker**********************/
$("body").delegate(".editWorkerBtn", "click", function () {
    var element_id = $( this ).attr("id");

    $.ajax({
        url: '/workers/' + element_id + '/edit',
        method: 'GET',
        success: function(result) {
            $("div.response").html(result);
            $("#modalEditWorker").modal();
        },
        error: function(data, msg){
            validatedError(data, msg);
        }
    });
});
/*******************************************************************/


/********************Create Worker**********************/
$(".createWorkerBtn").on("click", function () {
    $.ajax({
        url: '/workers/create',
        method: 'GET',
        success: function(result) {
            $("div.response").html(result);
            $("#modalCreateWorker").modal();
        },
        error: function(data, msg){
            validatedError(data, msg);
        }
    });
});
/*******************************************************************/


/********************Store Worker**********************/
$("body").delegate(".createWorkerForm","click", function () {

    $.ajax({
        type: 'POST',
        url: '/workers',
        data: $("#formCreateWorker").serialize(),
        success: function(response)
        {
            var data = JSON.parse(response)
            var rowWorker = "";
            $.each(data, function (key, value) {
                if(key != 'id') {
                    rowWorker += '<td id="' + key + '">' + value + '</td>';
                }
            });

            $("#workersTable").find('tbody').append('<tr id="' + data['id'] + '">');
            $("#workersTable").find('tbody tr:last-child').append(rowWorker)
                .append('<td><div class="btn-group-vertical btn-group-sm">' +
                    '<button type="button" id="' + data['id'] + '" class="btn btn-info showWorkerBtn">Редактировать</button>'+
                    '<button type="button" id="' + data['id'] + '" class="btn btn-primary editWorkerBtn">Редактировать</button>' +
                    '<button type="button" id="' + data['id'] + '" class="btn btn-danger deleteWorkerBtn">Удалить</button></div></td>');
            $("#modalCreateWorker").hide();
            successInfo( 'Новый работник добавлен!');
        },
        error: function(data, msg){
            validatedError(data, msg);
        }
    });
});
/*******************************************************************/


/********************Delete Worker**********************/
$("body").delegate(".deleteWorkerBtn", "click", function () {
    var element_id = $(this).attr("id");

    $.ajax({
        type: 'DELETE',
        url: '/workers/' + element_id,
        data: $("#formDeleteWorker").serialize(),
        success: function(response) {
            $("tr[id=" + element_id + "]").empty()
            successInfo(response +'Работник удален!');
        },
        error: function(data, msg){
            validatedError(data, msg);
        }
    });
});
/*******************************************************************/


/********************Update Worker**********************/
$("body").delegate(".editWorkerForm","click", function () {
    var element_id = $(this).attr("id");

    $.ajax({
        type: 'PUT',
        url: '/workers/' + element_id,
        data: $("#formUpdateWorker").serialize(),
        success: function(response)
        {
            var data = JSON.parse(response)
            $.each(data, function (key, value) {
                $("tr[id=" + element_id + "]").find("td[id=" + key + "]").text(value);
            });
            $("#modalEditWorker").hide();
            successInfo( 'Изменения сохранены!');
        },
        error: function(data, msg){
            validatedError(data, msg);
        }
    });
});
/*******************************************************************/


/**************************************************************************************************************
 ***************************************************     HELPERS     *****************************************
 **************************************************************************************************************/


/********************Success Info**********************/
function successInfo(msg) {
    $(".info").html('<div class="alert alert-success">' + msg + '</div>');
    if ($(".error").val() !== null) $(".error").children().fadeOut();
    $(".info").children().fadeOut(2000);
}
/*******************************************************************/


/**********************Error Info************************/
function errorInfo(msg) {
    $(".error").html('<div class="alert alert-danger">' + msg +'</div>');
}
/*******************************************************************/


/***************************Validated error***************************/
function validatedError(data, msg) {
    if ( data.status === 422 ) {
        var errors = data.responseJSON['errors']
        var errorsHtml ='<ul>';
        $.each( errors , function( key, value ) {
            errorsHtml += '<li>' + value[0] + '</li>'; //showing only the first error.
        });
        errorsHtml += '</ul>';
        errorInfo(errorsHtml);
    } else {
        errorInfo(msg);
    }
}
/*******************************************************************/
