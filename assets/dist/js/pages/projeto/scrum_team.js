$(function () {

  "use strict";
  
  getScrumTeam();
  
  function getScrumTeam(){        
    $.ajax({
      type:"post",      
      url:"projeto/scrum_team/getAllScrumTeam",
      success: function(data){
        var response = JSON.parse(data);               
        $("#box-team tbody").html("");

        $.each(response, function(i, obj){
          var status = "Inativo";
          var nome = "";

          if(obj.ativo == 1){
            status = "Ativo";
          }

          if(obj.nome_usuario != null){
            nome = obj.nome_usuario;
          }

          $("#box-team tbody").append("<tr>\
                                        <td style=\"display:none\">"+obj.id_usuario+"</td>\
                                        <td style=\"width:40%\">"+nome+"</td>\
                                        <td style=\"width:30%\">"+obj.email_usuario+"</td>\
                                        <td style=\"width:15%\">"+obj.nome_papel+"</td>\
                                        <td style=\"width:15%\">"+status+"</td>\
                                      </tr>");
        });
      }
    });
  } 

  $("#add-integrante").click(function(){
    $("#integrante-novo-modal").modal("show");
  });

  $('#btnFecharModalIntegrante').click(function () {
    clearFields("form-integrante");
  });

  $("#btnAdicionarIntegrante").click(function(){
    if(formIsValid("scrum-team-group")){
      adicionarIntegrante();  
    }
  });

  function adicionarIntegrante(){
    var data = Object();
    data.email_usuario = $("#email-usuario").val();
    data.id_papel = $("#id-papel").val();    

    $.ajax({
      type:"post",
      data: JSON.stringify(data),
      url:"projeto/scrum_team/adicionar_integrante",
      success: function(status){        
        clearFields("form-integrante");
        getScrumTeam();

        if(!$("#chkContinuarIntegrante").is(":checked")){
          $("#integrante-novo-modal").modal('hide');
        }         
      }
    });
  } 
});                                