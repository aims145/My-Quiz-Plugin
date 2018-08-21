<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
global $wpdb;
$url = admin_url();
$table_name = $wpdb->prefix .MYTABLE;
$table_data = $wpdb->get_results("select * from $table_name", ARRAY_A);
var_dump($table_data);
?>
<link rel="stylesheet" href="<?php echo MYQUIZ_URL.'assets/css/bootstrap.min.css'; ?>" />
<script type='text/javascript' src="<?php echo MYQUIZ_URL.'assets/js/bootstrap.min.js'; ?>"></script>
<div class="wrap">
    <h2>My Quizzes</h2>
    <h1 class="wp-heading-inline">Quiz</h1>
    <a href="<?php echo $url."admin.php?page=myquiz_addquiz"?>" class="page-title-action">Add New Quiz</a>
    <hr>
</div>



