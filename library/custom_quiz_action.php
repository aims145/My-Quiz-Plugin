<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$getParam = isset($_REQUEST['quizid'])?$_REQUEST['quizid']:'';
 if(!empty($getParam) and ( $_REQUEST['action'] == "edit_quiz" )){
     $table_name = $wpdb->prefix.MYTABLE;
     $query = "select * from $table_name where quiz_id='".$getParam."'";
     $status = $wpdb->get_results($query);

     if($status == true){
         echo json_encode($status);
         die();
     }
     else{
         echo $wpdb->last_error;
         die();
     }
    
   
}