<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$estructure = get_proyectstructure($group, true);
$proyectdata = get_proyectdata($proyectid);
?>
<br>
<div class="well">
    <h3>
        <?php //out($proyectdata[1]);?>
        <?php echo $proyectdata[1];?>
    </h3>
    <div style="margin-left: 40px">
        <?php //out($proyectdata[2]);?>
        <?php echo $proyectdata[2];?>
    
    <h4>Industria</h4>
        <ul class="list-group">
          <?php for($i=0;$i<sizeof($proyectdata[3]);$i++){?>
               <li class="list-group-item"><?php echo $proyectdata[3][$i][1];?></li>          
          <?php }?>          
        </ul>    
    <h4>Proceso</h4>
        <ul class="list-group">
          <?php for($i=0;$i<sizeof($proyectdata[4]);$i++){?>
               <li class="list-group-item"><?php echo $proyectdata[4][$i][1];?></li>          
          <?php }?>          
        </ul> 
    </div>
</div>
<?php for($i=0;$i<sizeof($estructure);$i++){?>
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <?php out("<strong>".$estructure[$i][0][1]."</strong> ".$estructure[$i][0][2]);?>
                </h3>
            </div>
            <div class="panel-body">
                <?php for($e=0;$e<sizeof($estructure[$i][1]);$e++){?>
                <div class="well well-sm">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <strong><?php out($estructure[$i][1][$e][1]);?></strong>
                        </div>
                        <div class="panel-body section-content">
                            <?php
                               // echo $estructure[$i][1][$e][2];
                                switch($estructure[$i][1][$e][2]){
                                    case "0":{
                                            $content = get_proyectsectioncontent($proyectid, $estructure[$i][1][$e][0]);
                                            include 'section/section0.php';
                                        break;}
                                    case "1":{///Sección repetitiva de indicadores
                                        $content = get_proyectindicadoresused($proyectid);
                                        include 'section/section1.php';
                                        break;}
                                    case "2":{///Sección de indicadores
                                        $content = get_proyectindicadores($proyectid);
                                        include 'section/section2.php';
                                        break;}
                                    case "3":{///Sección de indicadores
                                        $content = get_proyectphea($proyectid);
                                        include 'section/section3.php';
                                        break;}                                    
                                }
                            ?>
                        </div>
                    </div>
                </div>    
                <?php }?>
            </div>
        </div>
        <br>
    </div>
<?php }?>