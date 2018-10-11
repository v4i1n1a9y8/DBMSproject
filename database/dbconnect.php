<?php

$conn = new PDO("mysql:host=localhost;", "root", "");

$conn->exec("
DROP DATABASE IF EXISTS test;
CREATE DATABASE test;
USE test;
CREATE TABLE users(
    user_id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(32) ,
    password varchar(200)
);");
$stmt=$conn->prepare("INSERT INTO users (username,password) VALUES(?,?)");
$stmt->execute(["vinay",password_hash("password", PASSWORD_DEFAULT)]);
$stmt->execute(["rakesh",password_hash("password", PASSWORD_DEFAULT)]);
$stmt->execute(["prasad",password_hash("password", PASSWORD_DEFAULT)]);

?>