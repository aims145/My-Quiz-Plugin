<?php

    /**
      * Plugin Name: My Quiz
      * Plugin URI: http://your-domain.com
      * Description: my WordPress plugin for creating quizzes 
      * Version: 1.0.0
      * Author: Amrit Sharma
      * Author URI: http://your-domain.com
      */
define('MYQUIZ_DIR', plugin_dir_path(__FILE__));
define('MYQUIZ_URL', plugin_dir_url(__FILE__));
include(MYQUIZ_DIR.'testing.php');

function theme_scripts() {
  wp_enqueue_script('jquery');
}
add_action('wp_enqueue_scripts', 'theme_scripts');
function add_css_to_head(){
    $cssurl1 = MYQUIZ_URL.'assets/css/myquiz.css';
    $cssurl2 = MYQUIZ_URL.'assets/css/bootstrap.min.css';
    print "<link rel='stylesheet' href='".$cssurl1."'>";
    print "<link rel='stylesheet' href='".$cssurl2."'>";
    
}
add_action('admin_head', 'add_css_to_head');

function add_js_to_footer(){
    $jsurl1 = MYQUIZ_URL.'assets/js/myquiz.js';
    $jsurl2 = MYQUIZ_URL.'assets/js/bootstrap.min.js';
    print "<script type='text/javascript' src='".$jsurl1."'></script>";
    print "<script type='text/javascript' src='".$jsurl2."'></script>";
}
add_action('admin_footer', 'add_js_to_footer');

/**
function myquiz_function(){
    $text = "This is my wp plugin";
    $text .= "<p>This is a new Para</p>";
    return $text;
}
add_shortcode("Example", myquiz_function);

*/

function myquiz_add_menu_option(){
    add_menu_page('My Quiz', 'My Quiz', 'manage_options', 'myquiz-admin-menu', 'myquiz_page', '', 200);
    add_submenu_page('myquiz-admin-menu', 'Add Quiz', 'Add Quiz', 'manage_options', 'myquiz_addquiz', 'myquiz_addquiz');
    add_submenu_page('myquiz-admin-menu', 'Test Quiz', 'Test Quiz', 'manage_options', 'myquiz_testing', 'myquiz_testing');
    
}

add_action('admin_menu', 'myquiz_add_menu_option');

function myquiz_page(){
    ?>
<div class="wrap">
    <h2>My Quizzes</h2>
    <h1 class="wp-heading-inline">Quiz</h1>
    <a href="add-new-quiz" class="page-title-action">Add New</a>
    <hr class="wp-header-end">
</div>
    <?php
}

function myquiz_addquiz(){
    ?>
<div class="wrap">
<h1 class="wp-heading-inline">Add New Quiz</h1>
<hr class="wp-header-end">
<div class="myquizform">
<table id="quiztable">
    <tr>
        <td><label style="vertical-align: top;">Question :</label></td>
        <td><textarea id="" name="" style="resize: none;" cols="80" rows="3" placeholder="Enter your Question"></textarea><br></td>
    </tr>
    <tr>
        <td><label>Is Multiple Choice ?</label></td>
        
        <td>
            <input id="radiobuttonforyes" type="radio" name="multichoiceyes" onclick="multichoiceyes(this);" >
            <label>Yes  </label>
            <input id="radiobuttonforno" type="radio" name="multichoiceno" value="1" checked="checked" onclick="multichoiceno(this);">
            <label>No   </label>
            <br>
            <div>
            <label id="allowedmultichoicelevel" class="allowedmultichoicelevel">Allowed Selectable Options</label>
            <select name="allowedmultichoice" class="allowedmultichoice" id="allowedmultichoice">
                <option value="1" selected>1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
            </select>
            </div>
        </td>
        <td>Select Correct Answer</td>
    </tr>
  
    <tr>
        <td class="options">Option1</td>
        <td><input id="option1" type="text" name="option1"></td>
        <td><input id="correctanswer" class="correctanswer" type="radio" name="correntansweroption1" onclick="checkmultichoice(this);" ></td>
    </tr>
    <tr>
        <td class="options">Option2</td>
        <td><input id="option2" type="text" name="option2"></td>
        <td><input id="correctanswer" class="correctanswer"  type="radio" name="correntansweroption2" onclick="checkmultichoice(this);" ></td>
    </tr>
    <tr>
        <td class="options">Option3</td>
        <td><input id="option3" type="text" name="option3"></td>
        <td><input id="correctanswer" class="correctanswer" type="radio" name="correntansweroption3" onclick="checkmultichoice(this);" ></td>
    </tr>
    <tr>
        <td class="options">Option4</td>
        <td><input id="option4" type="text" name="option4"></td>
        <td><input id="correctanswer" class="correctanswer" type="radio" name="correntansweroption4"  onclick="checkmultichoice(this);" ></td>
    </tr>
    <tr id="addoptionbutton">
        <td></td>
        <td><input class="button button-primary" type="button" value="Add More Option" onclick="addoptions(this);" ></td>
    </tr>
    <tr>
   
    </tr>
</table>
<h1 class="wp-heading-inline">Add Answer Description</h1>    
 <?php  /*  
        $editor_id = 'custom_editor_box';
        //$uploaded_csv = get_post_meta( $post->ID, 'custom_editor_box', true);
        $settings = array(
            'editor_height' => 200, // In pixels, takes precedence and has no default value
            'textarea_rows' => 10,  // Has no visible effect if editor_height is set, default is 20
        );
        $boxcontent = '';
        wp_editor( $boxcontent, $editor_id, $settings );    */
    ?>
<hr class="wp-header-end">
<button class="button button-primary" type="button" onclick="submit_form(); return false;">Submit Question</button>
</div>    
</div>
<?php
}

