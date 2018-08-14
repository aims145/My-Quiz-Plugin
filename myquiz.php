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

function add_css_to_head(){
    $cssurl = MYQUIZ_URL.'assets/css/myquiz.css';
    print "<link rel='stylesheet' href='".$cssurl."'>";
}
add_action('admin_head', 'add_css_to_head');

function add_js_to_footer(){
    $jsurl = MYQUIZ_URL.'assets/js/myquiz.js';
    print "<script type='text/javascript' src='".$jsurl."'></script>";
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
<table border="1" id="quiztable">
    <tr>
        <td><label style="vertical-align: top;">Question :</label></td>
        <td><textarea id="" name="" style="resize: none;" cols="80" rows="3" placeholder="Enter your Question"></textarea><br></td>
    </tr>
    <tr>
        <td><label>Is Multiple Choice ?</label></td>
        
        <td>
            <input id="radiobuttonforyes" type="radio" name="multichoiceyes" value="yes" onclick="multichoiceyes();" >
            <label>Yes  </label>
            <input id="radiobuttonforno" type="radio" name="multichoiceno" value="no" checked="checked" onclick="multichoiceno();">
            <label>No   </label>
        </td>
    </tr>
    
    <tr class="enablemultichoice" id="enablemultichoice">
        <td></td>
        <td>
        </td>
    </tr>
    
    
    <tr>
        <td>Option1</td>
        <td><input id="option1" type="text" name="option1"></td>
    </tr>
    <tr>
        <td>Option2</td>
        <td><input id="option2" type="text" name="option2"></td>
    </tr>
    <tr>
        <td></td>
        <td><input id="option2" class="button button-primary" type="button" value="Add More Option" ></td>
    </tr>
</table>
</div>    
</div>
<?php
}

