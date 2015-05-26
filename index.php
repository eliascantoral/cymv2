<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php include_once 'header.php';?>

        <?php
            if(!is_login()){
                include 'login.php';
            }else{
                include 'home.php';
            }
        ?>
<?php include_once 'footer.php';;?>
