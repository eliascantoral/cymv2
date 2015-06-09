<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

switch($option){
    case "2":{///Modo de impresión
            if($content[0]){
                out($content[1][1]);
            }else{
                echo "Sin contenido.";
            }        
        break;}
}