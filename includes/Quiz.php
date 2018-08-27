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
                    echo "<button class='btn btn-primary btn-sm' data-id='".$row->quiz_id."' data-toggle='modal' data-target='#editquiz' id='editonerow' >Edit</button> "
                         ."<button class='btn btn-danger btn-sm' data-id='".$row->quiz_id."' id='deleteonerow' >Delete</button>";
                    echo "</tr>";
                }
                
                ?>
            </tbody>
            <tfoot class="thead-dark">
                <tr>
                    <th><input class="form-control quiz-id" type="checkbox"></th>
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
<!-- The Modal -->
<div class="modal" id="editquiz">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Quiz</h4>
        <button type="button" class="close" id="closeedit" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
          <form method="post" action="" name="editquiz">
    
        
        
        
            <div class="form-group row">
            <label for="quizname" class="col-sm-3 col-form-label">Quiz Name</label>
            <div class="col-sm-9">
                <input name="quizname" type="text" class="form-control" id="quizname" placeholder="Enter your Question">
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

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" id="closeedit" data-dismiss="modal" >Close</button>
      </div>

    </div>
  </div>
</div>   
</div>



