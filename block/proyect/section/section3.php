<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//print_array($content);
switch($option){
    case "0":
    case "2":{///Modo de impresión
            if($content[0]){
                for($phea = 0; $phea<sizeof($content);$phea++){?>
                    <div class="panel panel-success">
                        <div class="panel-heading">
                            <strong>Ciclo PHEA No. <?php echo $phea+1;?></strong>
                        </div>    
                        <div class="panel-body">
                            <div class="well-sm">
                                <h4>Causa</h4>
                                <p><?php out($content[$phea][1]);?></p>
                            </div>        
                            <div class="well-sm">
                                <h4>Solución propuesta</h4>
                                <p><?php out($content[$phea][2]);?></p>
                            </div>
                            <div class="well-sm">
                                <h4>Justificación</h4>
                                <p><?php out($content[$phea][3]);?></p>
                            </div>
                            <div class="well-sm">
                                <h4>Resultados de las acciones y aprendizaje</h4>
                                <p><?php out($content[$phea][4]);?></p>
                            </div>             
                        </div>
                    </div>
                <?php }              
            }else{
                echo "Sin contenido.";
            }        
        break;}
}