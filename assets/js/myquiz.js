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

$(document).on("click", "#editonerow", function () {
    var quizid = $(this).data('id');
    var parameters = "action=edit_quiz&quizid="+quizid;
    $.post(admin_ajax,parameters,function(response){
        var obj = $.parseJSON(response);
        var quiz_name = obj[0]["quiz_name"];
        var quiz_description = obj[0]["quiz_description"];
        document.getElementById("quizname").value = quiz_name;
        //document.getElementById("quizdescription").innerHTML = quiz_description;
        document.getElementsByClassName("quizdescription").innerHTML = quiz_description;
        
    });
     
});

//deleteonerow.addEventListener('click', 
//function(){
//    var quiz_id = deleteonerow.value;
//    console.log(quiz_id);
//}
//);