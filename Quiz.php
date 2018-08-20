<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

if(!class_exists('WP_List_Table')){
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}
class Custom_Wplist_Table extends WP_List_Table {
            
    
    
    function __construct(){
        global $status, $page;
                
        //Set parent defaults
        parent::__construct( array(
            'singular'  => 'movie',     //singular name of the listed records
            'plural'    => 'movies',    //plural name of the listed records
            'ajax'      => false        //does this table support ajax?
        ) );
        
    }
    
    function column_default($item, $column_name){
        switch($column_name){
            case 'quiz_name':
            case 'quiz_description':
                return $item[$column_name];
            default:
                return print_r($item,true); //Show the whole array for troubleshooting purposes
        }
    }

}

function myquiz_page(){

            global $wpdb;
            $url = admin_url();
            $table_name = $wpdb->prefix .MYTABLE;
            $table_data = $wpdb->get_results("select * from $table_name", ARRAY_A);
            var_dump($table_data);
    ?>
<div class="wrap">
    <h2>My Quizzes</h2>
    <h1 class="wp-heading-inline">Quiz</h1>
    <a href="<?php echo $url."admin.php?page=myquiz_addquiz"?>" class="page-title-action">Add New Quiz</a>
    <hr>
</div>
<?php }


    
    ?>


