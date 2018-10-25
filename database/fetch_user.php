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
$a=0;
foreach($result as $row){
    $output .= '
    <div class="panel-body users" id="user'.$a.'"  onclick="fetch_messages('.$a.')">'.$row['username'].'</div>
    ';
    $a+=1;
}

$output .="</table>";
echo $output;

?>