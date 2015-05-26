<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function get_mainmenu(){
    if(is_login()){
            include_once("backend/backend.php");
            $backend = new backend();      
            return $backend->get_mainmenu($_SESSION["cym_rol"]);
    }
    return array();
}

?>