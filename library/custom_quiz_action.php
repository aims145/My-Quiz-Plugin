<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$getParam = isset($_REQUEST['quizid'])?$_REQUEST['quizid']:'';
 if(!empty($getParam)){
     $table_name = $wpdb->prefix.MYTABLE;
     $deletequery = "delete from $table_name where quiz_id='".$getParam."'";
     $deletestatus = $wpdb->query($deletequery);

     if($deletestatus == true){
         echo "Deleted";
         die();
     }
     else{
         echo $wpdb->last_error;
         die();
     }
    
   
}