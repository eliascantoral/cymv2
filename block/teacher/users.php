<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$teachers = get_groupuser($group, 0);
$participant = get_groupuser($group);
//print_array($teachers);
//print_array($participant);
?>
<div class="panel panel-primary">

  <div class="panel-heading">
    Catedráticos
  </div>
    <div class="panel-body">
        <div class="table-responsive">
            <table class="table table-striped">
                <tr><th>#</th><th>Nombre</th><th>Usuario</th></tr> 
                <?php for($i=0;$i<sizeof($teachers);$i++){?>
                    <tr>
                        <td><?php echo $i+1;?></td>
                        <td><?php echo $teachers[$i][2]?></td>
                        <td><?php echo $teachers[$i][1]?></td>
                    </tr> 
                <?php }?>
            </table> 
        </div>
    </div>
        
    
</div>

<div class="panel panel-primary">

  <div class="panel-heading">
    Participantes
  </div>
    <div class="panel-body">                
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <tr>
                        <th class="">#</th>
                        <th class="hidden-xs hidden-sm">Nombre</th>
                        <th class="">Usuario</th>
                        <th class="">Nota final a registrar</th>
                        <th class="">
                            <div class="visible-xs-8 visible-sm-8 hidden-md hidden-lg">
                                <img src="image/notateac.png" width="40px" alt="Nota" title="Nota Catedrático">
                            </div>
                            <div class="hidden-xs hidden-sm">
                                Nota final catedrático
                            </div>
                        </th>

                        <th class="">
                            <div class="visible-xs-8 visible-sm-8 hidden-md hidden-lg">
                                <img src="image/notapart.png" width="40px" alt="Nota" title="Nota Participantes">
                            </div>
                            <div class="hidden-xs hidden-sm">
                                Nota final participantes
                            </div>
                        </th>                         

                        <th class="table-size-b">Proyecto</th>
                        <th class="table-size-a">Proyectos asignados</th>                        
                    </tr> 
                    <?php for($i=0;$i<sizeof($participant);$i++){?>
                        <tr>
                            <td><?php echo $i+1;?></td>
                            <td class="hidden-xs hidden-sm"><?php echo $participant[$i][2];?>(<?php echo $participant[$i][0];?>)</td>
                            <td><?php echo $participant[$i][1];?></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <?php 
                                    $userproyect = get_userproyect($participant[$i][0], $group, 1);
                                    //print_array($userproyect);
                                    if(sizeof($userproyect)>0){ ?>
                                            <a class="link_popover_proyectinfo" tabindex="0" role="button" data-toggle="popover" data-trigger="focus" title="<?php echo $userproyect[0][1];?>" val="<?php echo $userproyect[0][0];?>" href="#"><img src="image/<?php echo $userproyect[0][2]=="2"?"eyehide":"eye";?>.png" width="40px" alt="Info" title="Información"></a>
                                            <a href="review.php?group=<?php echo $group;?>&id=<?php echo $userproyect[0][0];?>" target=""><img src="image/review.png" width="40px" alt="Revizar" title="Revizar proyecto"></a>
                                            <a href="#" class="iluminate" val="proyect_<?php echo $userproyect[0][0];?>"><img src="image/lookfor.png" width="40px" alt="Iluminar" title="Ilumniar"><input type="hidden" id="proyect_<?php echo $userproyect[0][0];?>_status" value="0"></a>                                            
                                    <?php } ?>

                            </td>
                            <td>
                                <?php 
                                        $peereval = get_peereval($participant[$i][0], $group);
                                        //print_array($peereval);                            
                                ?>
                                <div class="btn-group btn-group-justified" role="group" aria-label="...">
                                    <?php 
                                        for($ip = 0; $ip<sizeof($peereval);$ip++){?>
                                            <!-- Single button -->
                                            <div class="btn-group">
                                                <button type="button" class="btn <?php echo $peereval[$ip][2]=="2"?"btn-warning":"btn-default";?> dropdown-toggle proyect_box group_proyect_<?php echo $peereval[$ip][0];?>" val="proyect_<?php echo $peereval[$ip][0];?>" data-toggle="dropdown" aria-expanded="false">
                                                    <?php echo resumetext($peereval[$ip][0]);?><span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu" id="" role="menu">
                                                    <li><a href="#" class="list-group-item disabled"><?php echo $peereval[$ip][1];?></a></li>
                                                    <li><a href="#"><img src="image/eye.png" width="40px" alt="Ver" title="Ver proyecto">Ver proyecto</a></li>
                                                    <li><a href="#"><img src="image/review.png" width="40px" alt="Revizar" title="Revizar proyecto">Ver revisión</a></li>
                                                    <li class="divider"></li>
                                                    <li><a href="#" onclick="unassign('<?php echo $participant[$i][0];?>','<?php echo $participant[$i][1];?>','<?php echo $peereval[$ip][0];?>','<?php echo $peereval[$ip][1];?>')"><img src="image/review.png" width="40px" alt="Revizar" title="Revizar proyecto">Eliminar asignación</a></li>
                                                </ul>
                                            </div>                        
                                    <?php } ?>
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-primary dropdown-toggle proyect_list" data-toggle="dropdown" aria-expanded="false" val="<?php echo $participant[$i][0];?>">
                                           Agregar <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu" role="menu" id="proyect_list_<?php echo $participant[$i][0];?>" >
                                            <li><a href="#" class="asing_user_link">Cargando...</a></li>                                                                                
                                        </ul>
                                    </div>                        

                                </div>
                            </td>
                        </tr> 
                    <?php }?>
                </table>
            </div>        
    </div>
        
    
