<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "test";

function conn() {
    global $hostname,$username,$password,$dbname;
    $conn = new PDO("mysql:host=$hostname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
function usedb($conn) {
    global $dbname;
    conn()->exec("use $dbname");
}
function resetdb($conn) {
    global $dbname;
    $conn->exec("
    DROP DATABASE IF EXISTS $dbname;
    CREATE DATABASE $dbname;
    USE $dbname;
    CREATE TABLE users(
        id int PRIMARY KEY AUTO_INCREMENT,
        email   varchar(64),
        password varchar(32),
        fname   varchar(32),
        sname   varchar(32),
        age     int,
        mnumber int
    );
    CREATE TABLE messages(
        msgid int PRIMARY KEY AUTO_INCREMENT,
        sid int,
        rid int,
        message TEXT
    );
    CREATE TABLE friends(
        uid1 int,
        uid2 int,
        confirmed boolean
    );
    ");
}
function insertUser($conn,$email,$password,$fname,$sname,$age,$mnumber){
    $stmt = $conn->prepare("INSERT INTO users (email,password,fname,sname,age,mnumber)
    VALUES (?,?,?,?,?,?)");
    $stmt->execute([$email,$password,$fname,$sname,$age,$mnumber]);
}
function getUsers($conn){
    $stmt = $conn->prepare("SELECT * from users");
    $stmt->execute();
    return $stmt->fetchAll()[0]["fname"];
}
function sendMsg($conn,$sender,$receiver,$message){
    $stmt = $conn->prepare("INSERT INTO messages (sid,rid,message)
    VALUES (?,?,?)");
    $stmt->execute([$sender,$receiver,$message]);
}
function sendFreq($conn,$user1,$user2) {
    $stmt = $conn->prepare("INSERT INTO friends (uid1,uid2,confirmed)
    VALUES (?,?,?)");
    $stmt->execute([$user1,$user2,true]);
}
function getMessages($conn){
    $stmt = $conn->prepare("SELECT * FROM messages");
    $stmt->execute();
    return $stmt->fetchAll( PDO::FETCH_ASSOC);
}
?>