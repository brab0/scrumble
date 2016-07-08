$(function () {

    "use strict";

    $("#btn-cadastrar").click(function () {
        if (formIsValid("cadastro-group")) {
            cadastrarUsuario();
        }
    });

    function cadastrarUsuario() {
        var data = Object();
        data.nome_usuario = $("#nome-usuario").val();
        data.email_usuario = $("#email-usuario").val();
        data.senha_usuario = $("#senha-usuario").val();

        $.ajax({
            type: "post",
            data: JSON.stringify(data),
            url: "registro/cadastrar_usuario",
            success: function (status) {
                location.href = "login"
                //clearFields();
            }
        });
    }
});
