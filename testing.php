<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function myquiz_testing(){
?>

<div class="wrap">
<h1 class="wp-heading-inline">Add New Quiz</h1>
<hr class="wp-header-end">
<div class="myquizform">

<div class="form-group row">
    <label for="staticEmail" class="col-sm-2 col-form-label">Question :</label>
    <div class="col-sm-9">
        <textarea name="question" class="form-control" id="question" placeholder="Enter your Question"></textarea>
    </div>
</div>    

<div class="form-group row">
    <label  class="col-sm-2 ">Is Multiple Choice ?</label>
    <div class="col-sm-1">
        <label class="radio-inline" for="radiobuttonforyes">
            <input class="" type="radio" name="multichoice" id="radiobuttonforyes" value="yes" >YES
        </label>
    </div>
    <div class="col-sm-2">
        <label class="radio-inline" for="radiobuttonforno">
            <input class="" type="radio" name="multichoice" id="radiobuttonforno" value="no" checked>NO
        </label>
    </div>
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
            <input class="form-control" type="radio" name="options" >
            <span class="checkmark"></span>
        </label>
    </div>
</div>    
    
<div class="form-group row">
    <div class="col-sm-2">Option 2</div>
    <div class="col-sm-6"><input class="form-control" type="text" name="option2" placeholder="Option 2"></div>
    <div class="col-sm-3">
        <label class="radiolabel">
            <input class="form-control" type="radio" name="options" >
            <span class="checkmark"></span>
        </label>
    </div>
</div> 
    
<div class="form-group row">
    <div class="col-sm-2">Option 3</div>
    <div class="col-sm-6"><input class="form-control" type="text" name="option3" placeholder="Option 3"></div>
    <div class="col-sm-3">
        <label class="radiolabel">
            <input class="form-control" type="radio" name="options" >
            <span class="checkmark"></span>
        </label>
    </div>
</div> 


<div class="form-group row">
    <div class="col-sm-2">Option 4</div>
    <div class="col-sm-6"><input class="form-control" type="text" name="option4" placeholder="Option 4"></div>
    <div class="col-sm-3">
        <label class="radiolabel">
            <input class="form-control" type="radio" name="options" >
            <span class="checkmark"></span>
        </label>
    </div>
</div>
</div>
    
<div class="form-group row">
    <div class="col-sm-2"></div>
    <div class="col-sm-2"><button  class="button button-primary" onclick="addmoreoption();">Add More Options</button></div>
  
</div>
    
<div class="row">
    <div class="col-sm-2"></div>
    <div class="col-sm-6">
        <h1 class="wp-heading-inline">Add Answer Description</h1>    
         <?php    
                $editor_id = 'custom_editor_box';
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
        <div class="col-sm-2"></div>
        <div class="col-sm-2 mt-4">
            <button class="button button-primary" type="button" onclick="submit_form(); return false;">Submit Question</button>
        </div>
    </div>
</div>    
</div>

<?php
}