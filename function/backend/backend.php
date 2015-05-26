<?php 
	include_once("general.php");
	
	class backend{
			private function start_connect(){
						$con=mysqli_connect(DB_HOST2,DB_USER2,DB_PASSWORD2,DB_NAME2);
						// Check connection
						if (mysqli_connect_errno())
						  {
						  echo "Failed to connect to MySQL: " . mysqli_connect_error();
						  }
						return $con;				
				}

			private function close_connect($con){
						mysqli_close($con);					
				}
			private function encripter($key){
				return md5($key);
				//return $key;
			}
                        private function set_log($user, $action, $desc, $info = ""){
                            $con = $this->start_connect();
                            $time = time();
                            $retorno = FALSE;
                            $query = "INSERT INTO `log_activity` "
                                        . "(`id`, `time`, `user`, `action`, `desc`, `info`) "
                                   . "VALUES (NULL, '".$time."', '".$user."', '".$action."', '".$desc."', '".$info."');";
                            $result = mysqli_query($con, $query);
                            if($result){
                                $retorno = TRUE;
                            }
                            $this->close_connect($con);
                            return $retorno;
                        }
                        private function check_duplicity($table, $field, $value){
                            $existe = false;
                            $con = $this->start_connect();
                            $query = "SELECT count(*) AS total FROM `".$table."` WHERE `".$field."` = '".$value."';";
                            $result = mysqli_query($con, $query);
                            if($result){
                                $row = mysqli_fetch_array($result);
                                if($row['total']>0){$existe = $row['total'];}
                            }
                            $this->close_connect($con);
                            return $existe;
                        }
                        private function makequery($query){
                            $status = false;
                            $return = "No se pudo realizar la conexión al server de base de datos.";                            
                            $link = $this->start_connect();
                            if($link){
                                $result = mysqli_query($link, $query);
                                if($result){
                                    $status = true;
                                    $return = $result;                                    
                                }else{
                                    $return = "No se pudor realizar la consulta.";
                                }
                                $this->close_connect($link);
                            }                            
                            return array($status, $return);
                        }                        
 /********************************************************************************************************/                       
			public function test(){
					$con = $this->start_connect();
					if($con){
						$this->close_connect($con);
						return true;
					}else{
						return false;
					}
				}
                               
                        public function login($user, $pass){
                            $con = $this->start_connect();
                            $retorno = false;
                            $query = "SELECT * FROM `user` WHERE `username`='".$user."' AND `password`='".$this->encripter($pass)."';";
                           
                            $result = mysqli_query($con, $query);
                            if($result){
                                 
                                while($row = mysqli_fetch_array($result)){
                                    
                                    $retorno[0]= $row['id'];
                                    $retorno[1]= $row['fname'];
                                    $retorno[2]= $row['lname'];
                                    $retorno[3]= $row['mail'];
                                    $retorno[4]= $row['rol'];
                                    $retorno[5]= $row['carnet'];
                                   
                                    $this->set_log($retorno[0], 1, "El usuario ingreso al sistema");
                                }
                            }
                            $this->close_connect($con);
                            return $retorno;
                        }
                        function change_userdata($id, $name, $mail, $carnet){                            
                            $con = $this->start_connect();
                            $return = 0;
                            $change = false;
                            $error = 0;
                            $query = "UPDATE `user` SET ";
                            if(!$name===false){
                                $namepart = explode(" ", $name);
                                $the_name = "";
                                $the_last = "";
                               
                                for($i = 0; $i<sizeof($namepart);$i++){
                                    $the_name.=" " . $the_last;
                                    $the_last = $namepart[$i];                                                                      
                                }
                                $query .= "`fname`= '".trim($the_name)."', `lname`= '".trim($the_last)."'";
                                $change = true;
                            }
                            if(!$mail === false){
                                if(!$this->check_duplicity("user","mail",trim($mail))){
                                    $query.=$name===false?"":", ";
                                    $query.= "`mail`='".trim($mail)."' ";
                                    $change = true;                                    
                                }else{
                                    $error = 2;
                                }
                            }
                            if(!$carnet === false){
                                $query.=($name===false && $mail === false)?"":", ";
                                $query.= "`carnet`='".trim($carnet)."' ";
                                $change = true;
                            }          
                            $query.=" WHERE `id`='".$id."';";
                            if($change && $error === 0){
                                $result = mysqli_query($con, $query);
                                if($result){
                                    $return = 1;                                    
                                }
                            }else{
                                $return = 2;
                            }
                            $this->close_connect($con);
                            return $return;
                        }
                        function set_proyectenroll($user, $proyect, $group, $rol){
                            $con = $this->start_connect();
                            $retorno = array(false, "No se pudo realizar el cambio");
                            $existe = "0";
                            $time = time();
                            $query = "SELECT * FROM `enrol_proyect` WHERE `id_user` = ".$user." AND `id_proyect` = '".$proyect."';";
                            $result1 = mysqli_query($con, $query);
                            if($result1){
                                while($row = mysqli_fetch_array($result1)){
                                    $existe = $row['type'];
                                }
                            }
                            if($existe == "0"){
                                $query = "INSERT INTO `enrol_proyect` (
                                                `id` ,
                                                `id_user` ,
                                                `id_proyect` ,
                                                `group` ,
                                                `type` ,
                                                `enrol_time`
                                          ) VALUES (
                                                NULL ,  '".$user."',  '".$proyect."',  '".$group."',  '".$rol."',  '".$time."'
                                          );";
                                $result = mysqli_query($con, $query);
                                if($result){
                                    $retorno = array(true, "Cambio guardado correctamente.");
                                }else{
                                     $retorno = array(false, "No se pudieron realizar los cambios.");
                                }                             
                            }else{                                
                                 $retorno = array(false, "El usuario y proyecto ya se encuentran asignados.");                                
                            }

                            $this->close_connect($con);
                            return $retorno;
                            
                        }
                        function unset_userenrol($user, $proyect){
                            $con = $this->start_connect();
                            $retorno  = array(false, "No se pudo realizar el cambio");
                            $query = "UPDATE `enrol_proyect` SET  `type` =  '3', `id_user`='2' WHERE  `id_user` ='".$user."' AND `id_proyect`='".$proyect."' AND `type`='1';";
                            
                            $result = mysqli_query($con, $query);
                            if($result){
                                 $retorno = array(true, "El cambio se realizo correctamente.");
                            }
                            $this->close_connect($con);
                            return $retorno;
                        }
                        function get_proyecttotalassing($proyect, $type = "1"){
                            $con = $this->start_connect();
                            $total = 0;
                            $query = "SELECT COUNT(*) as total FROM `enrol_proyect` WHERE `id_proyect`='".$proyect."' AND `type`='".$type."';";
                            $result = mysqli_query($con, $query);
                            if($result){
                                while($row = mysqli_fetch_array($result)){
                                    $total = $row['total'];
                                }
                            }
                            $this->close_connect($con);
                            return $total;
                        }
