<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mainmenusub = isset($_GET["sub"])?$_GET["sub"]:"1";
?>

<ul class="nav nav-pills nav-justified">
    <li role="presentation" class="<?php echo $mainmenusub == "1"?"active ":"";?>"><a href="?opt=<?php echo $mainmenuopt;?>&sub=<?php echo $mainmenusub;?>">Mis datos</a></li>
</ul>

<?php switch($mainmenusub){
    case "1":{
            include 'miperfil/misdatos.php';
        break;}
    
}?>