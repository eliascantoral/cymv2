<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


switch($option){
    case "2":{///Modo de impresión
            for($indi = 0; $indi<sizeof($content);$indi++){?>
                <div class="panel panel-success">
                    <div class="panel-heading">
                        <strong>Indicador No. <?php echo $indi+1;?></strong>
                    </div>    
                    <div class="panel-body">
                        <div class="well-sm">
                            <h4>Nombre</h4>
                            <p><?php out($content[$indi][1]);?></p>
                        </div>        
                        <div class="well-sm">
                            <h4>Descripción</h4>
                            <p><?php out($content[$indi][2]);?></p>
                        </div>
                        <div class="well-sm">
                            <h4>Justificación</h4>
                            <p><?php out($content[$indi][3]);?></p>
                        </div>
                        <div class="well-sm">
                            <h4>Método y criterio para obtener el indicador</h4>
                            <p><?php out($content[$indi][4]);?></p>
                        </div>
                        <div class="well-sm">
                            <h4>Forma en que se mostrará a terceros</h4>
                            <p><?php out($content[$indi][5]);?></p>
                        </div>        
                    </div>
                </div>
            <?php }
        break;}
}
?>