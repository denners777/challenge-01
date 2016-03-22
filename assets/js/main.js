/**
 * javascript main
 * @link        https://github.com/denners777/challenge-01
 * @author      Denner Fernandes <denners777@hotmail.com>
 * */

jQuery(function ($) {
    $(".maskPhone").mask("(99) ?9 9999-9999")
            .focusout(function (event) {
                var target, phone, element;
                target = (event.currentTarget) ? event.currentTarget : event.srcElement;
                phone = target.value.replace(/\D/g, '');
                element = $(target);
                element.unmask();
                if (phone.length > 10) {
                    element.mask("(99) 9? 9999-9999");
                } else {
                    element.mask("(99) 9?999-99999");
                }
            });
    $(".maskCpf").mask("999.999.999-99");
    $(".maskMoney").maskMoney({symbol: 'R$ ', showSymbol: true, thousands: '.', decimal: ',', symbolStay: true});
    $('.maskDate').mask("99/99/9999");
    $('.maskDate').datepicker({
        format: "dd/mm/yyyy",
        autoclose: true,
        todayHighlight: true,
        toggleActive: true
    });

});

/**
 * viewRecord
 * @param {type} e
 * @returns {undefined}
 */
var viewRecord = function (e) {

    var id = $(e).attr('data-id');
    var url = $('#baseUrl').val() + '/view/';
    var title = 'Visualização';

    sendByAjax(id, url, 'viewModalContent');

    $('#viewModalLabel').html(title);
    $('#viewModal').modal('toggle');

}

/**
 * newRecord
 * @returns {undefined}
 */
var newRecord = function () {
    $('#forms').find('button[type=reset]').trigger('click');
    $('#forms #id').val('');
    if (!$('#forms').hasClass('in')) {
        $('.togglerForms').trigger('click');
    }
    $('#senha').attr('required', 'required');
    $('#senha').parents('.form-group').find('> label').html('Senha *')
}

/**
 * editRecord
 * @param {type} e
 * @returns {undefined}
 */
var editRecord = function (e) {
    var id = $(e).attr('data-id');
    var url = $('#baseUrl').val() + '/edit/';

    if (!$('#forms').hasClass('in')) {
        $('.togglerForms').trigger('click');
    }
    $('#senha').removeAttr('required');
    $('#senha').parents('.form-group').find('> label').html('Senha')


    var ajax = $.ajax({
        method: 'POST',
        url: url,
        dataType: "json",
        data: {id: id}
    });
    ajax.success(function (returned) {

        $.each(returned[0], function (key, value) {
            $('#' + key).val(value);
        });

    });
    ajax.fail(function (returned) {
        $('#display_errors').html(returned);
    });
}

/**
 * deleteRecord
 * @param {type} e
 * @returns {undefined}
 */
var deleteRecord = function (e) {

    swal({
        title: "Deseja deletar este registro?",
        text: "Se deletar este registo ele não poderá ser recuperado!",
        type: "warning",
        showCancelButton: true,
        confirmButtonClass: "btn-danger",
        confirmButtonText: "Sim, tenho certeza!",
        cancelButtonText: "Não delete isso",
        closeOnConfirm: false,
        closeOnCancel: false
    }, function (isConfirm) {
        if (isConfirm) {
            var id = $(e).attr('data-id');
            var url = $('#baseUrl').val() + '/delete/';

            sendByAjax(id, url, 'display_errors');

        } else {
            swal("Cancelado", "Registro a salvo :-)", "error");
        }
    });

}

/**
 * validaForm
 * @param {type} e
 * @returns {Boolean}
 */
var validaForm = function (e) {
    var form = $(e).find('*[required]');
    var flag = true;
    var msg = '';

    $.each(form, function (key, value) {
        if ($(value).val() == '') {
            flag = false;
        }
    });
    if (flag == false) {
        $.each(form, function (key, value) {
            msg += 'Campo ' + $(value).parents('.form-group').find('> label').html() + ' obrigatório!<br />';
        });
        $('#display_errors').html(msg);
    }

    return flag;

}

/**
 * sendByAjax
 * @param {type} data
 * @param {type} url
 * @param {type} container
 * @param {type} method
 * @returns {undefined}
 */
var sendByAjax = function (data, url, container, method) {

    method = method || 'POST';

    var ajax = $.ajax({
        method: method,
        url: url,
        data: {id: data}
    });
    ajax.success(function (returned) {
        if (returned == 'ok') {
            swal({
                title: "Deletado!",
                text: "O registro foi deletado com sucesso!!!",
                type: "success"
            }, function (isConfirm) {
                if (isConfirm) {
                    location.reload();
                } else {
                    swal("Errors", returned, "error");
                }
            });
        } else {
            $('#' + container).html(returned);
        }
    });
    ajax.fail(function (returned) {
        $('#display_errors').html(returned);
    });
};

/**
 * getCep
 * @param {type} e
 * @returns {undefined}
 */
var getCep = function (e) {
    var url = 'http://api.postmon.com.br/v1/cep/' + $(e).val();
    $('#display_errors').html('');

    var ajax = $.ajax({
        method: 'GET',
        url: url,
    });
    ajax.success(function (returned) {
        console.log(returned);
        $('#logr').val(returned.logradouro);
        $('#bairro').val(returned.bairro);
        $('#cidade').val(returned.cidade);
        $('#uf').val(returned.estado);
    });
    ajax.fail(function (returned) {
        $('#display_errors').html(returned.statusText);
    });
}