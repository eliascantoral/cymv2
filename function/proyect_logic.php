<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function get_proyectstructure($group = '0',$data = false){
    include_once 'backend/backend.php';
    $backend = new backend();
    if($group!='0') return $backend->get_groupestructure($group, $data);
    return $backend->get_structureoptions();
    
}


function setunsetstep($group, $step){
    include_once 'backend/backend.php';
    $backend = new backend();    
    $retorno = array(FALSE,"Error no se pudo actualizar");    
    $result = false;
    $groupoptions = get_proyectstructure($group);
    $alloptions = get_proyectstructure();
    $existe = array_contain($groupoptions, $step, 0);
    if($existe){///Dar de baja al paso en el grupo
        $estructura = "";
        for($i=0;$i<sizeof($groupoptions);$i++){
            if($groupoptions[$i][0]!=$step){
                $estructura.=$estructura!=""?"|":"";
                $estructura.=$groupoptions[$i][0];
                for($e=0;$e<sizeof($groupoptions[$i][1]);$e++){
                    $estructura.=",".$groupoptions[$i][1][$e];
                }
            }
        }
        $result = $backend->update_groupstructure($group, $estructura);        
    }else{///Agregar el paso al grupo
        $newstep = "";
        $estructura = "";
        switch ($step){
            case "2":$newstep = "2,1,2,3,35,4,5,6,7";break;
            case "3":$newstep = "3,8,9,11,15,29,30";break;
            case "4":$newstep = "4,16,17,18,19";break;
            case "5":$newstep = "5,20,36";break;
            case "6":$newstep = "6,22";break;
        }
        for($i=0;$i<sizeof($alloptions);$i++){
            $existe = array_contain($groupoptions, $alloptions[$i][0][0], 0);            
            if($existe){    
                $estructura.=$estructura!=""?"|":"";
                $estructura.=$alloptions[$i][0][0];
                for($e=0;$e<sizeof($groupoptions[$existe-1][1]);$e++){
                    $estructura.=",".$groupoptions[$existe-1][1][$e];
                }               
            }else if($step == $alloptions[$i][0][0]){
               $estructura.=$estructura!=""?"|":"";
               $estructura.=$newstep; 
            }
        }
        $result = $backend->update_groupstructure($group, $estructura);
    }
    if($result) return array(true,"Grupo actualizado.");
    return $retorno;
}
function get_totalpeereval($proyect){
    include_once 'backend/backend.php';
    $backend = new backend();
    return $backend->get_proyecttotalassing($proyect);
}

function get_userproyect($user, $group, $show=10){
    include_once 'backend/backend.php';
    $backend = new backend();
    
    $retorno = array();
    $answer = $backend->get_peereval($user,$group, "0");    
    for($i=0;$i<sizeof($answer);$i++){
        if($i>=$show){return $retorno;}
        if($answer[$i][2]!='0'){
            array_push($retorno, $answer[$i]);            
        }
    }
    return $retorno;
}

function get_peereval($userid, $group){
    include_once 'backend/backend.php';
    $backend = new backend();
    return $backend->get_peereval($userid,$group);
}
function get_groupproyect($group, $user = 1){
    include_once 'backend/backend.php';
    $backend = new backend();
    return $backend->get_proyectsbygroup($group, $user);
    
}
function set_proyectenrollpeereval($user, $proyect, $group){
    include_once("backend/backend.php");
    $backend = new backend();
    return $backend->set_proyectenroll($user, $proyect, $group, "1");
}
function unset_proyectenrollpeereval($user, $proyect){
    include_once 'backend/backend.php';
    $backend = new backend();
    return $backend->unset_userenrol($user, $proyect);
}

function get_proyectinfo($proyectid, $group, $resume = true){
    include_once 'backend/backend.php';
    $backend = new backend();
    if ($resume) return $backend->get_proyectresume($proyectid, $group);
    return false;
}


function get_proyectsectioncontent($proyect, $section){
    include_once 'backend/backend.php';
    $backend = new backend();
    return $backend->get_proyectsectioncontent($proyect, $section);
}

function get_proyectindicadores($proyect){
    include_once 'backend/backend.php';
    $backend = new backend();
    return $backend->get_proyectindicadores($proyect);
}

function get_proyectindicadoresused($proyect){
    include_once 'backend/backend.php';
    $backend = new backend();
    return $backend->get_proyectindicadoresused($proyect);
}

function get_proyectphea($proyect){
    include_once 'backend/backend.php';
    $backend = new backend();
    return $backend->get_proyectphea($proyect);
}

function get_proyectdata($proyect){
    include_once 'backend/backend.php';
    $backend = new backend();
    $data = $backend->get_proyectdata($proyect);
    $industries = $data[3];
    $data[3] = array();
    $processes = $data[4];
    $data[4] = array();
    
    $industry = explode(",", $industries);
    for($i=0;$i<sizeof($industry);$i++){
        if($industry[$i]!=""){            
            array_push($data[3], $backend->get_industry($industry[$i]));            
        }
    }
    $process = explode(",", $processes);
    for($i=0;$i<sizeof($process);$i++){
        if($process[$i]!=""){
            array_push($data[4], $backend->get_process($process[$i]));
        }        
    }
    return $data;
}



/****************************************************************************************/
/************************************************REVIEW**********************************/
/****************************************************************************************/

function save_feedback($proyect, $step, $section, $coment, $rate, $referal){
    $userid = is_login();
    $return = false;
    if($userid){
        include_once 'backend/backend.php';
        $backend = new backend();

        if($section==""){
            $return = $backend->save_stepreview($proyect, $userid, $step, $coment, $referal);
        }else{  
            $return = $backend->save_sectionreview($section,$userid,$coment,$referal,$rate);
        }        
    }
    return $return;
}

function get_feedback($proyect, $step, $section){
    $userid = is_login();
    $return = false;
    if($userid){
        include_once 'backend/backend.php';
        $backend = new backend();

        if($section==""){
            $return = $backend->get_stepfeedback($proyect, $userid, $step);
        }else{
            $return = $backend->get_sectionfeedback($userid, $section);
        }        
    }
    return $return;
}