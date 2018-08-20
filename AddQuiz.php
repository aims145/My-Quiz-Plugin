<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function myquiz_addquiz(){
    global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix .MYTABLE;

	$sql = "CREATE TABLE IF NOT EXISTS $table_name (
             `quiz_id` int(10) NOT NULL AUTO_INCREMENT,
             `quiz_name` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
             `quiz_description` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
             `quiz_addedquestions` int(10) NOT NULL,
             PRIMARY KEY (`quiz_id`),
             UNIQUE KEY `quiz_name` (`quiz_name`)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );

    if($_POST["submitaddquiz"]){
    
        //var_dump($_POST);
       $quizname = $_POST["quizname"];
       $quizdescription = $_POST["quizdescription"];
       
       $insertstatus = $wpdb->insert($table_name, 
        array( 
            'quiz_name' => $quizname,
            'quiz_description' => $quizdescription
        ));
       
    }
    

    ?>
<div class="wrap">
    <h2>Add New Quiz</h2>
    <hr>
    <form method="post" action="" name="addquiz">
    <div class="form-group row">
    <label for="quizname" class="col-sm-3 col-form-label">Quiz Name</label>
    <div class="col-sm-9">
        <input name="quizname" type="text" class="form-control" id="quizname" placeholder="Enter your Question">
    </div>
    </div>
        
    <div class="form-group row">
    <label for="quizdescription" class="col-sm-3 col-form-label">Description</label>
    <div class="col-sm-9">
        <textarea name="quizdescription" class="form-control" id="quizdescription" placeholder="Quiz Description"></textarea>
    </div>
    </div>    
    <div class="form-group row">
        <div class="col-sm-3"></div>
    <div class="col-sm-9">
        <input type="submit" name="submitaddquiz" class="button button-primary" value="Submit">
    </div>
    </div>
        <div class="row">    
            <div class="col-sm-3"></div>
            <div class="col-sm-9">
        <?php
        if(isset($_POST["submitaddquiz"])){
            if($insertstatus == true){?>
                      <p class='alert alert-success'>Quiz Created Successfully</p>
            <?php          
            }
            else{
                ?>
                 <p class='alert alert-danger'><?php echo $wpdb->last_error;?></p>
                 <?php
            }
            
            
        }
        
        ?>
            </div>    
        </div>
    </form>    
    
</div>
<?php
}
