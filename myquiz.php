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
define('MYTABLE', "my_quiz");
include(MYQUIZ_DIR.'testing.php');
include(MYQUIZ_DIR.'Quiz.php');
include(MYQUIZ_DIR.'AddQuiz.php');

function add_css_to_head(){
    $cssurl1 = MYQUIZ_URL.'assets/css/myquiz.css';
    //$cssurl2 = MYQUIZ_URL.'assets/css/bootstrap.min.css';
    print "<link rel='stylesheet' href='".$cssurl1."'>";
    //print "<link rel='stylesheet' href='".$cssurl2."'>";   
}
    add_action('admin_head', 'add_css_to_head');
function add_js_to_footer(){
    $jsurl1 = MYQUIZ_URL.'assets/js/myquiz.js';
    //$jsurl2 = MYQUIZ_URL.'assets/js/bootstrap.min.js';
    print "<script type='text/javascript' src='".$jsurl1."'></script>";
    //print "<script type='text/javascript' src='".$jsurl2."'></script>";
}
    add_action('admin_footer', 'add_js_to_footer');

function myquiz_add_menu_option(){
    add_menu_page('My Quiz', 'My Quiz', 'manage_options', 'myquiz-admin-menu', 'myquiz_page', '', 200);
    add_submenu_page('myquiz-admin-menu', 'Add Quiz', 'Add Quiz', 'manage_options', 'myquiz_addquiz', 'myquiz_addquiz');
    add_submenu_page('myquiz-admin-menu', 'Add Questions', 'Add Questions Quiz', 'manage_options', 'myquiz_addquestion', 'myquiz_addquestion');
    
}

add_action('admin_menu', 'myquiz_add_menu_option');

