<link rel="stylesheet" href="<?php echo MYQUIZ_URL.'assets/css/bootstrap.min.css'; ?>" />
<script type='text/javascript' src="<?php echo MYQUIZ_URL.'assets/js/jquery-3.3.1.min.js'; ?>"></script>
<script type='text/javascript' src="<?php echo MYQUIZ_URL.'assets/js/bootstrap.min.js'; ?>"></script>
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
    //echo count($_POST["allids"]);
    $bothids = $_POST["allids"];
    $countallid = count($bothids);
    $allids = array();
    for( $i=0; $i<$countallid; $i++ ){
        $singleid = explode("=", $bothids[$i]);
        array_push($allids, $singleid[0]);
        $wpdb->query("update $table_quiz set quiz_addedquestions = quiz_addedquestions - 1 where quiz_id='".$singleid[1]."'");
    }
    $allids = implode(",", $allids);
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
    $bothid = explode("=", $_POST["deletequestion"]);
    
    $questionid = $bothid[0]; 
    $quiz_id = $bothid[1];
    $wpdb->query("update $table_quiz set quiz_addedquestions = 	quiz_addedquestions - 1 where quiz_id='".$quiz_id."'");
    $sql = "delete from $table_ques where question_id='".$questionid."'";
    if($wpdb->query($sql)){
        $alert = "Questions Deleted Successfully";
        $state = "success";
    }else{
        $alert = "Error: ".$wpdb->last_error;
        $state = "danger";
    }
}

/**
* Description - Edit Question code 
*
*
*
*/
if(isset($_POST["editonequestion"]) and !empty($_POST["editonequestion"])){

    include_once MYQUIZ_DIR.'/includes/editquestion.php';

}else{

$sql = "select * from $table_ques left join $table_quiz on ( $table_ques.quiz_id = $table_quiz.quiz_id )";
$table_data = $wpdb->get_results($sql);


?>



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
        <table class="table table-striped table-bordered">
            <thead class="">
                <tr>
                    <th><input class="form-control question-id" id="selectallquestion" type="checkbox"  ></th>
                    <th>Question ID</th>
                    <th>Question</th>
                    <th>Associated Quiz Name</th>
                    <th>Date</th>
                    <th style="width: 135px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach ( $table_data as $row ){
                echo "<tr>";
                echo "<td><input class='form-control question-id' type='checkbox' name='allids[]' value='".$row->question_id."=".$row->quiz_id."' ></td>";
                echo "<td>".$row->question_id."</td>";
                echo "<td style='width: 375px;'>".substr($row->question, 0, 100)."</td>";
                echo "<td>".$row->quiz_name."</td>";
                echo "<td>".$row->timestamp."</td>";
                echo "<td>";
                echo "<button class='button action' type='submit' value='".$row->question_id."=".$row->quiz_id."' name='editonequestion' >Edit</a> "
                         ."<button class='button action' type='submit' value='".$row->question_id."=".$row->quiz_id."' name='deletequestion' >Delete</a>";
                echo "</td>";
                echo "</tr>";
                }
                ?>
            </tbody>
            <tfoot class="">
                <tr>
                    <th><input class="form-control question-id" id="selectallquestion" type="checkbox"  ></th>
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

<?php     
}
?>