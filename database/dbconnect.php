<?php

$conn = new PDO("mysql:host=localhost;", "root", "");
$conn->exec("use test");

$conn->exec("
DROP DATABASE IF EXISTS test;
CREATE DATABASE test;
USE test;
CREATE TABLE users(
    user_id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(32) ,
    password varchar(200)
);

CREATE TABLE messages(
    message_id int PRIMARY KEY AUTO_INCREMENT,
    user_id_1 int,
    user_id_2 int,
    message text
);

CREATE TABLE friends(
    friends_id int PRIMARY KEY AUTO_INCREMENT,
    user_id_1 int,
    user_id_2 int,
    accepted int
);

");
$stmt=$conn->prepare("INSERT INTO users (username,password) VALUES (?,?)");
addUser("vinay","password");
addUser("vinay","password");
addUser("vinay","password");
addUser("vinay","password");
addUser("vinay","password");
addUser("vinay","password");
addUser("rakesh","password");
addUser("prasad","password");
addMessage(1,NULL,"LOOOOOL");
addMessage(3,NULL,"LOOOOOL");
addMessage(2,NULL,"LOOOOOL");
addMessage(1,NULL,"LOOOOOL");
addMessage(3,NULL,"LOOOOOL");
addMessage(2,NULL,"LOOOOOL");
addMessage(1,NULL,"LOOOOOL");
addMessage(2,NULL,"LOOOOOL");
addMessage(1,NULL,"LOOOOOL");
addfriend(1,2);
acceptfriend(1,2);

function addUser($username,$password){
    global $conn;
    $stmt=$conn->prepare("SELECT user_id FROM users where username=?");
    $stmt->execute([$username]);
    $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(count($count)>0){
        return;
    }

    $stmt=$conn->prepare("INSERT INTO users (username,password) VALUES (?,?)");
    $stmt->execute([$username,password_hash($password, PASSWORD_DEFAULT)]);
}
function getUsername($user_id){
    global $conn;
    $stmt=$conn->prepare("SELECT username FROM users where user_id=?");
    $stmt->execute([$user_id]);
    return $stmt->fetch()[0];
    //return count($stmt->fetch(PDO::FETCH_ASSOC));
}
function addMessage($user1,$user2,$msg){
    global $conn;
    $stmt=$conn->prepare("INSERT INTO messages (user_id_1,user_id_2,message) VALUES (?,?,?)");
    $stmt->execute([$user1,$user2,$msg]);
}
function addfriend($user1,$user2){
    if($user1==$user2){
        return;
    }
    global $conn;
    $stmt=$conn->prepare("INSERT INTO friends (user_id_1,user_id_2,accepted) VALUES (?,?,0)");
    $stmt->execute([$user1,$user2]);
}
function acceptfriend($user1,$user2){
    if($user1==$user2){
        return;
    }
    global $conn;
    $stmt=$conn->prepare("UPDATE friends SET accepted=1 WHERE (user_id_1=? and user_id_2=?) or (user_id_1=? and user_id_2=?)");
    $stmt->execute([$user1,$user2,$user2,$user1]); 
}
?>