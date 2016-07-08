function formIsValid(group_required) {
    var valid = false;

    $(".form-group:not('.has-success') input[data-required='"+group_required+"'],\
           .form-group:not('.has-success') textarea[data-required='"+group_required+"'],\
           .form-group:not('.has-success') select[data-required='"+group_required+"']").parent().addClass('has-error').children('label').children('i').remove();

    $(".form-group:not('.has-success') input[data-required='"+group_required+"'],\
           .form-group:not('.has-success') textarea[data-required='"+group_required+"'],\
           .form-group:not('.has-success') select[data-required='"+group_required+"']").parent().children('label').append('<i class="fa fa-times-circle-o" style="margin: 0 5px;">');
    
    $(".input-group :not('.has-success') input[data-required='"+group_required+"'],\
           .input-group :not('.has-success') textarea[data-required='"+group_required+"'],\
           .input-group :not('.has-success') select[data-required='"+group_required+"']").parent().addClass('has-error').children('label').children('i').remove();

    $(".input-group :not('.has-success') input[data-required='"+group_required+"'],\
           .input-group :not('.has-success') textarea[data-required='"+group_required+"'],\
           .input-group :not('.has-success') select[data-required='"+group_required+"']").parent().children('label').append('<i class="fa fa-times-circle-o" style="margin: 0 5px;">');

    if ($('input[data-required="'+group_required+'"], textarea[data-required="'+group_required+'"], select[data-required="'+group_required+'"]').parent().hasClass("has-error")) {
        valid = false;
    } else {
        valid = true;
    }

    return valid;
}

function clearFields(id_form) {
    $("#"+id_form+" input, #"+id_form+" textarea").val("");

    $("#"+id_form+" select option:first-child").attr("selected", "selected");

    $("#"+id_form+" input, #"+id_form+" textarea, #"+id_form+" select").parent().removeClass("has-success").children('label').children('i').remove();
}

$().ready(function () {
    $('input[data-required], textarea[data-required], select[data-required]').change(function () {
        if ($(this).val() == "") {
            $(this).parent().removeClass('has-success').children('label').children('i').remove();
            $(this).parent().addClass('has-error').children('label').append('<i class="fa fa-times-circle-o" style="margin: 0 5px;">');
        } else if (!$(this).parent().hasClass('has-success')) {
            $(this).parent().removeClass('has-error').children('label').children('i').remove();
            $(this).parent().addClass('has-success').children('label').append('<i class="fa fa-check" style="margin: 0 5px;"></i>');
        }
    });

    $('input[data-required], textarea[data-required], select[data-required]').blur(function () {
        if ($(this).val() == "") {
            $(this).parent().removeClass('has-success').children('label').children('i').remove();
            $(this).parent().addClass('has-error').children('label').append('<i class="fa fa-times-circle-o" style="margin: 0 5px;">');
        } else if (!$(this).parent().hasClass('has-success')) {
            $(this).parent().removeClass('has-error').children('label').children('i').remove();
            $(this).parent().addClass('has-success').children('label').append('<i class="fa fa-check" style="margin: 0 5px;"></i>');
        }
    });

    $('input[data-required], textarea[data-required]').keyup(function () {
        if (($(this).val() == "") && (($(this).parent().hasClass('has-error')) || ($(this).parent().hasClass('has-success')))) {
            $(this).parent().removeClass('has-success').children('label').children('i').remove();
            $(this).parent().addClass('has-error').children('label').append('<i class="fa fa-times-circle-o" style="margin: 0 5px;">');
        } else if ((!$(this).parent().hasClass('has-success')) && ($(this).val() != "")) {
            $(this).parent().removeClass('has-error').children('label').children('i').remove();
            $(this).parent().addClass('has-success').children('label').append('<i class="fa fa-check" style="margin: 0 5px;"></i>');
        }
    });
});