<?php
/*
function redirectToHttps(){
  if(empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] == "off"){
    echo "https";
    $redirect = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    header('HTTP/1.1 301 Moved Permanently');
    header('Location: ' . $redirect);
    exit();
  }  
}*/
//redirectToHttps();


error_reporting(0);

include("functions/sandbox.php");
include("functions/app.php");
$urlData = get_path();
global $pageDet;
$pageDet = $urlData["call_parts"];




global $domain;
//$domain = "https://".$_SERVER['HTTP_HOST']."/";
$domain = "http://".$_SERVER['HTTP_HOST']."/softwaredevelopment/iter/v2.0/1.0/";


$preDeterm = [];

$preDeterm["website-design-rochford"] = "Contact";
$preDeterm["software-design-rochford"] = "Contact";
$preDeterm["software-developer-rochford"] = "Contact";
$preDeterm["website-developer-rochford"] = "Contact";



$pgApp = new app($urlData,$preDeterm);

$pgApp->loadModules();
$pgApp->register_var("/({view=(.*?)})/",function(){return "trollz";});
$pgApp->register_var("/({domain})/",function(){return "http://".$_SERVER['HTTP_HOST']."/softwaredevelopment/iter/v2.0/1.0/";});


$pg = $pgApp->getPage();



$pgApp->call_hook("activation",$urlData);

$pg = $pgApp->process_vars($pg);

echo $pg;

?>
