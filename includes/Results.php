<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var_dump($_POST);
$question_ids = $_POST["question_id"];
$table_ques = $wpdb->prefix.MYQUESTIONS;
$totalmarks = '';
echo "<pre>";
if(isset($question_ids)){
    $count = count($question_ids);
    for($i=0;$i<$count;$i++){
        //echo $question_ids[$i]." = > ".implode(",", $_POST["radio".$question_ids[$i]])."<br />";
        
        if(isset($_POST["radio".$question_ids[$i]])){
            $answer = $_POST["radio".$question_ids[$i]];
            $sql = "select * from $table_ques where question_id='$question_ids[$i]'";
            $quesdata = $wpdb->get_results($sql);
            $correctanswer = explode(",", $quesdata[0]->correctanswer);
            echo implode(",", $answer)." =>";
            if($quesdata[0]->multichoice == 0){
                
                if($correctanswer[0] == $answer[0]){
                    echo $question_ids[$i]." your answer is correct<br/>";
                }else{
                    echo $question_ids[$i]." your answer is not correct<br/>";
                }
            }else{
                $isCorrect = 0;
                for($j=0;$j<count($correctanswer);$j++){
                    
                  if(in_array($correctanswer[$j], $answer)){
                      $isCorrect += 1;
                  }
                  else{
                      $isCorrect -= 1;
                  }
                  
                    
                }

                if($isCorrect == 0){
                    echo $question_ids[$i]." Your answer is partially correct<br/>";
                }elseif ($isCorrect > 0) {
                    echo $question_ids[$i]." Your answer is correct<br/>";
                }
                else{
                    echo $question_ids[$i]." Your answer is not correct<br/>";
                }
                
            }
        }else{
            echo $question_ids[$i]." =>Not Answered<br/>";
        }
        
    }
}

die();