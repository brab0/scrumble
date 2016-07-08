$(function () {

    "use strict";

    getDadosSprint(true, true);
    getDdlDevelopmentTeam();
    
    var tarefas = new Object();
    tarefas.remove = [];
    tarefas.insert = [];
    tarefas.update = [];   
    
    function loadSprintBurndown(qtdDias, qtdPontos) {
        $.ajax({
            type: "post",
            data: "id_sprint=" + $("#box-sprint").attr("data-id"),
            url: "projeto/sprint/getSprintBurndown",
            success: function (data) {
                var response = JSON.parse(data);

                var velocidadeIdeal = [];
                var velocidadeReal = [];
                var diasSprint = [];

                var interval_pontos = (qtdPontos / qtdDias) + ((qtdPontos / qtdDias) / (qtdDias - 1));

                for (var i = 0; i < qtdDias; i++) {
                    diasSprint.push("Dia " + parseInt(i + 1));
                    if (parseInt(i + 1) === qtdDias) {
                        velocidadeIdeal.push(Math.round(qtdPontos - (i * interval_pontos)));
                    }
                    else {
                        velocidadeIdeal.push(parseFloat((qtdPontos - (i * interval_pontos)).toFixed(1)));
                    }
                }

                $.each(response, function (i, obj) {
                    velocidadeReal.push(parseInt(obj.pontos_tarefas));
                });

                $('#revenue-chart').highcharts({
                    colors: ['blue', 'red'],
                    title: {
                        text: '',
                        x: -20 //center
                    },
                    plotOptions: {
                        line: {
                            lineWidth: 3
                        },
                        tooltip: {
                            hideDelay: 200
                        }
                    },
                    xAxis: {
                        categories: diasSprint
                    },
                    yAxis: {
                        title: {
                            text: 'Esforço'
                        },
                        plotLines: [{
                                value: 0,
                                width: 1
                            }]
                    },
                    tooltip: {
                        valueSuffix: ' pts',
                        crosshairs: true,
                        shared: true
                    },
                    legend: {
                        layout: 'vertical',
                        align: 'right',
                        verticalAlign: 'middle',
                        borderWidth: 0
                    },
                    series: [{
                            name: 'Velocidade Ideal',
                            color: 'rgba(255,0,0,0.25)',
                            lineWidth: 2,
                            data: velocidadeIdeal
                        }, {
                            name: 'Velocidade Real',
                            color: 'rgba(0,120,200,0.75)',
                            marker: {
                                radius: 6
                            },
                            data: velocidadeReal
                        }]
                });
            }
        });
    }

    function getDadosSprint(refresh_chart, refresh_storyboard) {
        $.ajax({
            type: "post",
            url: "projeto/sprint/getDadosSprint",
            success: function (data) {
                var response = JSON.parse(data);

                if (response.geral) {
                    if (response.geral.status_sprint == "andamento") {
                        $("#wrap-sprint").removeClass("hidden");
                        var tamanho_sprint = response.geral.tamanho_sprint;
                        var box_tamanho = "";
                        if (tamanho_sprint == 1) {
                            box_tamanho = "1 Semana";
                        }
                        else {
                            box_tamanho = tamanho_sprint + " Semanas";
                        }

                        $("#box-sprint").attr("data-id", response.geral.id_sprint);
                        $("#box-sprint .box-header #num_sprint").text("Sprint #" + response.geral.num_sprint);
                        $("#box-sprint .box-body #objetivo_sprint").text(response.geral.objetivo_sprint);
                        $("#box-sprint .box-body #periodo_sprint").text("De " + moment(response.geral.data_ini_sprint).format("DD/MM") + " até " + moment(response.geral.data_fim_sprint).format("DD/MM") + " - " + box_tamanho);
                        $("#box-sprint .box-body #info_sprint").text(response.geral.info_sprint);
                        $("#box-sprint .box-body #velocidade_sprint").text(response.geral.velocidade_sprint + " pts");

                        $("#title-storyboard #dia-atual").text("Dia " + response.geral.dia_atual);
                        $("#title-storyboard #data-atual").text(" (" + moment(response.geral.data_atual).format("DD/MM") + ")");

                        if (response.status.todo) {
                            $("#info-box-todo .info-box-content .info-box-qtd-pontos").text(response.status.todo.qtd_pontos + " pts");
                            $("#info-box-todo .info-box-content .info-box-qtd-tarefas").text(response.status.todo.qtd_tarefas + " tarefas");
                        }
                        else {
                            $("#info-box-todo .info-box-content .info-box-qtd-pontos").text("0 pts");
                            $("#info-box-todo .info-box-content .info-box-qtd-tarefas").text("Nenhuma Tarefa");
                        }

                        if (response.status.andamento) {
                            $("#info-box-andamento .info-box-content .info-box-qtd-pontos").text(response.status.andamento.qtd_pontos + " pts");
                            $("#info-box-andamento .info-box-content .info-box-qtd-tarefas").text(response.status.andamento.qtd_tarefas + " tarefas");
                        }
                        else {
                            $("#info-box-andamento .info-box-content .info-box-qtd-pontos").text("0 pts");
                            $("#info-box-andamento .info-box-content .info-box-qtd-tarefas").text("Nenhuma Tarefa");
                        }

                        if (response.status.teste) {
                            $("#info-box-teste .info-box-content .info-box-qtd-pontos").text(response.status.teste.qtd_pontos + " pts");
                            $("#info-box-teste .info-box-content .info-box-qtd-tarefas").text(response.status.teste.qtd_tarefas + " tarefas");
                        }
                        else {
                            $("#info-box-teste .info-box-content .info-box-qtd-pontos").text("0 pts");
                            $("#info-box-teste .info-box-content .info-box-qtd-tarefas").text("Nenhuma Tarefa");
                        }

                        if (response.status.feito) {
                            $("#info-box-feito .info-box-content .info-box-qtd-pontos").text(response.status.feito.qtd_pontos + " pts");
                            $("#info-box-feito .info-box-content .info-box-qtd-tarefas").text(response.status.feito.qtd_tarefas + " tarefas");
                        }
                        else {
                            $("#info-box-feito .info-box-content .info-box-qtd-pontos").text("0 pts");
                            $("#info-box-feito .info-box-content .info-box-qtd-tarefas").text("Nenhuma Tarefa");
                        }

                        var qtdDias = getQtdDiasUteis(response.geral.data_ini_sprint, response.geral.data_fim_sprint);
                        
                        if (refresh_chart) {
                            loadSprintBurndown(qtdDias, response.geral.velocidade_sprint);
                        }

                        if (refresh_storyboard) {
                            getStoryboard(response.geral.id_sprint);
                        }
                    } else if (response.geral.status_sprint == "planning") {
                        window.location = "projeto/" + response.geral.slug_projeto + "/sprint/sprint-planning";
                    } else {
                        $("#wrap-sprint").html("<div class=\"box box-primary\" id=\"box-sprint-backlog\">\
                                                    <div class=\"box-body\">\
                                                      <h4 style=\"text-align: center;margin: 20px;\">Nenhum Sprint ativo para este projeto.</h4>\
                                                    </div>\
                                                </div>");
                        $("#wrap-sprint").removeClass("hidden");
                    }
                } else {
                    $("#wrap-sprint").html("<div class=\"box box-primary\" id=\"box-sprint-backlog\">\
                                                <div class=\"box-body\">\
                                                  <h4 style=\"text-align: center;margin: 20px;\">Nenhum Sprint ativo para este projeto.</h4>\
                                                </div>\
                                            </div>");
                    $("#wrap-sprint").removeClass("hidden");
                }
            }
        });
    }
    function salvarStatusTarefa(element_tarefa) {
        var status_origem = "";

        if (element_tarefa.sender) {
            status_origem = element_tarefa.sender[0].offsetParent.className;
        }
        var tarefa = new Object();
        tarefa.status_tarefa = element_tarefa.item.parent().parent().attr("class");
        tarefa.id_status_tarefas = element_tarefa.item.attr("data-id");
        $.ajax({
            type: "post",
            data: JSON.stringify(tarefa),
            url: "projeto/sprint/salvar_status_tarefa",
            complete: function () {
                var refresh_chart = false;
                var refresh_storyboard = false;

                if ((tarefa.status_tarefa === "feito") || (status_origem === "feito")) {
                    refresh_chart = true;
                }
                getDadosSprint(refresh_chart, refresh_storyboard);
            }
        });
    }

    function getStoryboard(id_sprint) {
        $.ajax({
            type: "post",
            data: "id_sprint=" + id_sprint,
            url: "projeto/sprint/getStoryboard",
            success: function (data) {
                var response = JSON.parse(data);
                $("#box-storyboard .box-body table tbody").html("");
                var lista = "";
                $.each(response, function (i, obj) {

                    var infos = "";

                    if ((obj.info_estoria !== null) && (obj.info_estoria !== "")) {
                        infos = "<button type=\"button\" class=\"btn btn-xs btn-default\" data-toggle=\"tooltip\" data-placement=\"right\" title=\"" + obj.info_estoria.replace(/"/g, '&quot;') + "\">Informações Adicionais</button>";
                    }                                       
                    
                    lista += "<tr>\
                                    <td class=\"todo\" data-id=" + obj.id_sprints_has_estorias + ">\
                  							<p style=\"padding: 10px;\">" + obj.descricao_estoria + "</p>" + infos + "<h4><b>" + obj.pontos_estoria + " pts</b></h4>\
                  							<div class=\"tools\" style=\"margin:10px 0\">\
						                    	<a href=\"#\" class=\"edit_estoria\"><i class=\"fa fa-edit\"></i></a>\
						                  	</div>\
                  						<ul class=\"connectedSortable\">";
						                    if (obj.tarefas.todo) {
						                        $.each(obj.tarefas.todo, function (i, tarefa) {
						                            lista += "<li data-id=\"" + tarefa.id_status_tarefas + "\"><h6 style=\"font-weight: bold;padding: 0 0 5px;margin: 0;border-bottom: 1px dotted #c9c9c9;font-size: 11px;\">" + tarefa.nome_usuario + "</h6><p>" + tarefa.descricao_tarefa + "</p><h5><b>" + tarefa.pontos_tarefa + " pts</b></h5></li>";
						                        });
						                    }
						      lista += "</ul>\
                                    </td>";
//                                    <td class=\"todo\">\
//                                        <ul class=\"connectedSortable\">";
//                    if (obj.tarefas.todo) {
//                        $.each(obj.tarefas.todo, function (i, tarefa) {
//                            lista += "<li data-id=\"" + tarefa.id_status_tarefas + "\"><h6 style=\"font-weight: bold;padding: 0 0 5px;margin: 0;border-bottom: 1px dotted #c9c9c9;font-size: 11px;\">" + tarefa.nome_usuario + "</h6><p>" + tarefa.descricao_tarefa + "</p><h5><b>" + tarefa.pontos_tarefa + " pts</b></h5></li>";
//                        });
//                    }
                    lista += "</ul>\
                                    </td>\
                                    <td class=\"andamento\">\
                                        <ul class=\"connectedSortable\">";
                    $.each(obj.tarefas.andamento, function (i, tarefa) {
                        lista += "<li data-id=\"" + tarefa.id_status_tarefas + "\"><h6 style=\"font-weight: bold;padding: 0 0 5px;margin: 0;border-bottom: 1px dotted #c9c9c9;font-size: 11px;\">" + tarefa.nome_usuario + "</h6><p>" + tarefa.descricao_tarefa + "</p><h5><b>" + tarefa.pontos_tarefa + " pts</b></h5></li>";
                    });
                    lista += "</ul>\
                                    </td>\
                                    <td class=\"teste\">\
                                        <ul class=\"connectedSortable\">";
                    $.each(obj.tarefas.teste, function (i, tarefa) {
                        lista += "<li data-id=\"" + tarefa.id_status_tarefas + "\"><h6 style=\"font-weight: bold;padding: 0 0 5px;margin: 0;border-bottom: 1px dotted #c9c9c9;font-size: 11px;\">" + tarefa.nome_usuario + "</h6><p>" + tarefa.descricao_tarefa + "</p><h5><b>" + tarefa.pontos_tarefa + " pts</b></h5></li>";
                    });
                    lista += "</ul>\
                                    </td>\
                                    <td class=\"feito\">\
                                        <ul class=\"connectedSortable\">";
                    $.each(obj.tarefas.feito, function (i, tarefa) {
                        lista += "<li data-id=\"" + tarefa.id_status_tarefas + "\"><h6 style=\"font-weight: bold;padding: 0 0 5px;margin: 0;border-bottom: 1px dotted #c9c9c9;font-size: 11px;\">" + tarefa.nome_usuario + "</h6><p>" + tarefa.descricao_tarefa + "</p><h5><b>" + tarefa.pontos_tarefa + " pts</b></h5></li>";
                    });
                    lista += "</ul>\
                                    </td>\
                                </tr>";
                });
                $("#box-storyboard .box-body table tbody").html(lista);
            },
            complete: function (data) {
                $("#box-storyboard ul").sortable({
                    placeholder: "sort-highlight",
                    forcePlaceholderSize: true,
                    zIndex: 9999999,
                    connectWith: ".connectedSortable",
                    update: function (event, ui) {
                        salvarStatusTarefa(ui);
                    }
                });
                $("#box-storyboard ul li").humanyze();

                $('[data-toggle="tooltip"]').tooltip();                                               
                
                $("#box-storyboard .box-body table tbody tr td div .edit_estoria").on("click", function (e) {
                    $("span[for=\"chkContinuarEstoria\"]").addClass("hidden");
                    editEstoria($(this).parent().parent().attr("data-id"));
                    
                    $("#estorias-planning-modal").modal("show");
                    
                    e.preventDefault();
                });
            }
        });
    }
    
    
    function editEstoria(id_sprints_has_estorias) {
        $.ajax({
            type: "post",
            data: "id_sprints_has_estorias="+id_sprints_has_estorias,
            url: "projeto/sprint/editEstoria",
            success: function (data) {
                var info = "";
                var response = JSON.parse(data);                
                tarefas.remove = [];
                tarefas.insert = [];
                tarefas.update = [];
                
                if((response.info_estoria!=null)&&(response.info_estoria=="")){
                    info = response.info_estoria;
                }
                
                $("#form-estoria").attr("data-status", "updt");    
                $("#form-estoria").attr("data-id-estoria", response.id_sprints_has_estorias);
                $("#estoria_planning_descricao").attr("data-id", response.id_estoria).html("<b>Estória #" + response.id_estoria + "</b> - " + response.descricao_estoria + info);
                $("#box-tarefas tbody").html("");  
                $.each(response.tarefas, function(i, tarefa){                      
                    $("#box-tarefas tbody").append("<tr>\
                          <td style=\"display:none\" class=\"id_usuario_table\">" + tarefa.id_usuarios_has_projetos + "</td>\
                          <td style=\"display:none\" class=\"id_tarefa_table\">" + tarefa.id_tarefa + "</td>\
                          <td style=\"width:20%\">" + tarefa.nome_usuario + "</td>\
                          <td style=\"width:60%\" class=\"descricao_tarefa_table\">" + tarefa.descricao_tarefa + "</td>\
                          <td style=\"width:8%\">\
                            <select class=\"ddl_pts_table\">\
                              <option value=\"0\">0</option>\
                              <option value=\"1\">1</option>\
                              <option value=\"2\">2</option>\
                              <option value=\"3\">3</option>\
                              <option value=\"5\">5</option>\
                              <option value=\"8\">8</option>\
                              <option value=\"13\">13</option>\
                              <option value=\"21\">21</option>\
                              <option value=\"40\">40</option>\
                              <option value=\"100\">100</option>\
                            </select>\
                            </td>\\n\
                          <td style=\"width:8%\">\
                            <select class=\"ddl_tipo_table\">\
                              <option value=\"Desenvolvimento\">Desenvolvimento</option>\
                              <option value=\"Correção\">Correção</option>\
                              <option value=\"Teste\">Teste</option>\
                              <option value=\"Análise\">Análise</option>\
                              <option value=\"Impedimento\">Impedimento</option>\
                            </select>\
                          </td>\
                          <td style=\"width:4%\">\
                            <a href=\"#\" class=\"remove-tarefa-salva\"><i class=\"fa fa-trash-o\"></i></a>\
                          </td>\
                        </tr>");                
                    
                    $("#box-tarefas tbody tr").eq(i).children("td").children(".ddl_pts_table").val(tarefa.pontos_tarefa);
                    $("#box-tarefas tbody tr").eq(i).children("td").children(".ddl_tipo_table").val(tarefa.tipo_tarefa);                    
                });
            },
            complete: function(){
                $(".remove-tarefa-salva").click(function(e) {
                    tarefas.remove.push($(this).parent().parent().children(".id_tarefa_table").text());                    
                    $(this).parent().parent().remove();
                    e.preventDefault();
                });   
            }
        });
    }    
    
    $("#estorias-planning-modal").on('hidden.bs.modal',function () {
        $("#estoria_planning_descricao").text("");
        $("#chkContinuarEstoria").attr("checked", false).parent().removeClass("hidden");
        clearFields("form-estoria");
    });

    $("#btnSalvarPlanejamento").click(function () {        
        var data = Object();
        var sprints_has_estorias = Object();

        $("#box-tarefas tbody tr").each(function (i) {
            var tarefa = Object();
            
            tarefa.id_tarefa = $(this).children(".id_tarefa_table").text();
            tarefa.id_usuarios_has_projetos = $(this).children(".id_usuario_table").text();
            tarefa.descricao_tarefa = $(this).children(".descricao_tarefa_table").text();
            tarefa.pontos_tarefa = $(this).children("td").children(".ddl_pts_table").val();
            tarefa.tipo_tarefa = $(this).children("td").children(".ddl_tipo_table").val();
            
            if($(this).children(".id_tarefa_table").text()==""){
                tarefas.insert.push(tarefa);   
            }
            else{
                tarefas.update.push(tarefa);
            }
        });

        sprints_has_estorias.id_estoria = $("#estoria_planning_descricao").attr("data-id");
        sprints_has_estorias.id_sprint = $("#box-sprint").attr("data-id");
        sprints_has_estorias.id_sprints_has_estorias = $("#form-estoria").attr("data-id-estoria");

        data.sprints_has_estorias = sprints_has_estorias;
        data.tarefas = tarefas;        
        
        $.ajax({
            type: "post",
            data: JSON.stringify(data),
            url: "projeto/sprint/salvarPlanejamento",
            success: function (id_sprint) {
            	getDadosSprint(true, true);
                $("#box-tarefas tbody").html("");                
                $("#estorias-planning-modal").modal('hide');                
            }
        });
    });    

    $("#btnAddTarefa").click(function() {
        if (formIsValid("sprint-backlog-group")) {
            
            $("#box-tarefas tbody").append("<tr>\
                                  <td style=\"display:none\" class=\"id_usuario_table\">" + $("#usuario_tarefa").val() + "</td>\
                                  <td style=\"display:none\" class=\"id_tarefa_table\"></td>\
                                  <td style=\"width:20%\">" + $("#usuario_tarefa option:selected").text() + "</td>\
                                  <td style=\"width:60%\" class=\"descricao_tarefa_table\">" + $("#descricao_tarefa").val() + "</td>\
                                  <td style=\"width:8%\">\
                                    <select class=\"ddl_pts_table\">\
                                      <option value=\"0\">0</option>\
                                      <option value=\"1\">1</option>\
                                      <option value=\"2\">2</option>\
                                      <option value=\"3\">3</option>\
                                      <option value=\"5\">5</option>\
                                      <option value=\"8\">8</option>\
                                      <option value=\"13\">13</option>\
                                      <option value=\"21\">21</option>\
                                      <option value=\"40\">40</option>\
                                      <option value=\"100\">100</option>\
                                    </select>\
                                    </td>\\n\
                                  <td style=\"width:8%\">\
                                    <select class=\"ddl_tipo_table\">\
                                      <option value=\"Desenvolvimento\">Desenvolvimento</option>\
                                      <option value=\"Correção\">Correção</option>\
                                      <option value=\"Teste\">Teste</option>\
                                      <option value=\"Análise\">Análise</option>\
                                      <option value=\"Impedimento\">Impedimento</option>\
                                    </select>\
                                  </td>\
                                  <td style=\"width:4%\">\
                                    <a href=\"#\" class=\"remove-tarefa\"><i class=\"fa fa-trash-o\"></i></a>\
                                  </td>\
                                </tr>");
            
            clearFields("form-estoria");
            
            $(".remove-tarefa").click(function(e) {
                $(this).parent().parent().remove();
                e.preventDefault();
            });     
        }
    });    

    function getDdlDevelopmentTeam() {
        $.ajax({
            type: "post",
            url: "projeto/scrum_team/getDdlDevelopmentTeam",
            success: function (data) {
                var response = JSON.parse(data);
                $("#usuario_tarefa").html("<option value=\"\">Selecione um Usuário</option>");
                $.each(response, function (i, obj) {
                    $("#usuario_tarefa").append("<option value=\"" + obj.id_usuarios_has_projetos + "\">" + obj.nome_usuario + "</option>");
                });
            }
        });
    }
    
    
    

    $("#btnSalvarSprint").click(function () {
        if (formIsValid("sprint-group")) {
            salvarSprint();
        }
    });

    function salvarSprint() {
        var data = Object();
        data.objetivo_sprint = $("#txt_objetivo_sprint").val();
        data.tamanho_sprint = $("#ddlTamanhoSprint").val();
        data.data_ini_sprint = $("#hidden_data_ini_sprint").val();
        data.data_fim_sprint = $("#hidden_data_fim_sprint").val();
        data.info_sprint = $("#info_sprint").val();

        $.ajax({
            type: "post",
            data: JSON.stringify(data),
            url: "projeto/sprint/salvar_sprint",
            success: function (slug) {
                clearFields("form-sprint");

                window.location = "projeto/" + slug + "/sprint/sprint-planning";
            }
        });
    }

    $("#novo-sprint").click(function () {
        $("#sprint-novo-modal").modal("show");
    });


    $("#btnFecharModalSprint").click(function () {
        $("#sprint-novo-modal").modal("hide");
        clearFields("form-sprint");
    });

    $("#txt_data_ini_sprint").daterangepicker({
        "parentEl": "#sprint-novo-modal",
        singleDatePicker: true,
        "format": "DD/MM/YYYY",
        "locale": {
            "daysOfWeek": [
                "D",
                "S",
                "T",
                "Q",
                "Q",
                "S",
                "S"
            ],
            "monthNames": [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro"
            ]
        }
    }, function (start, end, label) {
        var data_fim = moment(start).add(parseInt($("#ddlTamanhoSprint").val() * 6), 'd').format('YYYY-MM-DD');

        $("#hidden_data_ini_sprint").val(start.format('YYYY-MM-DD'));
        $("#hidden_data_fim_sprint").val(getUltimaDataUtil(data_fim));
    });

    $("#ddlTamanhoSprint").on("change", function () {
        var data_fim = moment($("#hidden_data_ini_sprint").val()).add(parseInt($("#ddlTamanhoSprint").val() * 6), 'd').format('YYYY-MM-DD');

        $("#hidden_data_fim_sprint").val(getUltimaDataUtil(data_fim));
    });

    function getUltimaDataUtil(data_fim) {
        var dia_semana = moment(data_fim).day();

        if ((dia_semana === 0) || (dia_semana === 6)) {
            return getUltimaDataUtil(moment(data_fim).subtract(1, "d").format('YYYY-MM-DD'));
        }
        else {
            return data_fim;
        }
    }

    function getQtdDiasUteis(data_ini, data_fim) {
        var dia_semana = "";
        var qtdDias = 1;
        while (data_ini !== data_fim) {
            dia_semana = moment(data_ini).day();

            if ((dia_semana !== 0) && (dia_semana !== 6)) {
                qtdDias++;
            }
            data_ini = moment(data_ini).add(1, "d").format('YYYY-MM-DD');
        }
        return qtdDias;
    }
});