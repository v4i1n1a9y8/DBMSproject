<?php 
include('dbconnect.php');
session_start();

$rid = $_POST["receiver"];

try {
    $user1 = $_SESSION["user_id"];
    $user2 = $rid;
    $query = "
    SELECT * FROM messages
     WHERE (user_id_1 = $user1 and user_id_2 = $user2) or (user_id_2 = $user1 and user_id_1 = $user2)
     ORDER BY tstamp DESC LIMIT 10
    ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $reversed=array();
    $output = "";

    foreach($result as $row){
        array_unshift($reversed,$row);
    }

    foreach($reversed as $row){
        if($row["user_id_1"]==$_SESSION["user_id"]){
            $output .= '
            <div class="panel-body"   style="text-align: right;">'.$row['message'].'</div>
            ';
        }
        else{
        $output .= '
        <div class="panel-heading">'.$row['message'].'</div>
        ';
        }
    }

    $output .="</table>";
    echo $output;
}catch (PDOException $e) {
    echo "lol";
}
?>