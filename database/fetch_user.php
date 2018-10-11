<?php
include('dbconnect.php');

session_start();

try {
    $query = "
    SELECT * FROM users
     WHERE user_id !='".$_SESSION["user_id"]."'
    ";
    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->fetchAll();

    $output = "
    <table>
    <tr><th>Other users</th></tr>
    ";

    foreach($result as $row){
        $output .= '
        <tr>
        <td>'.$row['username'].'</td>
        </tr>
        ';
    }

    $output .="</table>";
    echo $output;
}catch (PDOException $e) {
    echo $e->getMessage();
}
?>