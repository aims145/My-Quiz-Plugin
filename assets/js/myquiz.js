/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function multichoiceyes(){
    document.getElementById('radiobuttonforno').checked = false;
    document.getElementById('allowedmultichoice').style.display = "block";
    document.getElementById('allowedmultichoicelevel').style.display = "block";
    console.log("Yes");
}

function multichoiceno(){
    document.getElementById('radiobuttonforyes').checked = false;
    document.getElementById('allowedmultichoice').style.display = "none";
    document.getElementById('allowedmultichoicelevel').style.display = "none";
    console.log("No");
}

function checkmultichoice(){
    var multichoicestatu = document.getElementById("radiobuttonforno").checked;
    var countoption = document.getElementById("correctanswer");
    var countchecked = 0;
    var i;
//    for( i=0; i<countoption.length; i++ ){
//        if( countoption.checked === true ){
//            countchecked += 1;
//        }
//    }
//    if (countchecked > 1){
//        return false;
//    }
    console.log(countoption);
}


function addoptions(){
    var count = document.getElementsByClassName("options").length;
    var x = document.getElementsByTagName("tr");
    var parenttable = document.getElementById("quiztable");
    var elementafter = document.getElementById("addoptionbutton");
    
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
        cell3.innerHTML = "<td><input id='correctanswer' class='correctanswer' type='checkbox' name='correntansweroption"+(count + 1)+"' value='1' onclick='checkmultichoice();' ></td>";
    }
    else{
        return false;
    }

}