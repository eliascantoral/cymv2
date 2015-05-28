<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'header.php';
$option = isset($_GET["opt"])?$_GET["opt"]:"1";
?>
<?php if(is_login()){?>
<?php 
    if(!isset($_GET["group"]) || !isset($_GET["id"])) {?><div class="alert alert-danger" role="alert">Acceso no valido.</div><?php }else{
        $group = $_GET["group"];
        $proyectid = $_GET["id"];
        $rol = get_grouprol($_GET["group"]);
        ?>
            <ul class="nav nav-pills">
              <?php switch($rol){
                  case "0":{
                        $option = isset($_GET["opt"])?$_GET["opt"]:"0";
                        ?><li role="presentation" <?php if($option=="0"){?>class="active"<?php }?>><a href="?group=<?php echo $group?>&id=<?php echo $proyectid?>&opt=0">Revision</a></li><?php 
                      break;}
                  case "1":{
                      ?><li role="presentation" <?php if($option=="1"){?>class="active"<?php }?>><a href="?group=<?php echo $group?>&id=<?php echo $proyectid?>&opt=1">Mi proyecto</a></li><?php 
                      break;}
              }?>
                        <li role="presentation" <?php if($option=="2"){?>class="active"<?php }?>><a href="?group=<?php echo $group?>&id=<?php echo $proyectid?>&opt=2">Impresión</a></li>
            </ul>     
        <?php         
        switch ($option){
            case "0":{
                    include_once 'block/proyect/revision.php';
                break;}
        }
    }

    }else{
    
} ?>

<?php include_once 'footer.php';?>