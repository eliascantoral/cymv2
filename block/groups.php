<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$groups = get_usergroup();
//print_array($groups);
?>
<div class="row">
    <?php   
    for($i=0;$i<sizeof($groups);$i++){
    ?> 
        
        <div class="col-xs-6 col-md-6">
            <a href="group.php?group=<?php echo $groups[$i][0]?>" class="thumbnail">
                <img src="image/<?php echo $groups[$i][3]=='1'?"book":"brick";?>.png" alt="...">
                <div class="caption">
                    <h4><?php echo $groups[$i][1];?></h4>
                    <p><?php echo $groups[$i][2];?></p>
                </div>            
            </a>
        </div>    
    <?php   
    }
    ?>    
  
</div>