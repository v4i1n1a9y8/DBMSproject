<?php 
include('dbconnect.php');
session_start();

$var = intval($_POST["id"]);
if($var!=""){
friendRequest($_SESSION["user_id"],$var);
}
?>