/***************************************************************************************************************/
                        function get_usergroup($userid){
                            $con = $this->start_connect();
                            $query = "SELECT `group`.`id` AS id,
                                                `group`.`name` AS name, 
                                                `group`.`description` AS descr, 
                                                `user_group`.`rol` AS rol 
                                        FROM `user_group`,`group` WHERE `user`='".$userid."' AND `group`.`id`=`user_group`.`group`;";
                            $return = false;

                            $result = mysqli_query($con, $query);
                            if($result){
                                $index = 0;
                                while($row = mysqli_fetch_array($result)){
                                    $return[$index][0] = $row['id'];
                                    $return[$index][1] = $row['name'];
                                    $return[$index][2] = $row['descr'];
                                    $return[$index][3] = $row['rol'];
                                    $index++;
                                }
                            }
                            $this->close_connect($con);
                            return $return;
                        }
                        function get_roluserproyect($userid, $group){
                            $con = $this->start_connect();
                            $rol = false;
                            $query = "SELECT `rol` FROM `user_group` WHERE `user`='".$userid."' AND `group`='".$group."'";                            
                            $result = mysqli_query($con, $query);
                            if($result){
                                while($row = mysqli_fetch_array($result)){
                                    $rol = $row["rol"];
                                }
                            }
                            
                            $this->close_connect($con);
                            return $rol;
                        }
                        function get_groupuser($group, $rol = 1){
                            $con = $this->start_connect();                            
                            $return = array();
                            
                            $query = "SELECT `user`.`id` as userid, `user`.`username` as username, CONCAT(`user`.`fname`, ' ', `user`.`lname`) AS nameuser
                                        FROM `user_group` INNER JOIN `user` ON `user`.`id` = `user_group`.`user` 
                                        WHERE `user_group`.`group`='".$group."' AND `user_group`.`rol`='".$rol."';";
                            
                            $result = mysqli_query($con, $query);
                            if($result){
                                $index =0;
                                while($row = mysqli_fetch_array($result)){
                                    $return[$index][0]= $row["userid"];
                                    $return[$index][1]= $row["username"];
                                    $return[$index][2]= $row["nameuser"];
                                    $index++;
                                }
                            }
                            $this->close_connect($con);
                            return $return;        
                        }
                        
                        
                        
                        
                        function get_peereval($userid, $group, $type = 1){
                            $con = $this->start_connect();
                            $peereval = array();
                            
                            $query = "SELECT `proyect`.`id` as id,`proyect`.`name` as name,`proyect`.`status` as status
                                        FROM `enrol_proyect` INNER JOIN `proyect` ON `enrol_proyect`.`id_proyect` = `proyect`.`id` 
                                        WHERE `id_user`='".$userid."' AND `type`='".$type."' AND `enrol_proyect`.`group`='".$group."'
                                        ORDER BY `enrol_proyect`.`enrol_time` DESC";
                            //echo $query;
                            $result = mysqli_query($con, $query);
                            if($result){
                                $index = 0;
                                while($row = mysqli_fetch_array($result)){
                                    $peereval[$index][0]=$row['id'];
                                    $peereval[$index][1]=$row['name'];
                                    $peereval[$index][2]=$row['status'];
                                    $index++;                                    
                                }
                            }
                            $this->close_connect($con);
                            return $peereval;
                        }
                        function get_proyectsbygroup($group, $user = 1){                            
                            $con = $this->start_connect();
                            $proyect_list = array();
                            $query = "SELECT DISTINCT(p.`id`) as proyectid, p.`name` as name, p.`status` as status, ep.`id_user` as user 
                                    FROM `user_group` ug INNER JOIN `enrol_proyect` ep ON ug.`user`= ep.`id_user`
                                                            INNER JOIN `proyect` p ON p.`id` = ep.`id_proyect` 
                                    WHERE ug.`group`='".$group."' 
                                            AND ug.`user`<>'".$user."' 
                                            AND ug.`rol`='1' 
                                            AND ep.`type`='0'
                                            AND p.`status`='1'";
                            //echo $query;
                            $result = mysqli_query($con, $query);
                            if($result){
                                $index = 0;
                                while($row = mysqli_fetch_array($result)){
                                    $proyectid = $row['proyectid'];
                                    $proyectname = $row['name'];
                                    $proyectstatus = $row['status'];
                                    $query2 = "SELECT u.`id` as userid, u.`username` as username FROM `enrol_proyect` ep INNER JOIN `user` u ON ep.`id_user`= u.`id`  WHERE ep.`id_proyect` = '".$proyectid."' AND ep.`type` = '0' "; 
                                    $result2 = mysqli_query($con, $query2);
                                    if($result2){
                                        while($row2 = mysqli_fetch_array($result2)){
                                            $userid = $row2["userid"];
                                            $username = $row2["username"];
                                        }
                                    }
                                    $proyect_list[$index][0] = $proyectid;
                                    $proyect_list[$index][1] = $proyectname;
                                    $proyect_list[$index][2] = $proyectstatus;
                                    $proyect_list[$index][3] = $userid;
                                    $proyect_list[$index][4] = $username;
                                    $index++;
                                }
                            }                            
                            $this->close_connect($con);
                            return $proyect_list;
                        }
                        function get_groupestructure($group){
                            $con = $this->start_connect();
                            $estructura = array();
                            $query = "SELECT `structure` FROM `group` WHERE `id`='".$group."';";
                            $result = mysqli_query($con, $query);
                            if($result){
                                while($row = mysqli_fetch_array($result)){
                                    $data_string = $row['structure'];
                                    $data_array = explode("|", $data_string);
                                    for($i=0;$i<sizeof($data_array);$i++){
                                        $data_step = explode(",", $data_array[$i]);
                                        $step = array();
                                        $section = array();
                                        for($e=0;$e<sizeof($data_step);$e++){                                            
                                            if($e==0){
                                                array_push($step,$data_step[$e]);                                                
                                            }else{
                                                array_push($section, $data_step[$e]);                                                
                                            }
                                        }
                                         array_push($step,$section);
                                         array_push($estructura, $step);
                                    }
                                }
                            }
                            $this->close_connect($con);
                            return $estructura;
                        }
                        function get_structureoptions(){
                            $con = $this->start_connect();
                            $options = array();
                            $query = "SELECT * FROM `step` ORDER BY `order` ASC";
                            $result = mysqli_query($con, $query);
                            if($result){
                                while($row = mysqli_fetch_array($result)){
                                    $stepid = $row['id'];
                                    $stepname = $row['name'];
                                    $stepdesc = $row['desc'];
                                    $query2 = "SELECT * FROM `section` WHERE `step_id`='".$stepid."' AND `id_section` IS NULL ORDER BY `order` ASC";
                                    //echo $query2."<br>";
                                    $result2 = mysqli_query($con, $query2);
                                    if($result2){
                                        $section = array();
                                        while($row2 = mysqli_fetch_array($result2)){
                                            $sectionid = $row2['id'];
                                            $sectionname = $row2['name'];
                                            array_push($section, array($sectionid,$sectionname));
                                        }                                        
                                    }
                                    array_push($options, array(array($stepid,$stepname,$stepdesc),$section));
                                }
                            }
                            $this->close_connect($con);
                            return $options;
                        }
                        function update_groupstructure($group, $structure){
                            $con = $this->start_connect();
                            $retorno = false;
                            $query = "UPDATE  `group` SET  `structure` =  '".$structure."' WHERE  `group`.`id` ='".$group."';";
                            $result = mysqli_query($con, $query);
                            if($result){
                                $retorno = true;
                            }
                            $this->close_connect($con);
                            return $retorno;
                            
                        }
