<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

    function get_header(){
        include_once 'function/logic.php';
        init_vars();        
    }
    function logout(){
        $_SESSION = array();
        header('Location: ' . get_variable("home"), true, "303");
        die();
    }

?>