/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function multichoiceyes(){
    var getoptions = document.getElementsByClassName("options");
    var i;
    for( i=0; i<getoptions.length; i++ ){
        getoptions[i].setAttribute("type","checkbox");
        getoptions[i].setAttribute("onclick","checkmultichoice(this);");
        //getoptions[i].setAttribute("name","correntanswer"+(i+1));
        
    }
    document.getElementById('allowedmultichoice').style.display = "flex";
}

function multichoiceno(){
    
    var getoptions = document.getElementsByClassName("options");
    var i;
    document.getElementById("numbersofanswer").selectedIndex = 0;
    for( i=0; i<getoptions.length; i++ ){
        getoptions[i].setAttribute("type","radio");
        getoptions[i].setAttribute("onclick","checkmultichoice(this);");
        //
        //getoptions[i].setAttribute("name","correntanswer");
        
    }
    document.getElementById('allowedmultichoice').style.display = "none";
    var selectreset = document.getElementById("numbersofanswer");
        selectreset.value = 1;
}

function checkmultichoice(current){
//    console.log(current.id);
//    return false;

    var alloptions = document.getElementsByClassName("options");
    document.getElementById("optionscount").value = alloptions.length;
    console.log(alloptions.length);
    var checkedcount = 0;
    var selectvalue = document.getElementById("numbersofanswer").value;
    var i;
        for( i=0; i<alloptions.length; i++){
            if(alloptions[i].checked === true){
                checkedcount += 1;
            }
        }
        
    var multichoice = document.getElementById("radiobuttonforyes");
    if(multichoice.checked === true ){
        if(selectvalue < checkedcount){
            current.checked = false;
            return false;
        }
       
    }
}

function addmoreoption(){
    var alloptions = document.getElementById("alloptions");
     
    
    var numberofoptionsnow = alloptions.childElementCount;
    if(numberofoptionsnow < 6){
    var optioncountvals = document.getElementById("optionscount");
    optioncountvals.value = +optioncountvals.value + 1;
    var inputEle = document.createElement("div");
    inputEle.setAttribute("class", "form-group row");
    if(document.getElementById("radiobuttonforyes").checked === true){
        var inputtype = "checkbox";
    }
    else{
        var inputtype = "radio";
    }
    var nextelement = "<div class='col-sm-2'>Option "+(numberofoptionsnow+1)+"</div><div class='col-sm-6'><input class='form-control' type='text' name='option"+(numberofoptionsnow+1)+"' placeholder='Option "+(numberofoptionsnow+1)+"'></div><div class='col-sm-3'><label class='radiolabel'><input class='form-control options' type='"+inputtype+"' name='correntanswer[]' onclick='checkmultichoice(this);' ><span class='checkmark'></span></label></div>";
    inputEle.innerHTML = nextelement;
    alloptions.appendChild(inputEle);
    }
    else{
        return false;
    }
    
}

$(document).on("click", "#deleteonerow", function () {
    var quizid = $(this).data('id');
    console.log(quizid);
    var parameters = "action=delete_quiz&quizid="+quizid;
    console.log(admin_ajax);
    $.post(admin_ajax,parameters,function(response){
        console.log(response);
        var quizalert = document.getElementById("quizalert");
        if(response === "Deleted"){
            $("#"+quizid).remove();
            //var tablerow = document.getElementById(quizid);
            //tablerow.remove;
            quizalert.style.display = "block";
            quizalert.innerHTML = "Quiz "+response+" Successfully";
            quizalert.setAttribute("class", "alert alert-success");
            $("#quizalert").fadeOut(3000);
        }
        else{
            quizalert.style.display = "block";
            quizalert.innerHTML = "Error : "+response;
            quizalert.setAttribute("class", "alert alert-danger");
            $("#quizalert").fadeOut(4000);
        }
       
    });

});


