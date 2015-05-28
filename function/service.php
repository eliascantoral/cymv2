<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
 //   print_r($_POST);
    if(isset($_POST["action"])){
        switch ($_POST["action"]){
            case "0":{//Login
                if(isset($_POST["user"]) && isset($_POST["pass"])){
                    include_once('logic.php');
                    $result = try_login($_POST["user"], $_POST["pass"]);
                    if($result){
                        echo json_encode(array('r'=>1,'d'=>$result));
                    }else{
                        echo json_encode(array('r'=>0,'d'=>"Usuario o contraseña incorrectos."));
                        
                    }
                }
                break;}
            case "1":{////Change user data
                if(isset($_POST["name_"]) && isset($_POST["mail_"]) && isset($_POST["carnet_"])){
                    include_once('logic.php');
                    session_start();
                    $result = change_userdata($_POST["name_"], $_POST["mail_"], $_POST["carnet_"]);  
                    echo json_encode($result);
                }
                break;
            }                
            case "2":{////get proyect list
                if(isset($_POST["user"]) && isset($_POST["group"])){
                    include_once('logic.php');
                    $proyects = get_groupproyect($_POST["group"], $_POST["user"]);
                    for($i=0;$i<sizeof($proyects);$i++){
                    ?>
                        <li class="proyect_box group_proyect_<?php echo $proyects[$i][0];?>" val="proyect_<?php echo $proyects[$i][0];?>">
                            <a href="#" onclick="asing_user_link('<?php echo $_POST["user"];?>','<?php echo $proyects[$i][4]?>','<?php echo $proyects[$i][0];?>','<?php echo $proyects[$i][1]?>')">
                                    <?php echo $proyects[$i][1]?>(<?php echo $proyects[$i][4]?>)
                                    <span class="badge">
                                        <?php echo get_totalpeereval($proyects[$i][0]);?>
                                    </span>
                           </a>
                        </li>                  
                    <?php                        
                    }
                    ?>

                        <?php
                    break;}                                        
                }
            case "3":{/// enrol peer eval manualy
                    if(isset($_POST["user"]) && isset($_POST["proyect"]) && isset($_POST["group"])){
                        include('logic.php');
                        $retorno = set_proyectenrollpeereval($_POST["user"], $_POST["proyect"], $_POST["group"]);
                        if($retorno[0]){
                            echo json_encode(array('r'=>1,'d'=>$retorno[1]));
                        }else{
                            echo json_encode(array('r'=>0,'d'=>$retorno[1]));
                        }
                    }
                    break;                
            }
            case "4":{//// unenroll user from peer proyect 
                    if(isset($_POST["user"]) && isset($_POST["proyect"])){
                        include('logic.php');
                        $retorno = unset_proyectenrollpeereval($_POST["user"], $_POST["proyect"]);
                        if($retorno[0]){
                            echo json_encode(array('r'=>1,'d'=>$retorno[1]));
                        }else{
                            echo json_encode(array('r'=>0,'d'=>$retorno[1]));
                        }
                    }
                    break;                
            }
            case "5":{/// unset or set step group
                    if(isset($_POST["group"]) && isset($_POST["step"])){
                        include('logic.php');
                        $retorno = setunsetstep($_POST["group"], $_POST["step"]);
                        if($retorno[0]){
                            echo json_encode(array('r'=>1,'d'=>$retorno[1]));
                        }else{
                            echo json_encode(array('r'=>0,'d'=>$retorno[1]));
                        }                    
                    }
                    break;               
            }
            case "6":{///get basic proyect info
                    if(isset($_POST["proyectid"])){
                        include('logic.php');
                        $proyect_info = get_proyectinfo($_POST["proyectid"],$_POST["group"]);
                        //print_array($proyect_info);
                        ?>        
                            <div class="progress">
                              <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="min-width: 2em; width: <?php echo round($proyect_info[1]/$proyect_info[0]*100);?>%;">
                                <?php echo round($proyect_info[1]/$proyect_info[0]*100);?>%
                              </div>
                            </div>                                              
                        <?php                         
                    }
                    break;}
        }
        
    }

    
?>