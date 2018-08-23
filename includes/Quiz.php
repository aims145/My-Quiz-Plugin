<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $wpdb;
$url = admin_url();
$table_name = $wpdb->prefix.MYTABLE;
$table_data = $wpdb->get_results("select * from $table_name");

if($_POST["action"]){
    $action = $_POST["action"];
    $quizid = $_POST["quizid"];
    print_r($quizid);
    die();
    if($action == 'delete'){
        $sql = "delete from $table_name where quiz_id='".$quizid."'";
        require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
        dbDelta( $sql );
    }
}

?>
<link rel="stylesheet" href="<?php echo MYQUIZ_URL.'assets/css/bootstrap.min.css'; ?>" />
<script type='text/javascript' src="<?php echo MYQUIZ_URL.'assets/js/jquery-3.3.1.min.js'; ?>"></script>
<script type='text/javascript' src="<?php echo MYQUIZ_URL.'assets/js/bootstrap.min.js'; ?>"></script>

<div class="wrap">
    <h2>My Quizzes</h2>
    <h1 class="wp-heading-inline">Quiz</h1>
    <a href="<?php echo $url."admin.php?page=myquiz_addquiz"?>" class="page-title-action">Add New Quiz</a>
    <hr>
    
    <div class="row">
        <div class="col-sm-2">
            <select name="deletequiz" class="form-control custom-bulk-action">
                <option value="">Bulk Action</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-sm-2">
            <input class="form-control btn btn-secondary " type="button" name="deletebutton" value="Apply" >
        </div>
        
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th><input class="form-control quiz-id" type="checkbox"  ></th>
                    <th>Quiz ID</th>
                    <th>Quiz Name</th>
                    <th>Number of Questions</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach( $table_data as $row ){
                    echo "<tr id='".$row->quiz_id."'>";
                    echo "<td><input class='form-control quiz-id' type='checkbox' name='allids[]' value='".$row->quiz_id."' ></td>";
                    echo "<td>".$row->quiz_id."</td>";
                    echo "<td>".$row->quiz_name."</td>";
                    echo "<td>".$row->quiz_addedquestions."</td>";
                    echo "<td>".$row->Date."</td>";
                    echo "<td>";
                    echo "<button class='btn btn-primary btn-sm' data-id='".$row->quiz_id."' id='editonerow' >Edit</button> "
                         ."<button class='btn btn-danger btn-sm' data-id='".$row->quiz_id."' id='deleteonerow' >Delete</button>";
                    echo "</tr>";
                }
                
                ?>
            </tbody>
            <tfoot class="thead-dark">
                <tr>
                    <th><input class="form-control quiz-id" type="checkbox"   ></th>
                    <th>Quiz ID</th>
                    <th>Quiz Name</th>
                    <th>Number of Questions</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
        <p id="quizalert" ></p>
    </div>
</div>



