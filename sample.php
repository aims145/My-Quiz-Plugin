<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function myquiz_addquiz(){
    ?>
<div class="wrap">
<h1 class="wp-heading-inline">Add New Quiz</h1>
<hr class="wp-header-end">
<div class="myquizform">
<table border="1">
    <tr>
        <td><label style="vertical-align: top;">Question :</label></td>
        <td><textarea id="" name="" style="resize: none;" cols="80" rows="3" placeholder="Enter your Question"></textarea><br></td>
    </tr>
    <tr>
        <td><label>Is Multiple Choice ?</label></td>
        
        <td>
            <input id="radiobuttonforyes" type="radio" name="multichoiceyes" value="yes" onclick="document.getElementById('radiobuttonforno').checked = false" >
            <label>Yes  </label>
            <input id="radiobuttonforno" type="radio" name="multichoiceno" value="no" checked="checked" onclick="document.getElementById('radiobuttonforyes').checked = false">
            <label>No   </label>
        </td>
    </tr>
</table>
</div>    
</div>
<?php
}

function add_css_to_head(){
    $cssurl = MYQUIZ_URL.'assets/css/myquiz.css';
    print "<link rel='stylesheet' href='".$cssurl."'>";
}
add_action('wp_head', 'add_css_to_head');

function add_js_to_footer(){
    $jsurl = MYQUIZ_URL.'assets/js/myquiz.js';
    print "<script type='text/javascript' src='".$jsurl."'></script>";
}
add_action('wp_footer', 'add_js_to_footer');


 <select name="allowedmultichoice" class="allowedmultichoice" >
                <option value="1" selected>1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>