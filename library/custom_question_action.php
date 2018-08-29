<?php
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$getParam = isset($_REQUEST['questionid'])?$_REQUEST['questionid']:'';
if($_REQUEST['action'] == "edit_question" ){
    $questionid = $_REQUEST['questionid'];
    $table_name = $wpdb->prefix.MYQUESTIONS;
    $selectquery = "select * from $table_name where question_id='".$questionid."'";
    $status = $wpdb->get_results($selectquery);
    if($status){
        echo json_encode($status);
        die();
    }
    else{
        echo $wpdb->last_error;
        die();
    }
}

