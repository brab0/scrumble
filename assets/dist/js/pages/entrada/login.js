$(function () {

  "use strict";    
  
  $("#btn-entrar").click(function(){
    if(formIsValid("login-group")){
      checkLogin();
    }
  });

  function checkLogin(){
    var data = Object();
    data.email_usuario = $("#email-usuario").val();
    data.senha_usuario = $("#senha-usuario").val();

    $.ajax({
      type:"post",
      data: JSON.stringify(data),
      url:"login/checkCredentials",
      success: function(status){
        if(status == "success"){
          window.location = "usuario"
        }
      }
    });
  }  
});
