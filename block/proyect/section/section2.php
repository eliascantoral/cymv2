<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
switch($option){
    case "2":{///Modo de impresión?>
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <td><strong>No.</strong></td>
                            <td><strong>Nombre</strong></td>
                            <td align="center">
                                <strong>¿Qué tipo es?</strong>
                                <table class="table table-condensed">
                                    <tr align="center"><td width="33%">Continuo</td>
                                        <td width="33%">Atributo - Unidades defectuosas</td>
                                        <td width="33%">Atributo - Defectos por unidad</td></tr>
                                </table>
                            </td>
                            <td align="center">
                                <strong>¿Qué mide el indicador?</strong>
                                <table class="table">
                                    <tr align="center"><td width="50%">Efectividad</td>
                                        <td width="50%">Eficiencia</td></tr>
                                </table>
                            </td>
                            <td align="center"><strong>Se usa en el proyecto</strong></td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($indi=0;$indi<sizeof($content);$indi++){?>
                        <tr>
                            <td><?php echo $indi+1;?></td>
                            <td><?php out($content[$indi][1])?></td>            
                            <td>
                                <table class="table table-condensed">
                                    <tr align="center">
                                       <td width="33%"><?php if($content[$indi][2]){?><img src="<?php echo get_variable("home");?>/image/check.png"><?php }?></td>
                                       <td width="33%"><?php if($content[$indi][3]){?><img src="<?php echo get_variable("home");?>/image/check.png"><?php }?></td>
                                       <td width="33%"><?php if($content[$indi][4]){?><img src="<?php echo get_variable("home");?>/image/check.png"><?php }?></td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <table class="table table-condensed">
                                    <tr align="center">
                                       <td width="50%"><?php if($content[$indi][5]){?><img src="<?php echo get_variable("home");?>/image/check.png"><?php }?></td>
                                       <td width="50%"><?php if($content[$indi][6]){?><img src="<?php echo get_variable("home");?>/image/check.png"><?php }?></td>
                                    </tr>
                                </table>            
                            </td>
                            <td align="center">
                                <?php if($content[$indi][7]){?><img src="<?php echo get_variable("home");?>/image/check.png"><?php }?>
                            </td>
                        </tr>
                        <?php }?>
                    </tbody>
                </table>
            </div>
       <?php break;}
}
?>