$(function () {

    "use strict";
    getEstoriasProjeto();
    $(".product-backlog-list").sortable({
        placeholder: "sort-highlight",
        handle: ".handle",
        forcePlaceholderSize: true,
        zIndex: 9999999,
        update: function (event, ui) {
            salvarPosicaoLista();
        }
    });
    function salvarPosicaoLista() {
        var backlog = [];
        $(".product-backlog-list li").each(function (i) {
            var estoria = new Object();
            estoria.prioridade_estoria = $(this).index();
            estoria.id_estoria = $(this).attr("data-id");
            backlog[i] = estoria;
        });
        $.ajax({
            type: "post",
            data: JSON.stringify(backlog),
            url: "projeto/product_backlog/salvar_prioridade_estoria"
        });
    }

    $('#add-estoria').click(function () {
        $("#modal-estorias").modal('show');
    });

    $("#modal-estorias").on('hidden.bs.modal', function(){        
        $("#btnEditEstoria").addClass("hidden");
        $("#btnSalvarEstoria").removeClass("hidden");
        $("label[for='chkContinuar']").removeClass("hidden");
        $("#posicao_estoria").parent().removeClass("hidden");
        
        clearFields("form-estoria");
    });    
    
    $("#btnSalvarEstoria").click(function () {
        if (formIsValid("product-backlog-group")) {
            salvarEstoria();
        }
    });
    
    function salvarEstoria() {
        var data = Object();
        data.descricao_estoria = $("#descricao_estoria").val();
        data.posicao_estoria = $("#posicao_estoria").val();
        data.info_estoria = $("#info_estoria").val();
        
        $.ajax({
            type: "post",
            data: JSON.stringify(data),
            url: "projeto/product_backlog/salvar_estoria",
            success: function (status) {
                clearFields("form-estoria");
                getEstoriasProjeto();
                if (!$("#chkContinuar").is(":checked")) {
                    $("#modal-estorias").modal('hide');
                }
            }
        });
    }
    
    function editEstoria() {
        var data = Object();
        data.id_estoria = $("#id-estoria").val();
        data.descricao_estoria = $("#descricao_estoria").val();
        data.info_estoria = $("#info_estoria").val();
        
        $.ajax({
            type: "post",
            data: JSON.stringify(data),
            url: "projeto/product_backlog/edit_estoria",
            success: function (status) {
                clearFields("form-estoria");
                getEstoriasProjeto();
                $("#modal-estorias").modal('hide');
            }
        });
    }
    
    function removeEstoria(id_estoria) {        
        $.ajax({
            type: "post",
            data: "id_estoria="+id_estoria,
            url: "projeto/product_backlog/remove_estoria"
        });
    }

    var area = new Morris.Area({
        element: 'revenue-chart',
        resize: true,
        parseTime: false,
        data: [
            {y: '24/09', item1: 15075},
            {y: '03/10', item1: 14870},
            {y: '10/10', item1: 13200},
            {y: '17/10', item1: 12100},
            {y: '24/10', item1: 14380},
            {y: '01/11', item1: 13450},
            {y: '07/11', item1: 12890},
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
        labels: ['Quantidades de Estórias'],
        lineColors: ['#a0d0e0'],
        hideHover: 'auto'
    });
    function getEstoriasProjeto() {
        $.ajax({
            type: "post",
            url: "projeto/product_backlog/getEstoriasProjeto",
            success: function (data) {
                var response = JSON.parse(data);
                $("#box-estorias .box-body .product-backlog-list").html("");
                $.each(response, function (i, obj) {
                    var info = "";
                    if(obj.info_estoria!==null){
                        info = obj.info_estoria;
                    }
                    $("#box-estorias .box-body .product-backlog-list").append("<li data-id=\"" + obj.id_estoria + "\">\
                                                                                <div class=\"col-md-11 main-content-estoria\">\
                                                                                    <span class=\"handle ui-sortable-handle\">\
                                                                                        <i class=\"fa fa-ellipsis-v\"></i>\
                                                                                        <i class=\"fa fa-ellipsis-v\"></i>\
                                                                                    </span>\
                                                                                    <span class=\"text descricao_estoria\">" + obj.descricao_estoria + "</span>\
                                                                                    <p class=\"text info_estoria\"style=\"padding-left: 22px;margin-bottom: 0;font-style: italic;\">" + info + "</p>\
                                                                                </div>\
                                                                                <div class=\"tools col-md-1 text-right hidden\">\
                                                                                  <a href=\"#\" class=\"edit_estoria\"><i class=\"fa fa-edit\"></i></a>\
                                                                                  <a href=\"#\" class=\"remove_estoria\" style=\"color:red\"><i class=\"fa fa-trash-o\"></i></a>\
                                                                                </div>\
                                                                                <br clear=\"both\" />\
                                                                              </li>");
                });
            },
            complete: function () {
                $("#box-estorias .box-body .product-backlog-list li").on("mouseover", function () {
                    $(this).children(".tools").removeClass("hidden");
                });
                
                $("#box-estorias .box-body .product-backlog-list li").on("mouseout", function () {
                    $(this).children(".tools").addClass("hidden");
                });
                
                $("#box-estorias .box-body .product-backlog-list li .edit_estoria").on("click", function (e) {
                    $("#modal-estorias #id-estoria").val($(this).parent().parent().attr("data-id"));
                    $("#descricao_estoria").val($(this).parent().parent().children(".main-content-estoria").children(".descricao_estoria").text());
                    $("#info_estoria").val($(this).parent().parent().children(".main-content-estoria").children(".info_estoria").text());
                    
                    $("#posicao_estoria").parent().addClass("hidden");
                    $("#btnEditEstoria").removeClass("hidden");
                    $("#btnSalvarEstoria").addClass("hidden");                    
                    $("label[for='chkContinuar']").addClass("hidden");
                    $("#modal-estorias").modal('show');
                    
                    e.preventDefault();
                });
                
                $("#box-estorias .box-body .product-backlog-list li .remove_estoria").on("click", function (e) {
                    removeEstoria($(this).parent().parent().attr("data-id"));
                    $(this).parent().parent().remove();
                    
                    e.preventDefault();
                });
            }
        });
    }
    
    $("#btnEditEstoria").click(function(){
        editEstoria();
    });    
});