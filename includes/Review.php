<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
echo "<h1 class='text-center'>Review Questions</h1>";
//var_dump($_POST);
//
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
        if(isset($_POST["isreviewed_".$question_ids[$i]])){ 
            $accordianbg = "accordion-header-review"; 
        }
        else{
            $accordianbg = ""; 
        }
        $choice = $quesdata[0]->multichoice;
                if( $choice == 0 ){
                    
                    $type = "radio";
                    $class = "pure-radiobutton";
                }else{
                    
                    $type = "checkbox";
                    $class = "pure-checkbox";
                }
                ?>
    
    <div class="card">
        <div class="card-header <?php echo $accordianbg; ?>" id="heading<?php echo $i;?>">
          <div class="row mb-0" data-toggle="collapse" data-target="#collapse<?php echo $i;?>" aria-expanded="true" aria-controls="collapse<?php echo $i;?>">
              <div class="col-sm-1"></div>
              <div class="col-sm-3 div-reviewallaccordian"><?php echo "Question ".($i+1);?></div>
              <div class="col-sm-3 div-reviewallaccordian">
              <?php if(isset($_POST["radio".$question_ids[$i]])){ echo "Question Answered"; }else{ echo "Question not Answered";} ?>
              </div>
              <div class="col-sm-3  div-reviewallaccordian"><?php if(isset($_POST["isreviewed_".$question_ids[$i]])){ echo "Marked For Review"; }?></div>
          </div>
        </div>

        <div id="collapse<?php echo $i;?>" class="collapse" aria-labelledby="heading<?php echo $i;?>" data-parent="#accordionExample">
          <div class="card-body">
              <div class="row">
                  <div class="col-sm-1"></div>
                  <div class="col-sm-11">
                      <div class="col-sm-12">
                          <!-- Print Question here-->
                          <h6><?php echo $quesdata[0]->question ?></h6>
                      </div>
                      <?php
                      // Get all options into array from database
                      $option = json_decode($quesdata[0]->options);
                      // Define if it is multichoice and set type and class for input element
                      $choice = $_POST["ismultiple_".$question_ids[$i]];
                        if( $choice == 0 ){
                            $type = "radio";
                            $class = "pure-radiobutton";
                        }else{
                            $type = "checkbox";
                            $class = "pure-checkbox";
                        }
                      // Get count of options available for the question  
                      $optioncount = $_POST["optioncount_".$question_ids[$i]];
                      // Get selected answers by user for the question
                      $selectedanswers = $_POST["radio".$question_ids[$i]];
           // Print all options available            
          for($j=0; $j<$optioncount; $j++){
              //option should not be blank
              if(!empty($option[$j])){
              echo "<div class='col-sm-12'>";
              echo "<div class='".$class."'>";
              // if answer is selected and multichoice is not enabled and selected option is equal to current index +1
              if(isset($selectedanswers) and $type == "radio" and ($j+1) == $selectedanswers[0]){

                  echo "<input id='radio".$question_ids[$i].",".$j."' name='radio".$question_ids[$i]."[]' type='".$type."' class='radio' value='".($i+1)."' checked>";


              } //elseif answer is seelected, multichoise is enabled and current index +1 is in selected answer array
              elseif (isset($selectedanswers) and $type == "checkbox" and in_array(($j+1), $selectedanswers)) {
                  echo "<input id='radio".$question_ids[$i].",".$j."' name='radio".$question_ids[$i]."[]' type='".$type."' class='radio' value='".($i+1)."' checked>";
               }
              else{
                  echo "<input id='radio".$question_ids[$i].",".$j."' name='radio".$question_ids[$i]."[]' type='".$type."' class='radio' value='".($i+1)."' >";
              }


              echo "<label for='radio".$question_ids[$i].",".$j."'>".$option[$j]."</label>";
              echo "</div>";
              echo "</div>";

              }
          }
                      ?>
                      
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
    <div class="col-sm-2"><button class="btn btn-success" type="button">Submit Quiz</button></div>
</div>