<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$getParam = isset($_REQUEST['quizid'])?$_REQUEST['quizid']:'';
 if($_REQUEST['action'] == "delete_quiz" ){
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
elseif ($_REQUEST['action'] == "edit_quiz") {
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