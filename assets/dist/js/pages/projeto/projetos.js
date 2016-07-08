$().ready(function () {
    $("#btnSalvarProjeto").click(function () {
        if (formIsValid("projeto-group")) {
            salvarProjeto();
        }
    });

    function salvarProjeto() {
        var data = Object();
        var projeto = Object();

        projeto.nome_projeto = $("#name_project").val();
        projeto.descricao_projeto = $("#descricao_project").val();
        projeto.infos_projeto = $("#infos_project").val();
        projeto.url_projeto = $("#url_project").val();

        data.projeto = projeto;
        data.papel = $("#papel").val();

        $.ajax({
            type: "post",
            data: JSON.stringify(data),
            url: "projeto/projetos/salvar_projeto",
            success: function (data) {
                getListaProjetos();

                if ($("#chkIrProjeto").is(":checked")) {
                    window.location = "projeto/" + data;
                }
                clearFields("form-projeto");
            }
        });
    }

    loadSidebarProjetos();

    $('.add-projeto').click(function () {
        $("#projeto-novo-modal").modal('show');
    });

    $('#btnFecharModalProjeto').click(function () {
        clearFields("form-projeto");
    });
});

function loadSidebarProjetos() {
    $.ajax({
        type: "post",
        url: "usuario/dashboard/getListaProjetos",
        success: function (data) {
            var response = JSON.parse(data);
            $(".control-sidebar-menu").html("");
            $.each(response, function (i, obj) {
                $(".control-sidebar-menu").append("\<li>\
                                                            <a href=\"projeto/" + obj.slug_projeto + "\">\
                                                                <h4 class=\"control-sidebar-subheading\">\
                                                                    " + obj.nome_projeto + "\
                                                                    <span class=\"label label-success pull-right\">70%</span>\
                                                                </h4>\
                                                                <div class=\"progress progress-xxs\">\
                                                                    <div class=\"progress-bar progress-bar-success\" style=\"width: 70%\"></div>\
                                                                </div>\
                                                            </a>\
                                                        </li>");

            });
        }
    });
}

function getListaProjetos() {
    $.ajax({
        type: "post",
        url: "usuario/dashboard/getListaProjetos",
        success: function (data) {
            var response = JSON.parse(data);
            $("#lista-projetos .box-body").html("");
            $.each(response, function (i, obj) {
                $("#lista-projetos .box-body").append("<div class=\"post\">\
                                            <div class=\"col-md-12\">\
                                              <h4 style=\"font-weight: 600;margin: 5px 0;\">\
                                                <a href=\"projeto/" + obj.slug_projeto + "\">" + obj.nome_projeto + "</a>\
                                              </h4>\
                                              <p>\
                                                " + obj.descricao_projeto + "\
                                              </p>\
                                            </div>\
                                            <br clear=\"both\">\
                                          </div>");
            });
        }
    });
}