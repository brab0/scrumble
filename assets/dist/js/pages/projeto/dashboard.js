$(function () {

    "use strict";

    getDadosProjeto();
    getAtividadesProjeto();
    getScrumTeam();

    var area = new Morris.Area({
        element: 'revenue-chart',
        resize: true,
        parseTime: false,
        data: [
            {y: '14/11', item1: 12100},
            {y: '21/11', item1: 11300},
            {y: '28/11', item1: 10420},
            {y: '04/12', item1: 9800},
            {y: '11/12', item1: 9030},
            {y: '18/12', item1: 8400},
            {y: '25/12', item1: 7905},
            {y: '01/01', item1: 3430}
        ],
        xkey: 'y',
        ykeys: ['item1'],
        labels: ['Quantidade de Estórias'],
        lineColors: ['#a0d0e0'],
        hideHover: 'auto'
    });

    $("#add-integrante").click(function () {
        $("#integrante-novo-modal").modal("show");
    });

    $('#btnFecharModalIntegrante').click(function () {
        clearFields("form-integrante");
    });

    $("#btnAdicionarIntegrante").click(function () {
        if(formIsValid("scrum-team-group")){
            adicionarIntegrante();
        }
    });

    function adicionarIntegrante() {
        var data = Object();
        data.email_usuario = $("#email-usuario").val();
        data.id_papel = $("#id-papel").val();

        $.ajax({
            type: "post",
            data: JSON.stringify(data),
            url: "projeto/scrum_team/adicionar_integrante",
            success: function (status) {
                clearFields("form-integrante");
                getScrumTeam();
                if (!$("#chkContinuarIntegrante").is(":checked")) {
                    $("#integrante-novo-modal").modal('hide');
                }
            }
        });
    }

    $('#add-estoria').click(function () {
        $("#modal-estorias").modal('show');
    });

    $('#btnFecharModalEstoria').click(function () {
        clearFields("form-estoria");
        $("#modal-estorias").modal('hide');
    });

    $("#btnSalvarEstoria").click(function () {
        if(formIsValid("product-backlog-group")){      
            salvarEstoria();
        }    
    });

    function salvarEstoria() {
        var data = Object();
        data.prioridade_estoria = $("#prioridade_estoria").val();
        data.descricao_estoria = $("#descricao_estoria").val();
        data.info_estoria = $("#info_estoria").val();
        
        $.ajax({
            type: "post",
            data: JSON.stringify(data),
            url: "projeto/product_backlog/salvar_estoria",
            success: function (status) {
                clearFields("form-estoria");
                if (!$("#chkContinuar").is(":checked")) {
                    $("#modal-estorias").modal('hide');
                }
            }
        });
    }

    function getDadosProjeto() {
        $.ajax({
            type: "post",
            url: "projeto/dashboard/getDadosProjeto",
            success: function (data) {
                var response = JSON.parse(data);

                $("#box-projeto .box-header #nome_projeto").text(response.nome_projeto);

                $("#box-projeto .box-body #descricao_projeto").text(response.descricao_projeto);
                $("#box-projeto .box-body #url_projeto").html("<a href=\"" + response.url_projeto + "\">" + response.url_projeto + "</a>");
                $("#box-projeto .box-body #sprint-projeto").text(response.sprint_projeto);
                $("#box-projeto .box-body #infos-projeto").text(response.infos_projeto);
            }
        });
    }

    function getAtividadesProjeto() {
        $.ajax({
            type: "post",
            url: "projeto/dashboard/getAtividadesProjeto",
            success: function (data) {
                var response = JSON.parse(data);

                $.each(response, function (i, obj) {
                    $("#box-atividades .box-body").append("<div class=\"post\">\
                                          <!--<div class=\"user-block col-md-1\">\
                                            <img class=\"img-circle img-bordered-sm\" src=\"assets/dist/img/user8-128x128.jpg\" alt=\"user image\">\
                                          </div>-->\
                                          <div class=\"col-md-12\">\
                                            <p>\
                                            " + obj.descricao_atividade + " - " + obj.data_atividade + "\
                                            </p>\
                                          </div>\
                                          <br clear=\"both\">\
                                        </div>");
                });
            }
        });
    }

    function getScrumTeam() {
        $.ajax({
            type: "post",
            url: "projeto/scrum_team/getScrumTeam",
            success: function (data) {
                var response = JSON.parse(data);
                $("#box-scrum-team .box-body .users-list").html("");
                $.each(response, function (i, obj) {
                    $("#box-scrum-team .box-body .users-list").append("<li style=\"width: 100%;text-align:left; border-bottom:1px dotted #f0f0f0\">\
                                                                        <a class=\"users-list-name\" href=\"#\">" + obj.nome_usuario + "</a>\
                                                                        <span class=\"text-left users-list-date\">" + obj.nome_papel + "</span>\
                                                                      </li>");

                    $("#qtd-integrantes").text(parseInt(i + 1) + " Integrantes");

                });
            }
        });
    }
});
