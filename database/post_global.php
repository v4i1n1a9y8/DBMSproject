<?php 
include('dbconnect.php');
session_start();

$var = $_POST["message"];
if($var!=""){
addMessage($_SESSION["user_id"],NULL,$var);
}
?>