// ------------------------------------- Edit Single quiz -----------------//
$(document).on("click", "#editonequiz", function () {
    var quizid = $(this).data('id');
    var parameters = "action=edit_quiz&quizid="+quizid;
    $.post(admin_ajax,parameters,function(response){
        var obj = $.parseJSON(response);
        var quiz_name = obj[0]["quiz_name"];
        var quiz_description = obj[0]["quiz_description"];
        document.getElementById("quizname").value = quiz_name;
        var quizdesc = document.getElementById("quizdescription");
        quizdesc.setAttribute("aria-hidden","true");
        quizdesc.innerHTML = quiz_description;
        document.getElementById("editquiz").style.display = "block";
        document.getElementById("hiddenquizid").value = quizid;
        
        //document.getElementById("editedesc").innerHTML = phpcode;    
        
    });
     
});

$('#closeedit').on('click', function () {
    document.getElementById("editquiz").style.display = "none";
});


//----------------------------------- Edit Single Question ---------------------------//
$(document).on("click", "#editonequestions", function () {
    var questionid = $(this).data('id');
    var parameters = "action=edit_question&questionid="+questionid;
    $.post(admin_ajax,parameters,function(response){
        console.log(response);
        var obj = $.parseJSON(response);
        console.log(obj[0]["question_id"])
    });
});



//----------------- Select All questions  --------------------//
$(document).on("click", "#selectallquestion", function (){
    var selectallcheckbox = document.getElementById("selectallquestion");
    var allcheckbox = document.getElementsByClassName("question-id");
    var checkboxcount = allcheckbox.length;
    var i;
    if( selectallcheckbox.checked === true ){
        for( i=0; i<checkboxcount; i++ ){
           allcheckbox[i].checked = true;
        }
    }else{
        for( i=0; i<checkboxcount; i++ ){
           allcheckbox[i].checked = false;
        }
    }
    
//    var i;
//    if( selectallcheckbox.checked === true ){
//        for( i=0; i<checkboxcount; i++ ){
//           allcheckbox[i].checked = true;
//        }
//    }
//    else{
//        for( i=0; i<checkboxcount; i++ ){
//           allcheckbox[i].checked = false;
//        }
//    }
    
});


//----------------- Select All quiz  --------------------//
$(document).on("click", "#selectallquiz", function (){

    var selectallcheckbox = document.getElementById("selectallquiz");
    var allcheckbox = document.getElementsByClassName("quiz-id");
    var checkboxcount = allcheckbox.length;
    var i;
    if( selectallcheckbox.checked === true ){
        for( i=0; i<checkboxcount; i++ ){
           allcheckbox[i].checked = true;
        }
    }
    else{
        for( i=0; i<checkboxcount; i++ ){
           allcheckbox[i].checked = false;
        }
    }

    
});

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

$(document).on("click", "#startquiz", function(){
    var category = document.getElementById("quiz-category").value;
    if( category === 'awssaa'){
       document.cookie = "hours=01";
       document.cookie = "minutes=19";
       document.cookie = "seconds=60";
    }
    
});

//----------------- Time ---------------------------//



function quiztimer(){
    var hours = getCookie("hours");
    var minutes = getCookie("minutes");
    var seconds = getCookie("seconds");
    (function move() {
            var timer = document.getElementsByClassName("timerdiv")
            seconds -= 01;
            if(seconds === 0 ){
                minutes -= 1;
                seconds = 59;
                if( minutes === 0 ){
                    hours -= 1;
                    minutes = 59;
                }
            }
            var timerdivcount = timer.length;
            var i;
            for( i=0; i<timerdivcount; i++){
                timer[i].innerHTML = "Timer - "+hours+":"+minutes+":"+seconds;
            }
            
            document.cookie = "hours="+hours;
            document.cookie = "minutes="+minutes;
            document.cookie = "seconds="+seconds;
            setTimeout(move, 1000);

    })();

}

// --------------------------- Multi Steps forms Script ---------------------//

function showTab(n) {
  // This function will display the specified tab of the form ...
  var x = document.getElementsByClassName("step");
    console.log(n);
  x[n].style.display = "block";
  // ... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) {
    document.getElementById("nextBtn").innerHTML = "Submit";
  } else {
    document.getElementById("nextBtn").innerHTML = "Next";
  }
  // ... and run a function that displays the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("step");
  // Exit the function if any field in the current tab is invalid:
  if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form... :
  if (currentTab >= x.length) {
    //...the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("step");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false:
      valid = false;
    }
  }
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < x.length; i++) {
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class to the current step:
  x[n].className += " active";
}