<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include_once 'function.php'; get_header();
    if(isset($_GET["logout"])){
        logout();
    }
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>UFM - Control y Mejora de Procesos</title>            
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">       

        <link rel="stylesheet" href="style/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="style/ihover.css">
        <link rel="stylesheet" href="style/bootstrap/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="style.css">

        <script src="js/jquery.min.js"></script>
        <script src="js/jquery-ui/jquery-ui.js"></script>
        <script src="style/bootstrap/js/bootstrap.min.js"></script>

    </head>
    <body>
        <div class="container-fluid">
            <?php if(is_login()){?>
                <nav class="navbar navbar-default navbar-fixed-top">
                 <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="<?php echo get_variable("home");?>">
                          <img alt="Brand" src="image/banner.png" height="100%">
                      </a>
                    </div>                     
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">            
                        <p class="navbar-text navbar-right">Bienvenido <a href="#" class="navbar-link"><?php echo get_userdata("name");?></a>&nbsp;&nbsp;<a href="?logout=ok" class="navbar-link">Salir</a></p>
                    </div>
                </div>
                </nav>                  
            <?php }?>
         
    