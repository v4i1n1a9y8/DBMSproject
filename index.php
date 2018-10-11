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
    sendMsg($conn,1,2,"LOOOL");
    sendMsg($conn,1,2,"LOOOL");
    sendMsg($conn,1,3,"LOOOL");
    echo "lol";
    echo json_encode(getMessages($conn));
}
catch(PDOException $e) {
    echo "badluck";
}
?>
<p id="demo"></p>

<script>
var a = <?php echo json_encode(getMessages($conn));?>;
if(a[0]["rid"]){
document.getElementById("demo").innerHTML = a[0]["sid"];
}
</script>


</body>
</html>