<?php 
include('dbconnect.php');

session_start();

try {
    $query = "
    SELECT * FROM messages
     WHERE user_id_2 IS NULL
    ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $output = "";

    foreach($result as $row){
        $stmt = $conn->prepare("SELECT friends_id FROM friends WHERE ((user_id_1=?  and user_id_2=?) or (user_id_1=?  and user_id_2=?)) and accepted=1");
        $stmt->execute([$_SESSION["user_id"],$row["user_id_1"],$_SESSION["user_id"],$row["user_id_1"]]);
        $count = count($stmt->fetchAll(PDO::FETCH_ASSOC));
        if($count==0){
            continue;
        }
        $float = " ";
        if($row["user_id_1"]==$_SESSION["user_id"]){
            $float = 'style="text-align: right;"';
        }
        $output .= '
        <div class="panel panel-default">
            <div class="panel-heading" '.$float.' >'.getUsername($row['user_id_1']).'</div>
            <div class="panel-body">'.$row['message'].'</div>
        </div>
        ';
    }

    $output .="</table>";
    echo $output;
}catch (PDOException $e) {
    echo "lol";
}
?>