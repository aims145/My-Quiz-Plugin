/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function multichoiceyes(element){
    var radiobuttonno = document.getElementById('radiobuttonforno');
        radiobuttonno.checked = false;
    document.getElementById('allowedmultichoice').style.display = "block";
    document.getElementById('allowedmultichoicelevel').style.display = "block";
    var allradiobuttons = document.getElementsByClassName("correctanswer");
    for( i=0; i<allradiobuttons.length; i++ ){
        allradiobuttons[i].checked = false;
        allradiobuttons[i].setAttribute("type", "checkbox");
    }
    element.setAttribute("value", "1");
    radiobuttonno.removeAttribute("value");
}

function multichoiceno(element){
    var radiobuttonyes = document.getElementById('radiobuttonforyes');
        radiobuttonyes.checked = false;
    document.getElementById('allowedmultichoice').style.display = "none";
    document.getElementById('allowedmultichoicelevel').style.display = "none";
    var allradiobuttons = document.getElementsByClassName("correctanswer");
    for( i=0; i<allradiobuttons.length; i++ ){
        allradiobuttons[i].checked = false;    
        allradiobuttons[i].setAttribute("type", "radio");
    }
    element.setAttribute("value", "1");
    radiobuttonyes.removeAttribute("value");
    
}

function checkmultichoice(element){
    var multichoice = document.getElementById("radiobuttonforno").checked;
    if ( multichoice === true ){
        var countoption = document.getElementsByClassName("correctanswer");
        var i;
        for( i=0; i<countoption.length; i++ ){
            countoption[i].checked = false;
        }
        element.checked = true;
        element.setAttribute("value","1");
    }
    else{
        var selectvalue = document.getElementById("allowedmultichoice").value;
        var countoption = document.getElementsByClassName("correctanswer");
        var i;
        var checkedcount = 0;
        for( i=0; i<countoption.length; i++ ){
            if(countoption[i].checked === true){
                checkedcount += 1;
            }
            
        }
        if( selectvalue < checkedcount ){
            window.alert("Not allowed more option as correct answer");
            element.checked = false;
        }
        else{
            element.setAttribute("value","1");
            element.checked = true;
        }
    }
    
    
}


function addoptions(){
    var count = document.getElementsByClassName("options").length;
    var x = document.getElementsByTagName("tr");
    var parenttable = document.getElementById("quiztable");
    var elementafter = document.getElementById("addoptionbutton");
    var radiostatus = document.getElementById("radiobuttonforyes").checked;
    
    var i;
    var indexoftr;
    for (i = 0; i < x.length; i++) {
    if( x[i] === elementafter ){
        indexoftr = i;
    }
    }
    
    if(count < 6 ){
        var row = parenttable.insertRow(indexoftr);
        var cell1 = row.insertCell(0);
        var cell2 = row.insertCell(1);
        var cell3 = row.insertCell(2);
        cell1.setAttribute("class", "options");
        cell1.innerHTML = "Option"+(count+1);
        cell2.innerHTML = "<input id='option"+(count + 1)+"' type='text' name='option"+(count + 1)+"'>";
        if( radiostatus === true ){
            cell3.innerHTML = "<td><input id='correctanswer' class='correctanswer' type='checkbox' name='correntansweroption"+(count + 1)+"' onclick='checkmultichoice(this);' ></td>";
        }
        else{
            cell3.innerHTML = "<td><input id='correctanswer' class='correctanswer' type='radio' name='correntansweroption"+(count + 1)+"' onclick='checkmultichoice(this);' ></td>";
        }
    }
    else{
        return false;
    }

}