</div>

<div id='asingpeer' class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Asignación de proyecto</h4>
      </div>
      <div class="modal-body">
          <p>Asingará el proyecto <strong><span id="ptoasing"></span> </strong> a <strong><span id="usertoasign"></span></strong></p>
        <input type="hidden" id="ptoasingid" value="">
        <input type="hidden" id="usertoasignid" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" id="btn_assignp">Asignar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div id='unasingpeer' class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Desasignación de proyecto</h4>
      </div>
      <div class="modal-body">
          <p>Esta acción eliminara el proyecto <strong><span id="ptounasing"></span> </strong> de la lista de calificación del usuario <strong><span id="usertounasign"></span></strong>.</p>
        <input type="hidden" id="ptounasingid" value="">
        <input type="hidden" id="usertounasignid" value="">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-danger" id="btn_unassignp">Desasignar</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script>     
    $(".link_popover_proyectinfo").click(function(event){
        event.preventDefault();
        var proyectid = $(this).attr("val");
        ajax_("6","&proyectid="+ proyectid + "&group=<?php echo $group;?>", false, "ajax_answer");
        $(this).popover({
                html : true,
                content: function() {
                         return document.getElementById("ajax_answer").value;
                       }                
            }); 
        $(this).popover('show');
    });
    $(".proyect_box").hover(
        function(){            
            var val = $(this).attr( "val" );
            $(".group_"+val).removeClass("btn-default");
            $(".group_"+val).addClass("btn-info");           
        },
        function(){
            var val = $(this).attr( "val" );
            $(".group_"+val).removeClass("btn-info");
            $(".group_"+val).addClass("btn-default");            
        });
    $(".iluminate").click(function(){
            
            var val = $(this).attr( "val" );
            var status = $("#"+val+"_status").val();
            if(status==0){
                $(".group_"+val).removeClass("btn-default");
                $(".group_"+val).addClass("btn-info");
                $("#"+val+"_status").val("1")
            }else{
                $(".group_"+val).removeClass("btn-info");
                $(".group_"+val).addClass("btn-default");                 
                $("#"+val+"_status").val("0")
            }
       
    });
    $(".proyect_list").click(function(){
        var id = $(this).attr( "val" );
        ajax_async("2", "&user="+id+"&group=<?php echo $group;?>", false, "proyect_list_"+id)
    });
    function asing_user_link(user, username, proyect, proyectname){               
        $("#ptoasing").text(proyectname);
        $("#ptoasingid").val(proyect);
        $("#usertoasign").text(username);
        $("#usertoasignid").val(user);
        $('#asingpeer').modal();
    }
    $("#btn_assignp").click(function(){
        $('#asingpeer').modal('hide');
        var proyect = $("#ptoasingid").val();
        var user = $("#usertoasignid").val();
        if(proyect !="" && user !=""){
            ajax_("3","&user="+user+"&proyect="+proyect+"&group=<?php echo $group;?>", false, "ajax_answer");
            var answer = document.getElementById("ajax_answer").value;
            json = jQuery.parseJSON( answer );
            if(json.r==1){
                show_message("message_ok",json.d);
                setTimeout(function(){location.reload();},1000)                
            }else{
                 show_message("message_error",json.d);
            }            
        }
    });
    function unassign(user, username, proyect, proyectname){
        $("#ptounasing").text(proyectname);
        $("#ptounasingid").val(proyect);
        $("#usertounasign").text(username);
        $("#usertounasignid").val(user);    
        $('#unasingpeer').modal();
       
    }
    $("#btn_unassignp").click(function(){
        $('#unasingpeer').modal('hide');
        var proyect = $("#ptounasingid").val();
        var user = $("#usertounasignid").val();        
        ajax_("4","&user="+user+"&proyect="+proyect+"&group=<?php echo $_GET["group"]?>", false, "ajax_answer");
        var answer = document.getElementById("ajax_answer").value;
        json = jQuery.parseJSON( answer );
        if(json.r==1){
            show_message("message_ok",json.d);
            setTimeout(function(){location.reload();},1000)                
        }else{
             show_message("message_error",json.d);
        }          
    });
    $(".ckb_step").click(function(){
        var val = $(this).attr( "val" );        
        ajax_("5","&step="+val+"&group=<?php echo $_GET["group"]?>", false, "ajax_answer");
        var answer = document.getElementById("ajax_answer").value;
        json = jQuery.parseJSON( answer );
        if(json.r==1){
            show_message("message_ok",json.d);
            if($(this).is(':checked')){
                $("#panel_"+val).removeClass("panel-default");
                $("#panel_"+val).addClass("panel-success");
            }else{                
                $("#panel_"+val).removeClass("panel-success");
                $("#panel_"+val).addClass("panel-default");                
            }
        }else{
             show_message("message_error",json.d);
            if($(this).is(':checked')){
                 $("#panel_"+val).attr('checked', false);
            }else{
                $("#panel_"+val).attr('checked', true);
            }
        }        
    });
    $("#expandgroupconfpanel").click(function(){
        if($("#groupconfpanel").is(":visible")){
            $("#groupconfpanel").hide("fast");
        }else{
            $("#groupconfpanel").show("fast");
        }
        
    });
</script>