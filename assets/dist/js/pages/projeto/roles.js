function sendMsg(status){
    if(status == "success"){
      alert("Inserido com sucesso!!!")
    }
    else{
      alert("oops...algo está errado!!!")  
    }
  }

$().ready(function(){          
  $("#btnSalvarPapel").click(function(){
    if(formIsValid("role-group")){
      salvarPapel();  
    }
    else{
      sendMsg("");
    }      
  });

  function salvarPapel(){
    var data = Object();
        data.name_role = $("#name_role").val();

    $.ajax({
      type:"post",
      data: JSON.stringify(data),
      url:"index.php/papeis/salvar_papel",
      success: function(status){
        sendMsg(status);
        clearFields();
      }
    });
  }
});