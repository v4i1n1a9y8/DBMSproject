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
        $float = " ";
        if($row["user_id_1"]==$_SESSION["user_id"]){
            $float = 'text-align: right;';
        }
        $output .= '
        <div class="panel panel-default">
            <div class="panel-heading" style="'.$float.'font-weight:bold;" >'.getUsername($row['user_id_1']).'</div>
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