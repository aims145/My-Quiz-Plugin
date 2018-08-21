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
define('MYQUESTIONS', "my_quiz_questions");
//function add_css_to_head(){
//    $cssurl1 = MYQUIZ_URL.'assets/css/myquiz.css';
//    print "<link rel='stylesheet' href='".$cssurl1."'>";
//}
//    add_action('admin_head', 'add_css_to_head');
//function add_js_to_footer(){
//    $jsurl1 = MYQUIZ_URL.'assets/js/myquiz.js';
//    print "<script type='text/javascript' src='".$jsurl1."'></script>";
//}
//    add_action('admin_footer', 'add_js_to_footer');

function myquiz_add_menu_option(){
    add_menu_page(
            'All Quiz', //Page title
            'My Quiz', // Menu Title
            'manage_options', // Admin level
            'myquiz-allquizzes', //Page Slug
            'myquiz_page', // Callback functions
            'dashicons-index-card', // IconURL
            11 // Position
            );

    
    add_submenu_page('myquiz-allquizzes', //Parent Slug
                    'All Quiz', //Page Titile
                    'All Quiz', //Menu Title
                    'manage_options', // Admin Level
                    'myquiz-allquizzes', //Page slug
                    'myquiz_page' // callback function
                    );
    add_submenu_page('myquiz-allquizzes', //Parent Slug
                    'Add Quiz', //Page Titile
                    'Add Quiz', //Menu Title
                    'manage_options', // Admin Level
                    'myquiz_addquiz', //Page slug
                    'myquiz_addquiz' // callback function
                    );
    add_submenu_page('myquiz-allquizzes', 'Add Questions', 'Add Questions Quiz', 'manage_options', 'myquiz_addquestion', 'myquiz_addquestion');
    
}

add_action('admin_menu', 'myquiz_add_menu_option');

function add_css_myquiz(){
    wp_enqueue_style("myquiz_style", MYQUIZ_URL.'assets/css/myquiz.css');
    wp_enqueue_script("myquiz_script", MYQUIZ_URL.'assets/js/myquiz.js', '', '',true);
}
add_action("init","add_css_myquiz");

function create_table_on_activation(){
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();
    $table_name = $wpdb->prefix .MYTABLE;

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
         `quiz_id` int(10) NOT NULL AUTO_INCREMENT,
         `quiz_name` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
         `quiz_description` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
         `quiz_addedquestions` int(10) NOT NULL,
         PRIMARY KEY (`quiz_id`),
         UNIQUE KEY `quiz_name` (`quiz_name`)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    $table_name = $wpdb->prefix .MYQUESTIONS;
    $sql = "CREATE TABLE IF NOT EXISTS `wp_my_quiz_questions` (
         `question_id` int(10) NOT NULL AUTO_INCREMENT,
         `question` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
         `options` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
         `multichoice` tinyint(1) NOT NULL,
         `numberofoptions` int(10) NOT NULL,
         `correctanswer` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
         `answerallowed` int(10) NOT NULL,
         `answerdescription` text COLLATE utf8mb4_unicode_520_ci NOT NULL,
         `quiz_id` int(10) NOT NULL,
         `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
         PRIMARY KEY (`question_id`)
         ) $charset_collate;";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}

register_activation_hook(__FILE__, 'create_table_on_activation');


function drop_table_on_delete(){
    global $wpdb;
    $table_name = $wpdb->prefix .MYTABLE;
    $sql = "drop table $table_name";
    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
}


register_uninstall_hook(__FILE__,'drop_table_on_delete');



function myquiz_page(){
    include_once MYQUIZ_DIR.'/includes/Quiz.php';
}

function myquiz_addquiz(){
    include_once MYQUIZ_DIR.'/includes/AddQuiz.php';
}

function myquiz_addquestion(){
    include_once MYQUIZ_DIR.'/includes/AddQuestion.php';
}

