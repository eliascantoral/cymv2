<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$estructure = get_proyectstructure();
print_array($estructure);
?>
<ul class="nav nav-pills">
     <li role="presentation" class="active"><a href="#">Resumen</a></li>
    <?php for($i=0;$i<sizeof($estructure);$i++){?>
      <li role="presentation"><a href="#">Profile</a></li>                       
    <?php }?>
</ul>  