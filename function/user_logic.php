<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
    function try_login($user_, $pass){
            include_once("backend/backend.php");
            $backend = new backend();
            $user = $backend->login($user_, $pass);
            if($user === false)return false;
            session_start();
            $_SESSION["cym_userid"] =  $user[0]; 
            $_SESSION["cym_name"] =  $user[1] . " " . $user[2];
            $_SESSION["cym_mail"] =  $user[3];
            $_SESSION["cym_rol"] = $user[4];
            $_SESSION["cym_carnet"] = $user[5];
            $_SESSION["cym_user"] = $user_;
            return $user;
    }
    function get_userdata($data){
        if(isset($_SESSION["cym_".$data])){return $_SESSION["cym_".$data];}
        return "Good try.";
    }
    function change_userdata($name, $mail, $carnet){
        $name_ = ($name==$_SESSION["cym_name"])?false:$name;
        $mail_ = $mail==$_SESSION["cym_mail"]?false:$mail;
        $carnet_ = $carnet==$_SESSION["cym_carnet"]?false:$carnet;
        if($name_ || $mail_ || $carnet_){
            include_once 'backend/backend.php';
            $backend = new backend(); 
            $result = $backend->change_userdata($_SESSION["cym_userid"], $name_, $mail_, $carnet_);
            switch($result){
                case "1":{
                        $_SESSION["cym_name"] = !$name_==false?$name_:$_SESSION["cym_name"];
                        $_SESSION["cym_mail"] = !$mail_==false?$mail_:$_SESSION["cym_mail"];
                        $_SESSION["cym_carnet"] = !$carnet_==false?$carnet_:$_SESSION["cym_carnet"];
                        return array('r'=>1,'d'=>"Los cambios se realizaron correctamente."); 
                        break;}
                case "2":{
                        return array('r'=>3,'d'=>"El correo electrónico no esta disponible.");                     
                        break;}
                default : return array('r'=>0,'d'=>"Error desconocido. Por favor intente de nuevo."); 
            }
        }else{
            return array('r'=>2,'d'=>"No se realizaron modificaciónes.");
        }
     
    }
    

?>
