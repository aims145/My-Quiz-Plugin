<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $wpdb;
$table_name = $wpdb->prefix .MYTABLE;
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
<link rel="stylesheet" href="<?php echo MYQUIZ_URL.'assets/css/bootstrap.min.css'; ?>" />
<script type='text/javascript' src="<?php echo MYQUIZ_URL.'assets/js/bootstrap.min.js'; ?>"></script>
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

