<?php




$appName = "testApp";
$appEnabled = false;


$hooks = [
["activation","test"]
];

$vars = [
["/({username})/","get_username"]
];





function test(){
    ?>
    <h1>Activation Hook</h1>
    <?php
    
}


function get_username(){
    return "?UserName Goes Here?";
}




?>