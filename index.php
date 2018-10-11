<html>
<head>
</head>
<body>
hmmm
<?php require("database/config.php"); 
try{
    $conn = conn();
    resetdb($conn);
    insertUser($conn,"a@b.com","password","user1","test",NULL,NULL);
    insertUser($conn,"b@a.com","password","user2","test",NULL,NULL);
    foreach (getUsers($conn) as $user) {
        foreach ($user as $key=>$value)
            echo $key."=>".$value."<br>";
    }
    echo "lol";
}
catch(PDOException $e) {
    echo "badluck";
}
?>

</body>
</html>