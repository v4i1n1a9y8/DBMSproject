<?php

$hostname = "localhost";
$username = "root";
$password = "admin@123";
$dbname = "test";
 
$conn = new PDO("mysql:host=$hostname;", $username, $password);
$conn->exec("use $dbname");

function resetdb() {
global $conn,$dbname;
$conn->exec("
DROP DATABASE IF EXISTS $dbname;
CREATE DATABASE $dbname;
USE $dbname;
CREATE TABLE users(
    user_id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(32) ,
    password varchar(200)
);
CREATE TABLE messages(
    message_id int PRIMARY KEY AUTO_INCREMENT,
    user_id_1 int,
    user_id_2 int,
    message text,
    public int,
    tstamp int
);
CREATE TABLE friends(
    friends_id int PRIMARY KEY AUTO_INCREMENT,
    user_id_1 int,
    user_id_2 int
);
CREATE TABLE friend_requests (
    friend_request_id int PRIMARY KEY AUTO_INCREMENT,
    user_id_1 int,
    user_id_2 int
);
CREATE TABLE last_active (
    user_id int,
    tstamp int
);
");
$stmt=$conn->prepare("INSERT INTO users (username,password) VALUES (?,?)");

addUser("vinay","password");
addUser("rakesh","password");
addUser("prasad","password");
//addMessage(1,NULL,"hi");
addMessage(3,NULL,"hello");
addMessage(2,NULL,"how ");
addMessage(2,NULL,"not a public message",0);
addMessage(3,NULL,"are ");
addMessage(2,NULL,"you");
addMessage(2,1,"hey");
addMessage(1,2,"hii");
friendRequest(1,2);
friendAccept(1,2);
}

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
    $stmt=$conn->prepare("INSERT INTO last_active VALUES (?,NOW()");
    $stmt->execute([$conn->lastInsertId()]);
}
function getUsername($user_id){
    global $conn;
    $stmt=$conn->prepare("SELECT username FROM users where user_id=?");
    $stmt->execute([$user_id]);
    return $stmt->fetch()[0];
    //return count($stmt->fetch(PDO::FETCH_ASSOC));
}
function addMessage($user1,$user2,$msg,$public=1){
    global $conn;
    $stmt=$conn->prepare("INSERT INTO messages (user_id_1,user_id_2,message,public,tstamp) VALUES (?,?,?,?,UNIX_TIMESTAMP())");
    $stmt->execute([$user1,$user2,$msg,$public]);
}

////FRIENDS
function friendRequest($user1,$user2){
    if($user1==$user2){
        return;
    }
    global $conn;
    $stmt=$conn->prepare("SELECT * FROM friends WHERE user_id_1=? and user_id_2=?");
    $stmt->execute([$user1,$user2]);
    $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(count($count)>0){
        return;
    }

    $stmt=$conn->prepare("SELECT * FROM friend_requests WHERE user_id_1=? and user_id_2=?");
    $stmt->execute([$user1,$user2]);
    $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(count($count)>0){
        return;
    }

    $stmt=$conn->prepare("INSERT INTO friend_requests (user_id_1,user_id_2) VALUES (?,?)");
    $stmt->execute([$user1,$user2]);
}
function friendAccept($fr_id){
    global $conn;
    $stmt=$conn->prepare("SELECT user_id_1,user_id_2 FROM friend_requests WHERE friend_request_id=?");
    $stmt->execute([$fr_id]); 
    $users = $stmt->fetch();

    $stmt=$conn->prepare("INSERT INTO friends (user_id_1,user_id_2) VALUES(?,?)");
    $stmt->execute([$users[0],$users[1]]);
    $stmt=$conn->prepare("DELETE FROM friend_requests WHERE friend_request_id=?");
    $stmt->execute([$fr_id]);
}
function getReqID($user1,$user2){
    global $conn;
    $stmt=$conn->prepare("SELECT friend_request_id FROM friend_requests WHERE user_id_1=? and user_id_2=?");
    $stmt->execute([$user1,$user2]);
    $count = $stmt->fetch();
    return $count[0];
}
function friendRemove($f_id){
    global $conn;
    $stmt=$conn->prepare("DELETE FROM friends WHERE friends_id=?");
    $stmt->execute([$f_id]);
}
function isRequested($user1,$user2){
    global $conn;
    $stmt=$conn->prepare("SELECT * FROM friend_requests WHERE user_id_1=? and user_id_2=?");
    $stmt->execute([$user1,$user2]);
    $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(count($count)>0){
        return true;
    }
    return false;

}
function isFriend($user1,$user2){
    global $conn;
    $stmt=$conn->prepare("SELECT friends_id FROM friends 
    where 
    (user_id_1=? and user_id_2=?) or (user_id_2=? and user_id_1=?)");
    $stmt->execute([$user1,$user2,$user1,$user2]);
    $count = count($stmt->fetchAll(PDO::FETCH_ASSOC));
    if($count>0){
        return true;
    }
    return false;
}
/////

function isPublic($msgid){
    global $conn;
    $stmt=$conn->prepare("SELECT public FROM messages 
    where 
    message_id=?");
    $stmt->execute([$msgid]);
    $count = $stmt->fetch()[0];
    if($count>0){
        return true;
    }
    return false;
}

function active($u_id){
    global $conn;
    $stmt=$conn->prepare("UPDATE last_active WHERE user_id=?");
    $stmt->execute([$u_id]);
}

function getOnline($u_id){
    global $conn;

    $stmt = $conn->prepare("SELECT tstamp FROM last_active WHERE user_id=?");
    $stmt->execute([$u_id]);
    $time = $stmt->fetch()[0];
    $ctime = time()- 5 * 60 * 1000;
    if ($time>$ctime){
        return true;
    }
    return false;
}
?>