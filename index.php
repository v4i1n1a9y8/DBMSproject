<html>
<head>
</head>
<body>
<?php require("database/config.php"); ?>


<?php
try{
$conn = conn();
resetdb();
insertUser("Vinay","Patil",NULL,NULL);
echo "lol";
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
</body>


</html>