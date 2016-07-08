$().ready(function () {

    getListaProjetos();
    getAtividades();

    function getAtividades() {
        $.ajax({
            type: "post",
            url: "usuario/dashboard/getAtividades",
            success: function (data) {
                var response = JSON.parse(data);

                $.each(response, function (i, obj) {
                    $("#box-atividades .box-body").append("<div class=\"post\">\
                                              <!--<div class=\"user-block col-md-1\">\
                                                <img class=\"img-circle img-bordered-sm\" src=\"assets/dist/img/user8-128x128.jpg\" alt=\"user image\">\
                                              </div>-->\
                                              <div class=\"col-md-12\">\
                                                <p>\
                                                <b>" + obj.nome_projeto + "</b> - " + obj.descricao_atividade + " - " + obj.data_atividade + "\
                                                </p>\
                                              </div>\
                                              <br clear=\"both\">\
                                            </div>");
                });
            }
        });
    }
});
