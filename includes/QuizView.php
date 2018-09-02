<link rel="stylesheet" href="<?php echo MYQUIZ_URL.'assets/css/myquiz.css'; ?>" />
<!--<link rel="stylesheet" href="<?php //echo MYQUIZ_URL.'assets/css/magic-check.min.css'; ?>" />-->
<link rel="stylesheet" href="<?php echo MYQUIZ_URL.'assets/css/bootstrap.min.css'; ?>" />
<script type='text/javascript' src="<?php echo MYQUIZ_URL.'assets/js/jquery-3.3.1.min.js'; ?>"></script>
<script type='text/javascript' src="<?php echo MYQUIZ_URL.'assets/js/bootstrap.min.js'; ?>"></script>
<script type='text/javascript' src="<?php echo MYQUIZ_URL.'assets/js/myquiz.js'; ?>"></script>
<?php 
$quiztable = $wpdb->prefix.MYTABLE;
$sql = "select * from $quiztable where quiz_id='".$params['id']."'";
$listshortcodes = $wpdb->get_results($sql);
//var_dump($listshortcodes);

if(isset($_POST["startquiz"])){
    $quizname = $_POST["quizname"];
    $questable = $wpdb->prefix.MYQUESTIONS;
    $sql = "select * from $questable where quiz_id='".$params['id']."'";
    $quiz_all_ques = $wpdb->get_results($sql);
    ?>
<div class="question-content">
    <div class="quizheading"><h1 class="text-center"><?php echo $quizname;?></h1></div>
    <div class="quiz-question row">
        <div class="col-sm-3 questionheading"><h4><?php echo "Total Questions - ".count($quiz_all_ques); ?></h4></div>
        <div class="col-sm-3 questionheading "><h4>Question 1</h4></div>
        <div class="col-sm-3 questionheading"><h4>
                <div class="pure-checkbox">
                    <input id="checkbox1" name="checkbox" type="checkbox" >
                    <label for="checkbox1">Mark for review</label>
                </div>
            </h4>
        </div>
        <div class="col-sm-3 questionheading">
            <h4 id="timerdiv" >Timer -( HH:MM:SS )</h4>
        </div>
      
    </div>
    <div class="row questionbody">
        
        <div class="col-sm-1 questiontitle"><img class="img-rounded" src="<?php echo MYQUIZ_URL.'assets/images/question_mark.png'; ?>" ></div>
        
        <div class="col-sm-11 question">There are currently multiple applications hosted in a VPC. During monitoring it has been noticed that multiple port scans are coming in from a specific IP Address block. The internal security team has requested that all offending IP Addresses be denied for the next 24 hours. Which of the following is the best method to quickly and temporarily deny access from the specified IP Address's.
Please select :</div>
        
    </div>
    <div class="alloptions">
    <div class="row options">
        <div class="col-sm-1"></div>
        <div class="col-sm-11 option">
            <div class="pure-radiobutton">
                <input id="radio1" name="radio" type="radio" class="radio" >
                <label for="radio1">A. Create an AD policy to modify the Windows Firewall settings on all hosts in the VPC to deny access from the IP Address block.</label>
            </div>
            
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-11 option">
            <div class="pure-radiobutton ">
                <input id="radio2" name="radio" type="radio" class="radio" >
                <label for="radio2">A. Create an AD policy to modify the Windows Firewall settings on all hosts in the VPC to deny access from the IP Address block.</label>
            </div>
            
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-11 option">
            <div class="pure-radiobutton ">
                <input id="radio3" name="radio" type="radio" class="radio" >
                <label for="radio3">A. Create an AD policy to modify the Windows Firewall settings on all hosts in the VPC to deny access from the IP Address block.</label>
            </div>
            
        </div>
        <div class="col-sm-1"></div>
        <div class="col-sm-11 option">
            <div class="pure-radiobutton ">
                <input id="radio4" name="radio" type="radio" class="radio" >
                <label for="radio4">A. Create an AD policy to modify the Windows Firewall settings on all hosts in the VPC to deny access from the IP Address block.</label>
            </div>
            
        </div>
    </div>
            <div class="row bottom-margin">
            <div class="col-sm-1"></div>
            <div class="col-sm-2"><button class=" button startquiz-btn">Previous</button></div>
            <div class="col-sm-2"></div>
            <div class="col-sm-2"><button class=" button startquiz-btn">Submit Quiz</button></div>
            <div class="col-sm-2"></div>
            <div class="col-sm-2"><button class=" button startquiz-btn">Next</button></div>
            <div class="col-sm-1"></div>
        </div>    
    
    </div>

</div>
<script>
quiztimer();
</script>
<?php }else{
?>
<div class="quizcontent">
    <div class="quizheading">
        <h1 class="text-center"><?php echo $listshortcodes[0]->quiz_name;?></h1>
    </div>
    <div class="quizdescription">
        <?php echo $listshortcodes[0]->quiz_description; ?>
    </div>
    <form method="post" action="" name="startquizform" id="startquizform">
    <div class="row btn-row">
        
        <div class="col-sm-4"></div>
        <input type="hidden" name="quizname" value="<?php echo $listshortcodes[0]->quiz_name;?>">
        <input type="hidden" name="quiz-category" id="quiz-category" value="awssaa">
        <button class="button col-sm-4 startquiz-btn" id="startquiz" name="startquiz" type="submit">Start Quiz</button>
        <div class="col-sm-4"></div>
        
    </div>
    </form>
</div>    
<?php 
}
