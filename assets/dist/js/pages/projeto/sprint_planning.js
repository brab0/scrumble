$(function () {

    "use strict";

    getDadosSprint();
    getDdlDevelopmentTeam();
    
    var tarefas = new Object();
        tarefas.remove = [];
        tarefas.insert = [];
        tarefas.update = [];   

    function getEstoriasSprint(id_sprint) {
        $.ajax({
            type: "post",
            data: "id_sprint=" + id_sprint,
            url: "projeto/sprint/getEstoriasSprint",
            success: function (data) {            	
                var response = JSON.parse(data);
                $("#box-sprint-backlog .box-body table tbody").html("");
                $.each(response, function (i, obj) {
                    $("#box-sprint-backlog .box-body table tbody").append("<tr>\
                                                                            <td style=\"display:none\" class=\"id_sprints_has_estorias\">" + obj.id_sprints_has_estorias + "</td>\
                                                                            <td style=\"width:85%\" class=\"descricao_estoria\">" + obj.descricao_estoria + "</td>\
                                                                            <td style=\"width:7%;vertical-align: middle;\" class=\"text-center\">" + obj.pontos_estoria + "</td>\
                                                                            <td style=\"width:7%; vertical-align:middle\" class=\"tools text-right\">\
                                                                              <a href=\"#\" class=\"edit_estoria hidden\"><i class=\"fa fa-edit\"></i></a>\
                                                                              <a href=\"#\" class=\"remove_estoria hidden\" style=\"color:red; display:inline-block; margin-left:3px; margin-top: -1px;vertical-align: top;\"><i class=\"fa fa-trash-o\"></i></a>\
                                                                            </td>\
                                                                          </tr>");
                });
            },
            complete: function(){
                $("#box-sprint-backlog .box-body table tbody tr").on("mouseover", function () {
                    $(this).children(".tools").children("a").removeClass("hidden");
                });
                
                $("#box-sprint-backlog .box-body table tbody tr").on("mouseout", function () {
                    $(this).children(".tools").children("a").addClass("hidden");
                });
                
                $("#box-sprint-backlog .box-body table tbody tr td .edit_estoria").on("click", function (e) {
                    $("span[for=\"chkContinuarEstoria\"").addClass("hidden");
                    editEstoria($(this).parent().parent().children(".id_sprints_has_estorias").text());
                    
                    $("#estorias-planning-modal").modal("show");
                    
                    e.preventDefault();
                });
            }
        });
    }    

    $("#planejar-estoria").click(function () {
        $("#form-estoria").attr("data-status", "new");
        $("#form-estoria").attr("data-id-estoria", "");
        $("#estoria_planning_descricao").text("");
        getUltimaEstoria();
        $("#estorias-planning-modal").modal("show");
    });


    function getUltimaEstoria() {        
        $.ajax({
            type: "post",
            url: "projeto/sprint/getUltimaEstoria",
            success: function (data) {
                if (data != "null") {
                    var response = JSON.parse(data);
                    var info = "";

                    if (response.info_estoria !== null) {
                        info = "<p>" + response.info_estoria + "</p>";
                    }
                    $("#estoria_planning_descricao").attr("data-id", response.id_estoria).html("<b>Estória #" + response.id_estoria + "</b> - " + response.descricao_estoria + info);
                    $("#box-tarefas tbody").html("");
                }
                else {
                    alert("Não existem mais estórias no Product Backlog");
                    $("#estorias-planning-modal").modal("hide");
                }
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
                getEstoriasSprint(id_sprint)
                getUltimaEstoria();
                $("#box-tarefas tbody").html("");

                if (!$("#chkContinuarEstoria").is(":checked")) {
                    $("#estorias-planning-modal").modal('hide');
                }
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
    
    $("#iniciar-sprint").click(function () {
        $.ajax({
            type: "post",
            data: "id_sprint=" + $("#box-sprint").attr("data-id"),
            url: "projeto/sprint/iniciar_sprint",
            success: function (slug_projeto) {
                window.location = "projeto/" + slug_projeto + "/sprint";
            }
        });
    });
    
    function getDadosSprint() {
        $.ajax({
            type: "post",
            url: "projeto/sprint/getDadosSprint",
            success: function (data) {
                var response = JSON.parse(data);

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

                getEstoriasSprint(response.geral.id_sprint);
            }
        });
    }
});
