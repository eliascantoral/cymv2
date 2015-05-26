<!DOCTYPE html>
<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

include_once 'header.php';?>
<?php 
    if(!isset($_GET["group"])) {?><div class="alert alert-danger" role="alert">Acceso no valido.</div><?php }else{
        $group = $_GET["group"];
        $rol = get_grouprol($_GET["group"]);
?>
    <div class="alert alert-success message" id="message_ok" role="alert"></div>
    <div class="alert alert-danger message" id="message_error" role="alert"></div>
    <input type="text" id="ajax_answer">

    <div class="panel panel-primary">
        <div class="panel-heading">
            <a href="#" id="expandgroupconfpanel" class="txt_white">Configuración del grupo</a>
        </div> 
        <div id="groupconfpanel" class="panel-body message">
            <?php
                $structure = get_proyectstructure($group);
                $options = get_proyectstructure();
                //print_array($options);
            ?>


                    <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                        <?php for($i=0;$i<sizeof($options);$i++){?>
                                <?php $stepactive = array_contain($structure, $options[$i][0][0],0); ?>
                                <div id="panel_<?php echo $options[$i][0][0];?>" class="panel <?php echo $stepactive===false?"panel-default":"panel-success";?>">
                                    <div class="panel-heading" role="tab" id="heading_<?php echo $i;?>">
                                        <h4 class="panel-title">
                                            <a data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $i;?>" aria-expanded="true" aria-controls="collapse_<?php echo $i;?>">
                                                <?php echo $options[$i][0][1];?>
                                            </a>
                                            <p class="navbar-text navbar-right"><label> <input type="checkbox" class="ckb_step" val="<?php echo $options[$i][0][0];?>" <?php echo $stepactive===false?'':'checked="true"';?>> Activar &nbsp;&nbsp;&nbsp;</label></p> 
                                        </h4>
                                        <br>
                                    </div>
                                    <div id="collapse_<?php echo $i;?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading_<?php echo $i;?>">
                                        <div class="panel-body">
                                            <div class="list-group"> 
                                              <?php for($e=0;$e<sizeof($options[$i][1]);$e++){?>
                                                    <a href="#" class="list-group-item"><?php echo $options[$i][1][$e][1];?></a>                                                   
                                              <?php }?>                                          
                                            </div>                                        
                                        </div>
                                    </div>
                                </div>                         
                        <?php }?>                                   
                    </div>        

            <div class="alert alert-warning" role="alert">Al activar o desactivar cada uno de los pasos, no borrara ninguna información; solamente modificara su visualización.</div>
        </div>
    </div>    
<?php        
        switch($rol){
            case "0": include_once 'block/teacher/users.php'; break;
            case "1":break;
        }
    }
?>



<?php include_once 'footer.php';?>