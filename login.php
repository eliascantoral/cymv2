<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
        <link href="style/login.css" rel="stylesheet">
        <form id="login_form" class="form-signin">
            <h2 class="form-signin-heading">Bienvenido</h2>
            <label for="inputUser" class="sr-only">Usuario</label>
            <input type="text" id="inputUser" class="form-control" placeholder="Usuario" required autofocus value="admin">
            <label for="inputPassword" class="sr-only">Contraseña</label>
            <input type="password" id="inputPassword" class="form-control" placeholder="Contraseña" required value="123456">
            <button class="btn btn-lg btn-primary btn-block" type="submit">Ingresar</button>
            <div id="login_form_message" class="message alert alert-danger" role="alert"></div>
        </form>
       
        <input type="hidden" id="form_answer" value="">
        
        <script>
            $("#login_form").submit(function(event){
               event.preventDefault();
               var user = document.getElementById("inputUser").value;
               var pass = document.getElementById("inputPassword").value;
               ajax_("0", "&user="+user+"&pass="+pass, false, "form_answer")
               var answer = document.getElementById("form_answer").value;
               json = jQuery.parseJSON( answer );
               if(json.r==1){
                    location.reload();
               }else{
                    show_message("login_form_message",json.d);
               }
            });
        </script>