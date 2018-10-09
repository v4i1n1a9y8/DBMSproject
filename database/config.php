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
    $conn = new PDO("mysql:host=$hostname", $username, $password);
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
    
    ");
    //$stmt = $conn->prepare("");
}

?>