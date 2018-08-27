<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $wpdb;
$url = admin_url();
$table_quiz = $wpdb->prefix.MYTABLE;
$table_ques = $wpdb->prefix.MYQUESTIONS;

if($_POST["deletebulkquestion"] and !empty($_POST["deleteselectedquestions"])){
    $allids = implode(",", $_POST["allids"]);
    $sql = "DELETE from $table_ques WHERE question_id IN ($allids)";
    if($wpdb->query($sql)){
        $alert = "All Selected Questions Deleted Successfully";
        $state = "success";
    }else{
        $alert = "Error: ".$wpdb->last_error;
        $state = "danger";
    }
}

if(isset($_POST["deletequestion"])){
    $questionid = $_POST["deletequestion"];
    $sql = "delete from $table_ques where question_id='".$questionid."'";
    if($wpdb->query($sql)){
        $alert = "Questions Deleted Successfully";
        $state = "success";
    }else{
        $alert = "Error: ".$wpdb->last_error;
        $state = "danger";
    }
}



$sql = "select * from $table_ques left join $table_quiz on ( $table_ques.quiz_id = $table_quiz.quiz_id )";
$table_data = $wpdb->get_results($sql);


?>
<link rel="stylesheet" href="<?php echo MYQUIZ_URL.'assets/css/bootstrap.min.css'; ?>" />
<script type='text/javascript' src="<?php echo MYQUIZ_URL.'assets/js/jquery-3.3.1.min.js'; ?>"></script>
<script type='text/javascript' src="<?php echo MYQUIZ_URL.'assets/js/bootstrap.min.js'; ?>"></script>


<div class="wrap">
    <h2>All Qestions</h2>
    <a href="<?php echo $url."admin.php?page=myquiz_addquestion"?>" class="page-title-action">Add New Question</a>
    <hr>
    <?php 
    if(isset($alert) and $state == "success"){
        echo "<p class='alert alert-success'>$alert</p>";
    }
    elseif(isset($alert) and $state == "danger") {
            echo "<p class='alert alert-danger'>$alert</p>";
    }
    ?>
    <form action="" method="post" name="bulk-action">
    <div class="row">
        
        <div class="col-sm-2">
            <select name="deleteselectedquestions" class="form-control custom-bulk-action">
                <option value="">Bulk Action</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-sm-2">
            <input class="form-control btn btn-secondary " type="submit" name="deletebulkquestion" value="Apply" >
        </div>
        
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-hover">
            <thead class="thead-dark">
                <tr>
                    <th><input class="form-control " id="selectallquestion" type="checkbox"  ></th>
                    <th>Question ID</th>
                    <th>Question</th>
                    <th>Associated Quiz Name</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ( $table_data as $row ){
                echo "<tr>";
                echo "<td><input class='form-control question-id' type='checkbox' name='allids[]' value='".$row->question_id."' ></td>";
                echo "<td>".$row->question_id."</td>";
                echo "<td style='width: 375px;'>".substr($row->question, 0, 100)."</td>";
                echo "<td>".$row->quiz_name."</td>";
                echo "<td>".$row->timestamp."</td>";
                echo "<td>";
                echo "<button class='btn btn-primary btn-sm' data-id='".$row->question_id."' data-toggle='modal' data-target='#editques' id='editonerow' >Edit</button> "
                         ."<button class='btn btn-danger btn-sm' type='submit' value='".$row->question_id."' name='deletequestion' >Delete</button>";
                echo "</td>";
                echo "</tr>";
                }
                ?>
            </tbody>
            <tfoot class="thead-dark">
                <tr>
                    <th><input class="form-control" id="selectallquestion" type="checkbox"  ></th>
                    <th>Question ID</th>
                    <th>Question</th>
                    <th>Associated Quiz Name</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
        
        <p id="quizalert" ></p>
    </div>
   </form>
</div>



