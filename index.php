<html>
<head>
<style>
table{ 
    border:2px solid red; 
    border-radius: 16px;
    border-spacing: 0;
    width:20%; 
} 
td { 
    height:40px; 
} 
th { 
    border-top-left-radius: 15px;
    border-top-right-radius: 15px;
    background-color:red; 
    color:black; 
}
</style>
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


<table>
<tr><th>loadgagagdagl</th></tr>
<tr><td>hiadgadgdagda</td></tr>
</table>

</body>


</html>