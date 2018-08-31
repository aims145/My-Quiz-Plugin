<link rel="stylesheet" href="<?php echo MYQUIZ_URL.'assets/css/myquiz.css'; ?>" />
<link rel="stylesheet" href="<?php echo MYQUIZ_URL.'assets/css/bootstrap.min.css'; ?>" />
<script type='text/javascript' src="<?php echo MYQUIZ_URL.'assets/js/jquery-3.3.1.min.js'; ?>"></script>
<script type='text/javascript' src="<?php echo MYQUIZ_URL.'assets/js/bootstrap.min.js'; ?>"></script>
<?php 
$quiztable = $wpdb->prefix.MYTABLE;
$sql = "select * from $quiztable where quiz_id='".$params['id']."'";
$listshortcodes = $wpdb->get_results($sql);
//var_dump($listshortcodes);

if(isset($_POST["startquiz"])){
    echo "I am starting quiz here";
}else{
?>
<div class="quizcontent">
    <div class="quizheading">
        <h1 class="text-center"><?php echo $listshortcodes[0]->quiz_name;?></h1>
    </div>
    <div class="quizdescription">
        <?php echo $listshortcodes[0]->quiz_description; ?>
    </div>
    <form method="post" action="" name="startquizform">
    <div class="row btn-row">
        
        <div class="col-sm-4"></div>
        <button class="button col-sm-4 startquiz-btn" name="startquiz" type="submit">Start Quiz</button>
        <div class="col-sm-4"></div>
        
    </div>
    </form>
</div>    
<?php 
}
