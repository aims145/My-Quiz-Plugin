<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $wpdb;
$url = admin_url();
$table_name = $wpdb->prefix.MYTABLE;


if($_POST["deletebulkquiz"] and !empty($_POST["selecteddeletequiz"])){
    $allids = implode(",", $_POST["allids"]);
    $sql = "DELETE from $table_name WHERE quiz_id IN ($allids)";
    if($wpdb->query($sql)){
        $alert = "All Selected Quiz Deleted Successfully";
        $state = "success";
    }else{
        $alert = "Error: ".$wpdb->last_error;
        $state = "danger";
    }
}

if($_POST["submiteditquiz"] and !empty($_POST["quizname"])){
    $quizid = $_POST["quizid"];
    $quizname = $_POST["quizname"];
    $quizdesc = $_POST["quizdescription"];
    $sql = "update $table_name set quiz_name='".$quizname."', quiz_description='".$quizdesc."' where quiz_id='".$quizid."'";
    if($wpdb->query($sql)){
        $alert = "Quiz updated Successfully";
        $state = "success";
    }else{
        $alert = "Error: ".$wpdb->last_error;
        $state = "danger";
    }
    
}


$table_data = $wpdb->get_results("select * from $table_name");



?>
<link rel="stylesheet" href="<?php echo MYQUIZ_URL.'assets/css/bootstrap.min.css'; ?>" />
<script type='text/javascript' src="<?php echo MYQUIZ_URL.'assets/js/jquery-3.3.1.min.js'; ?>"></script>
<script type='text/javascript' src="<?php echo MYQUIZ_URL.'assets/js/bootstrap.min.js'; ?>"></script>


<div class="wrap">
    <h2>My Quizzes</h2>
    <h1 class="wp-heading-inline">Quiz</h1>
    <a href="<?php echo $url."admin.php?page=myquiz_addquiz"?>" class="page-title-action">Add New Quiz</a>
    <hr>
<?php
if(count($table_data) > 0){
    

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
            <select name="selecteddeletequiz" class="form-control custom-bulk-action">
                <option value="">Bulk Action</option>
                <option value="delete">Delete</option>
            </select>
        </div>
        <div class="col-sm-2">
            <input class="form-control btn btn-secondary " type="submit" name="deletebulkquiz" value="Apply" >
        </div>
        
    </div>
    <div class="table-responsive mt-4">
        <table class="table table-striped table-bordered">
            <thead >  
                <tr>
                    <th><input class="form-control quiz-id"  type="checkbox" id="selectallquiz"  ></th>
                    <th>Quiz ID</th>
                    <th>Quiz Name</th>
                    <th>Quiz Short Code</th>
                    <th>Number of Questions</th>
                    <th>Date</th>
                    <th style="width: 135px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                foreach( $table_data as $row ){
                    echo "<tr id='".$row->quiz_id."'>";
                    echo "<td><input class='form-control quiz-id' type='checkbox' name='allids[]' value='".$row->quiz_id."' ></td>";
                    echo "<td>".$row->quiz_id."</td>";
                    echo "<td>".$row->quiz_name."</td>";
                    echo "<td>".$row->quiz_shortcode."</td>";
                    echo "<td>".$row->quiz_addedquestions."</td>";
                    echo "<td>".$row->Date."</td>";
                    echo "<td>";
                    echo "<a class='button action' data-id='".$row->quiz_id."'  id='editonequiz' >Edit</a> "
                         ."<a class='button action' data-id='".$row->quiz_id."' id='deleteonerow' >Delete</a>";
                    echo "</tr>";
                }
                
                ?>
            </tbody>
            <tfoot >
                <tr>
                    <th><input class="form-control quiz-id" type="checkbox" id="selectallquiz"></th>
                    <th>Quiz ID</th>
                    <th>Quiz Name</th>
                    <th>Quiz Short Code</th>
                    <th>Number of Questions</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </tfoot>
        </table>
        <p id="quizalert" ></p>
    </div>
</form>
<!-- The Modal -->
<div class="modal" id="editquiz">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Quiz</h4>
        <button type="button" class="close" id="closeedit" >&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form method="post" action="" name="editquiz">
    
        
        
        
            <div class="form-group row">
            <label for="quizname" class="col-sm-3 col-form-label">Quiz Name</label>
            <div class="col-sm-9">
                <input name="quizname" type="text" class="form-control" id="quizname" placeholder="Enter your Question">
                <input name="quizid" type="hidden" id="hiddenquizid">
            </div>
            </div>

            <div class="form-group row">
            <label for="quizdescription" class="col-sm-3 col-form-label">Description</label>
            <div class="col-sm-9 editedesc">
                <?php    
                        $editor_id = 'quizdescription';
                        //$uploaded_csv = get_post_meta( $post->ID, 'custom_editor_box', true);
                        $settings = array(
                            'editor_height' => 200, // In pixels, takes precedence and has no default value
                            'textarea_rows' => 10,  // Has no visible effect if editor_height is set, default is 20
                            'teeny' => TRUE
                        );
                        $boxcontent = '';
                        wp_editor( $boxcontent, $editor_id, $settings );
                        remove_action('media_buttons', 'media_buttons');
                    ?>
            </div>
            </div>    
            <div class="form-group row">
                <div class="col-sm-3"></div>
            <div class="col-sm-9">
                <input type="submit" name="submiteditquiz" class="button button-primary" value="Submit">
            </div>
            </div>
            </form>
      </div>
    </div>
  </div>
</div>
<?php 
}
else{
    echo "<p class='notice notice-error'>No Quiz to be displayed .....!</p>";
     
}
?>
</div>
