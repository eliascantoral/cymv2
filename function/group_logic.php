<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function get_usergroup(){
    $userid = $_SESSION["cym_userid"];
    include_once("backend/backend.php");
    $backend = new backend();      
    return $backend->get_usergroup($userid);        
}
function get_grouprol($group){
    $userid = $_SESSION["cym_userid"];
    include_once 'backend/backend.php';
    $backend = new backend();
    return $backend->get_roluserproyect($userid, $group);    
}

function get_groupuser($group, $rol= 1){
    $userid = $_SESSION["cym_userid"];
    include_once 'backend/backend.php';
    $backend = new backend();
    return $backend->get_groupuser($group,$rol);    
}