<?php
include('index.html');


//echo print_r($_POST,true);
//echo "<br/>";

//echo $job;
//exit();

if(empty($_POST)) exit();

$job = $_POST["API_Job"];
$portal = $_POST['PortalChoice'];
$reportLocation = $_POST["Report_in"];
$token = $_POST["API_in"];
?>
<?php


require_once('iasme-API.php');
runJob($job,$orgid,$listid,$newcontname,$newcontusername,$contsize,$contusername,$polid,$reportLocation,$verifyemail,$verifyname,$verifyrole,$answerSheet,$echotype=1);
