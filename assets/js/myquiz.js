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

function addoptions(){
    var count = document.getElementsByClassName("options").length;
    var newtr = document.createElement("tr");
    var newtd1 = document.createElement("td");
    var newtd2 = document.createElement("td");
    var node1 = document.createTextNode("Option"+(count+1));
    var node2 = document.createTextNode("<input id='option"+(count + 1)+"' type='text' name='option"+(count + 1)+"'>");
    
    newtd1.appendChild(node1);
    newtd2.appendChild(node2);
    newtr.appendChild(newtd1);
    newtr.appendChild(newtd2);
    
    var parenttable = document.getElementById("quiztable");
    var elementafter = document.getElementById("addoptionbutton");
    
    //currentele.insertBefore(newtr, currentele.);
    
    console.log(parenttable);
    //var parent = element.children(element);
    //console.log(parent);
       
}