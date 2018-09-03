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
    <form action="" method="post" id="regForm">
    <div class="quizheading"><h1 class="text-center"><?php echo $quizname;?></h1></div>

    
    <div class="allsteps ">
        
        <?php
            $count = 0;
            foreach ($quiz_all_ques as $question){
                $choice = $question->multichoice;
                if( $choice == 0 ){
                    
                    $type = "radio";
                    $class = "pure-radiobutton";
                }else{
                    
                    $type = "checkbox";
                    $class = "pure-checkbox";
                }
                $count++;
                ?>
                
            <div class='step'>
                <div class="quiz-question row">
                    <div class="col-sm-3 questionheading"><?php echo "Total Questions - ".count($quiz_all_ques); ?></div>
                    <div class="col-sm-3 questionheading " id="questionnumber">Question <?php echo $count;?></div>
                    <div class="col-sm-3 questionheading">
                            <div class="pure-checkbox custlabel">
                                <input id="checkbox1" name="checkbox" type="checkbox" >
                                <label for="checkbox1">Mark for review</label>
                            </div>

                    </div>
                    <div class="col-sm-3 questionheading">
                        <div id="timerdiv" class="timerdiv" >Timer -( HH:MM:SS )</div>
                    </div>

                </div>
                <div class='row questionbody'>
                <div class='col-sm-1 questiontitle'><img class='img-rounded' src='<?php echo MYQUIZ_URL."assets/images/question_mark.png"; ?>' ></div>
                <div class='col-sm-11 question'><?php echo $question->question; ?></div>
                </div>
                <div class="alloptions">
                    <div class="row options">
                        <?php
                        $numberofoptions = $question->numberofoptions;
                        $option = json_decode($question->options);
                        for( $i=0; $i<$numberofoptions; $i++){
                            ?>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-11 option">
                            <div class="<?php echo $class; ?>">
                                <input id="radio<?php echo $question->question_id.",".$i;?>" name="radio" type="<?php echo $type?>" class="radio" >
                                <label for="radio<?php echo $question->question_id.",".$i;?>"><?php echo $option[$i]; ?></label>
                            </div>

                        </div>
                        <?php
                                                }
                        ?>
                    </div>
                </div>
                
                </div>
                <?php
            }
        ?>

        <div class="row bottom-margin" style="overflow:auto;">
                    <div class="col-sm-1"></div>
                    <div class="col-sm-2"><button class=" button startquiz-btn" type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button></div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2"><button class=" button startquiz-btn" type="button">Submit Quiz</button></div>
                    <div class="col-sm-2"></div>
                    <div class="col-sm-2"><button class=" button startquiz-btn" type="button" id="nextBtn" onclick="nextPrev(1)">Next</button></div>
                    <div class="col-sm-1"></div>
        </div> 
    </div>
    
    
    </form>
</div>
<script>
quiztimer();
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab
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
