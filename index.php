<html>
<head>
</head>
<body>
hmmm
<?php require("database/config.php"); 
try{
    $conn = conn();
    resetdb($conn);
    insertUser($conn,"a@b.com","afgeqfg","afg","qft",NULL,4);
    sendMsg($conn,0,NULL,"hellooooooooooo");
    echo "lol";
}
catch(PDOException $e) {
    echo "badluck";
}
?>

</body>
</html>