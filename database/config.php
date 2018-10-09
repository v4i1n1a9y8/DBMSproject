<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbname = "test";

function conn() {
    global $hostname,$username,$password,$dbname;
    $opts     = array(
        PDO::ATTR_PERSISTENT         => true, // use existing connection if exists, otherwise try to connect
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // by default fetch results as associative array
    );
    $conn = new PDO("mysql:host=$hostname", $username, $password,$opts);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $conn;
}
function usedb() {
    global $dbname;
    conn()->exec("use $dbname");
}
function resetdb() {
    global $dbname;
    $conn = conn();
    $conn->exec("
    DROP DATABASE IF EXISTS $dbname;
    CREATE DATABASE $dbname;
    USE $dbname;
    CREATE TABLE users(
        id int PRIMARY KEY AUTO_INCREMENT,
        username varchar(32),
        password varchar(32),
        fname   varchar(32),
        sname   varchar(32),
        age     int,
        mnumber int
    );
    ");
    //$stmt = $conn->prepare("");
}
function insertUser($fname,$sname,$age,$mnumber){
    $conn = conn();
    $stmt = $conn->prepare("INSERT INTO users (fname,sname,age,mnumber)
    VALUES (:fname,:sname,:age,:mnumber)");
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':sname', $sname);
    $stmt->bindParam(':age', $age);
    $stmt->bindParam(':mnumber', $mnumber);
    $stmt->execute();
}
?>