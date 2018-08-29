<?php

$bothid = $_POST["editonequestion"];
$ids = explode("=", $bothid);
$questionid = $ids[0];
$quiz_id = $ids[1];

$sql = "select * from $table_ques where question_id='$questionid'";
$quesdata = $wpdb->get_results($sql);

$sql = "select quiz_id from $table_quiz";
$quiz_data = $wpdb->get_results($sql);
echo "<pre>";
var_dump($quesdata);
$choice = $quesdata[0]->multichoice;
$multichoiceyes = "";
$multichoiceno = "";        
echo "</pre>";
if( $choice == 0 ){
    $multichoiceno = "checked";
}else{
    $multichoiceyes = "checked";
}
?>
<div class="wrap">
<h1 class="wp-heading-inline">Edit Question</h1>
<hr class="wp-header-end">
<div class="myquizform">
    <form method="post" action="" name="addquestion">
        
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

<div class="form-group row" id="allowedmultichoice">
    <div class="col-sm-2">Allowed Selectable Options</div>
    <div class="col-sm-6">
        <select class="selectpicker" name="numbersofanswer" id="numbersofanswer" >
            <option value="1" selected>1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
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
<div class="form-group row">
    <div class="col-sm-2">Option 1</div>
    <div class="col-sm-6"><input class="form-control" type="text" name="option1" placeholder="Option 1"></div>
    <div class="col-sm-3">
        <label class="radiolabel">
            <input class="form-control options" type="radio" name="correntanswer[]" value="1" id="option1" onclick="checkmultichoice(this);" >
            <span class="checkmark"></span>
        </label>
    </div>
</div>    
    
<div class="form-group row">
    <div class="col-sm-2">Option 2</div>
    <div class="col-sm-6"><input class="form-control" type="text" name="option2" placeholder="Option 2"></div>
    <div class="col-sm-3">
        <label class="radiolabel">
            <input class="form-control options" type="radio" name="correntanswer[]" value="2" onclick="checkmultichoice(this);">
            <span class="checkmark"></span>
        </label>
    </div>
</div> 
    
<div class="form-group row">
    <div class="col-sm-2">Option 3</div>
    <div class="col-sm-6"><input class="form-control" type="text" name="option3" placeholder="Option 3"></div>
    <div class="col-sm-3">
        <label class="radiolabel">
            <input class="form-control options" type="radio" name="correntanswer[]" value="3" onclick="checkmultichoice(this);">
            <span class="checkmark"></span>
        </label>
    </div>
</div> 


<div class="form-group row">
    <div class="col-sm-2">Option 4</div>
    <div class="col-sm-6"><input class="form-control" type="text" name="option4" placeholder="Option 4"></div>
    <div class="col-sm-3">
        <label class="radiolabel">
            <input class="form-control options" type="radio" name="correntanswer[]" value="4" onclick="checkmultichoice(this);">
            <span class="checkmark"></span>
        </label>
    </div>
</div>
</div>
    
<div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-2"><a  class="button button-primary " style="color: white;" onclick="addmoreoption();">Add More Options</a></div>
  
</div>
    
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-6">
        <h1 class="wp-heading-inline">Add Answer Description</h1>    
         <?php    
                $editor_id = 'answer_description';
                //$uploaded_csv = get_post_meta( $post->ID, 'custom_editor_box', true);
                $settings = array(
                    'editor_height' => 200, // In pixels, takes precedence and has no default value
                    'textarea_rows' => 10,  // Has no visible effect if editor_height is set, default is 20
                );
                $boxcontent = '';
                wp_editor( $boxcontent, $editor_id, $settings );    
            ?>

    </div>

</div>    
    <div class="row">
        <div class="col-sm-2"><input type="hidden" name="optionscount" id="optionscount"></div>
        <div class="col-sm-2 mt-4">
            <input class="button button-primary" type="submit" name="questionform" value="Submit Question">
        </div>
    </div>
</form>    
</div>
</div>

