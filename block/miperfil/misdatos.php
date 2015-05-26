
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->

<?php
    get_userdata("name");
?>
<div id="misdatos" class="well well-lg">
    <form id="misdatos_form" >
      <div class="form-group">
        <label for="InputName">Nombre</label>
        <input type="text" class="form-control" id="InputName" placeholder="Nombre" value="<?php echo get_userdata("name");?>" disabled required>
      </div>
      <div class="form-group">
        <label for="InputEmail">Correo</label>
        <input type="email" class="form-control" id="InputEmail" placeholder="Correo electrónico" value="<?php echo get_userdata("mail");?>" disabled required>
      </div>
      <div class="form-group">
        <label for="InputCarnet">Carnet</label>
        <input type="text" class="form-control" id="InputCarnet" placeholder="Carnet" value="<?php echo get_userdata("carnet");?>" disabled required>
      </div>
        <div class="form-group" align="center">
            <button id="submit_data" type="submit" class="element_hidden btn btn-primary">Guardar</button>
            <button id="setmod_data" type="button" class="btn btn-default">Modificar</button> 
            <div id="data_form_message" class="message alert alert-danger" role="alert"></div>
            <div id="data_form_message_ok"  class="message alert alert-success" role="alert"></div>
        </div>
    </form>
    <input type="hidden" id="form_answer" value="">
</div>

<script>
    var mod = false;
    $("#setmod_data").click(function(){
        if(!mod){
            mod = true;
            $(".form-control").prop("disabled",false);
            $(this).text('Cancelar');
            $(this).addClass('btn-danger');
            $("#submit_data").show("fast");
            $("#InputName").focus();
        }else{
            location.reload();            
        }
    });
    $("#misdatos_form").submit(function(event){     
        event.preventDefault();
        var name = $("#InputName").val();
        var mail = $("#InputEmail").val();
        var carnet = $("#InputCarnet").val();
        if($.trim(name)!="" && $.trim(mail) !="" && $.trim(carnet) !=""){
            ajax_("1","&name_="+name+"&mail_="+mail+"&carnet_="+carnet,false,"form_answer"); 
               var answer = document.getElementById("form_answer").value;
               json = jQuery.parseJSON( answer );
               if(json.r==1){
                    mod = false;
                    $(".form-control").prop("disabled",true);              
                    $("#setmod_data").text('Modificar');
                    $("#setmod_data").removeClass('btn-danger');
                    $("#submit_data").hide("fast");
                    show_message("data_form_message_ok",json.d);
               }else{
                    show_message("data_form_message",json.d);
               }            
        }else{
            show_message("data_form_message","Debe completar los datos.");
        }
                
    });
</script>