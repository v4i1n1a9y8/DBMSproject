<?php 
include('dbconnect.php');
session_start();

$var = intval($_POST["id"]);
error_log("lol".getReqID($var,$_SESSION["user_id"]),0);
if($var!=""){
friendAccept(getReqID($var,$_SESSION["user_id"]));
}
?>