/****************************************************************************************************************/                        
                        function get_proyectresume($proyectid, $group){
                               $con = $this->start_connect();
                               $return = array();
                               $groupstructure = $this->get_groupestructure($group);
                               //print_array($groupstructure);
                               $total = 0;
                               for($i=0;$i<sizeof($groupstructure);$i++){
                                   $total+=sizeof($groupstructure[$i][1]);
                                   for($e=0;$e<sizeof($groupstructure[$i][1]);$e++){
                                       echo $this->get_proyectsectioncontent($proyectid, $groupstructure[$i][1][$e]);
                                   }
                               }
                               echo $total;
                               $this->close_connect($con);
                               return $return;
                        }                                                                           
                        function get_proyectsectioncontent($proyectid, $sectionid){
                            $con = $this->start_connect();
                            $return = false;
                            $query = "SELECT `type` FROM `section` WHERE `id`='".$sectionid."';";
                            $result = $this->makequery($query);
                            if($result[0]){
                                while($row = mysqli_fetch_array($result[1])){
                                    $type = $row['type'];
                                    switch ($type){
                                    case "0":{
                                        $query2 = "SELECT * FROM `work` WHERE `proyect_id`='".$proyectid."' AND `secction_id`='".$sectionid."';";
                                        $result2 = $this->makequery($query2);
                                        if($result2[0]){
                                            while($row2 = mysqli_fetch_array($result2)){
                                                $result = array(true,array($row2['id'],$row2['work'],$row2['date_start'],$row2['date_mod'],$row2['score']));
                                            }
                                        }
                                        break;}
                                    }
                                }
                            }else{
                                $return = $result;
                            }
                            $this->close_connect($con);
                            return $return;
                            
                        }
/***************************************************************************************************************/                        
                        function get_mainmenu($rol){
                            $con = $this->start_connect();
                            $menu = array();
                            $query = "SELECT * FROM `mainmenu` WHERE `status` = '1' AND `access`>'".$rol."';";
                            $result = mysqli_query($con, $query);
                            if($result){
                                $index = 0;
                                while($row = mysqli_fetch_array($result)){
                                    $menu[$index][0] = $row['id'];
                                    $menu[$index][1] = $row['name'];
                                    $menu[$index][2] = $row['desc'];
                                    $menu[$index][3] = $row['img'];
                                    $index++;
                                }
                            }
                            $this->close_connect($con);
                            return $menu;
                        }

	}
?>