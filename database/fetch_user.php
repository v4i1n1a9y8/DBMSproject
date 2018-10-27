<?php
include('dbconnect.php');

session_start();

$query = "
SELECT * FROM users
    WHERE user_id !='".$_SESSION["user_id"]."'
";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$output = " ";
$a=1;
foreach($result as $row){
    $friend = "";
    if(!isFriend($row["user_id"],$_SESSION["user_id"])){
        continue;
    }
    $output .= '
    <div class="panel-body users" id="user'.$a.'"  onclick="fetch_messages('.$row['user_id'].','."'".$row['username']."'".')">'.$row['username'].' '.$friend.'</div>
    ';
    $a+=1;
}

echo $output;

?>