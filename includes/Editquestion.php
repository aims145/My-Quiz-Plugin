<?php

$bothid = $_POST["editonequestion"];
$ids = explode("=", $bothid);
$questionid = $ids[0];
$quiz_id = $ids[1];

$sql = "select * from $table_ques where question_id='$questionid'";
$quesdata = $wpdb->get_results($sql);

$sql = "select quiz_id from $table_quiz";
$quiz_data = $wpdb->get_results($sql);
//var_dump($quesdata);
$choice = $quesdata[0]->multichoice;
$multichoiceyes = "";
$multichoiceno = "";
$numberofoptions = $quesdata[0]->numberofoptions;
$answerallowed = $quesdata[0]->answerallowed;
$correctanswer = explode(",", $quesdata[0]->correctanswer);

if( $choice == 0 ){
    $multichoiceno = "checked";
    $type = "radio";
}else{
    $multichoiceyes = "checked";
    $type = "checkbox";
}
$option = json_decode($quesdata[0]->options);
?>
<div class="wrap">
<h1 class="wp-heading-inline">Edit Question</h1>
<hr class="wp-header-end">
<div class="myquizform">
    <form method="post" action="" name="editquestion">
        
<div class="form-group row" id="listallquiz">
    <div class="col-sm-2">Select Quiz ID</div>
    <div class="col-sm-6">
        <select class="selectpicker" name="quizid" id="quizid" >
            <?php
            foreach( $quiz_data as $row ){
                echo "<option value=".$row->quiz_id.">".$row->quiz_id."</option>";
            }
            ?>
        </select>
</div>
    <div class="col-sm-3"></div>
</div>         

        
<div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Question :</label>
    <div class="col-sm-9">
<!--        <textarea name="question" class="form-control" id="question" placeholder="Enter your Question"></textarea>-->
        <?php    
                $editor_id = 'question';
                //$uploaded_csv = get_post_meta( $post->ID, 'custom_editor_box', true);
                $settings = array(
                    'editor_height' => 150, // In pixels, takes precedence and has no default value
                    'textarea_rows' => 10,  // Has no visible effect if editor_height is set, default is 20
                    'media_buttons' => false
                );
                
                $boxcontent = $quesdata[0]->question;
                wp_editor( $boxcontent, $editor_id, $settings );    
            ?>
    </div>
</div>    

<div class="form-group row">
    <label  class="col-sm-2 ">Is Multiple Choice ?</label>
    <div class="col-sm-1">
        <label class="radio-inline" for="radiobuttonforyes">
            <input class="" type="radio" name="multichoice" id="radiobuttonforyes" value="yes" onclick="multichoiceyes();" <?php echo $multichoiceyes; ?> >YES
        </label>
    </div>
    <div class="col-sm-2">
        <label class="radio-inline" for="radiobuttonforno">
            <input class="" type="radio" name="multichoice" id="radiobuttonforno" value="no" onclick="multichoiceno();" <?php echo $multichoiceno; ?> >NO
        </label>
    </div>
</div>       

<div class="form-group row" id="allowedmultichoiceoneditquestion">
    <div class="col-sm-2">Allowed Selectable Options</div>
    <div class="col-sm-6">
        <select class="selectpicker" name="numbersofanswer" id="numbersofanswer" >
            <option value="1" <?php if($answerallowed == '1'){echo "selected";}?> >1</option>
            <option value="2" <?php if($answerallowed == '2'){echo "selected";}?> >2</option>
            <option value="3" <?php if($answerallowed == '3'){echo "selected";}?> >3</option>
            <option value="4" <?php if($answerallowed == '4'){echo "selected";}?> >4</option>
        </select>
</div>
    <div class="col-sm-3"></div>
</div>    
    
<div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-3">Options</div>
    <div class="col-sm-3"></div>
    <div class="col-sm-3">Select Correct Option</div>
</div>
<div class="alloptions" id="alloptions">
<?php 

for($i=0;$i<$numberofoptions;$i++){
    echo "<div class='form-group row'>";
    echo "<div class='col-sm-2'>Option ".($i+1)."</div>";
    echo "<div class='col-sm-6'><input class='form-control' type='text' name='option".($i+1)."' value='".$option[$i]."' placeholder='Option ".($i+1)."'></div>";
    echo "<div class='col-sm-3'>
            <label class='radiolabel'>";
        if(in_array(($i+1), $correctanswer)){
        echo "<input class='form-control options' type='".$type."' name='correntanswer[]' value='1' id='option".($i+1)."' onclick='checkmultichoice(this);' checked>";
        }
        else{
        echo "<input class='form-control options' type='".$type."' name='correntanswer[]' value='1' id='option".($i+1)."' onclick='checkmultichoice(this);'>";    
        }
        
    
    echo    "<span class='checkmark'></span>
            </label>
         </div>";
    echo "</div>";
}
?>
</div>
    
<div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-2"><a  class="button button-primary " style="color: white;" onclick="addmoreoption();">Add More Options</a></div>
  
</div>
    
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-6">
        <h2 class="wp-heading-inline">Add Answer Description</h2>    
         <?php    
                $editor_id = 'answer_description';
                //$uploaded_csv = get_post_meta( $post->ID, 'custom_editor_box', true);
                $settings = array(
                    'editor_height' => 200, // In pixels, takes precedence and has no default value
                    'textarea_rows' => 10,  // Has no visible effect if editor_height is set, default is 20
                );
                $boxcontent = $quesdata[0]->answerdescription;
                wp_editor( $boxcontent, $editor_id, $settings );    
            ?>

    </div>

</div>    
    <div class="row">
        <div class="col-sm-2"><input type="hidden" name="optionscount" id="optionscount" value="<?php echo $numberofoptions;?>">
            <input type="hidden" name="question_id" value="<?php echo $questionid;?>"  
        </div>
        <div class="col-sm-2 mt-4">
            <input class="button button-primary" type="submit" name="editquestionform" value="Update Question">
        </div>
    </div>
</form>    
</div>
</div>

