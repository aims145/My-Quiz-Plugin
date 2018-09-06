<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo "<h1 class='text-center'>Review Questions</h1>";
var_dump($_POST);

$question_ids = $_POST["question_id"];
$table_ques = $wpdb->prefix.MYQUESTIONS;
?>
<div class="accordion" id="accordionExample">
<?php
if(isset($question_ids)){
    $count = count($question_ids);
    for($i=0;$i<$count;$i++){
        //echo $question_ids[$i]." = > ".implode(",", $_POST["radio".$question_ids[$i]])."<br />";
        $sql = "select * from $table_ques where question_id='$question_ids[$i]'";
        $quesdata = $wpdb->get_results($sql);
                ?>
    
    <div class="card">
        <div class="card-header accordion-header-review" id="heading<?php echo $i;?>">
          <div class="row mb-0" data-toggle="collapse" data-target="#collapse<?php echo $i;?>" aria-expanded="true" aria-controls="collapse<?php echo $i;?>">
              <div class="col-sm-1"></div>
              <div class="col-sm-2 div-reviewallaccordian"><button class="button review-question-btn"><?php echo "Question ".($i+1);?></button></div>
              <div class="col-sm-4 div-reviewallaccordian"><button class="button review-question-btn">
              <?php if(isset($_POST["radio".$question_ids[$i]])){ echo "Question Answered"; }else{ echo "Question not Answered";} ?></button>
              </div>
              <div class="col-sm-4 div-reviewallaccordian"><p><?php if(isset($_POST["isreviewed_".$question_ids[$i]])){ echo "<button class='button review-question-btn'> Marked For Review</button"; }?></p></div>
          </div>
        </div>

        <div id="collapse<?php echo $i;?>" class="collapse" aria-labelledby="heading<?php echo $i;?>" data-parent="#accordionExample">
          <div class="card-body">
              <div class="row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-11">
                      <h6><?php echo $quesdata[0]->question ?></h6>
                  </div>
              </div>
              
          </div>
        </div>
  </div>
</div>       
<?php
 
    }
}
?>
<hr>
<div class="row">
    <div class="col-sm-5"></div>
    <div class="col-sm-2"><button class="button quiz-btn" type="button">Submit Quiz</button></div>
</div>