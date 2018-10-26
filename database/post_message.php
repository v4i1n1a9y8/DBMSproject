<?php 
include('dbconnect.php');
session_start();

$var = $_POST["message"];
$user2 = $_POST["receiver"];
if($var!=""){
addMessage($_SESSION["user_id"],$user2,$var);
}
?>