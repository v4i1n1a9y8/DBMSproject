<?php
include("dbconnect.php");
session_start();
  $userid = $_SESSION["user_id"];
  $stmt = $conn->prepare("
  DELETE from users where user_id=$userid;
  DELETE from messages where user_id_1=$userid or user_id_2=$userid;
  DELETE from friend_requests where user_id_1=$userid or user_id_2=$userid;
  DELETE from friends where user_id_1=$userid or user_id_2=$userid;
  DELETE from last_active where user_id=$userid;
");
$stmt->execute();
  session_destroy();
  header('location:login.php');
?>