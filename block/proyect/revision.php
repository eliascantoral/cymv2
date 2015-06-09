<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$estructure = get_proyectstructure($group, true);
$proyectdata = get_proyectdata($proyectid);
$step = isset($_GET['step'])?$_GET['step']:"0";
?> 
<input type="text" id="ajax-answer" value="">
<ul class="nav nav-tabs nav-justified">
    <li role="presentation" <?php echo $step=='0'?'class="active"':"";?>><a href="?group=<?php echo $group;?>&id=<?php echo $proyectid;?>&opt=<?php echo $option;?>&step=0">Resumen</a></li>
    <?php for($i=0;$i<sizeof($estructure);$i++){?>
    <li role="presentation" <?php echo $step==$i+1?'class="active"':"";?>><a href="?group=<?php echo $group;?>&id=<?php echo $proyectid;?>&opt=<?php echo $option;?>&step=<?php echo $i+1;?>"><?php out($estructure[$i][0][1]);?></a></li>                       
    <?php }?>
</ul>  

<?php
    switch($step){
        case "0":{
                include 'review/review0.php';
            ?>
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
            <?php
            break;}
        default:{echo "*.*";}
    }
?>

<script type="text/javascript">
    $(function() {
        $('.rating').barrating({
            wrapperClass: 'br-wrapper-f',
            showSelectedRating: false
        });
    });               
    $(".form_review").submit(function(event){
        var step = $(this);
        event.preventDefault();        
        var comment = step.children(".group-comment").children(".col-sm-10").children(".comment").val();
        var thestep = step.children(".form-group").children(".step_id").val();
        var thesection = step.children(".form-group").children(".section_id").val();
        var refered = step.children(".group-refered").children(".col-sm-10").children(".refered").is(':checked');
        var rating = $("#rating_"+thestep+"_"+thesection).val();
        ajax_("7","&proyect=<?php echo $proyectid?>&step="+thestep+"&section="+thesection+"&comment="+comment+"&referal="+refered+"&rating="+rating,false,"ajax-answer");
        //alert(comment + thestep + thesection + rating +refered);
    });
</script>