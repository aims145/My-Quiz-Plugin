/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function multichoiceyes(){
    var getoptions = document.getElementsByClassName("options");
    var i;
    for( i=0; i<getoptions.length; i++ ){
        var parent = getoptions[i].parentElement;    
        getoptions[i].setAttribute("type","checkbox");
        getoptions[i].setAttribute("onclick","checkmultichoice(this);");
        parent.setAttribute("class","checkboxlabel");
        
    }
    document.getElementById('allowedmultichoice').style.display = "flex";
}

function multichoiceno(){
    
    var getoptions = document.getElementsByClassName("options");
    var i;
    for( i=0; i<getoptions.length; i++ ){
        var parent = getoptions[i].parentElement;    
        getoptions[i].setAttribute("type","radio");
        getoptions[i].setAttribute("onclick","checkmultichoice(this);");
        parent.setAttribute("class","radiolabel");
    }
    document.getElementById('allowedmultichoice').style.display = "none";
}

function checkmultichoice(current){
//    console.log(current.id);
//    return false;
    
    var alloptions = document.getElementsByClassName("options");
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
        var inputclass = "checkboxlabel";
    }
    else{
        var inputtype = "radio";
        var inputclass = "radiolabel";
    }
    var nextelement = "<div class='col-sm-2'>Option "+(numberofoptionsnow+1)+"</div><div class='col-sm-6'><input class='form-control' type='text' name='option"+(numberofoptionsnow+1)+"' placeholder='Option "+(numberofoptionsnow+1)+"'></div><div class='col-sm-3'><label class='"+inputclass+"'><input class='form-control options' type='"+inputtype+"' name='options' onclick='checkmultichoice(this);' ><span class='checkmark'></span></label></div>";
    inputEle.innerHTML = nextelement;
    alloptions.appendChild(inputEle);
    }
    else{
        return false;
    }
    
}