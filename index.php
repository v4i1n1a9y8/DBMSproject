<html>
<head>
</head>
<body>
<?php require("database/config.php"); ?>


<?php
try{
$conn = conn();
resetdb();
echo "lol";
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
</body>


</html>