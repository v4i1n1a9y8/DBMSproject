<?php
include('dbconnect.php');

session_start();

$query = "
SELECT * FROM users
    WHERE user_id !='".$_SESSION["user_id"]."'
    ORDER BY username ASC
";
$stmt = $conn->prepare($query);
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$output = "
<table>
  <thead>
    <tr>
      <th>Username</th>
      <th></th>
    </tr>
  </thead>
  <tbody id='myTable'>

";
$a=1;
foreach($result as $row){
    $output .= '
    <tr>
      <td>'.$row["username"].'</td>
    ';

    if(isFriend($row["user_id"],$_SESSION["user_id"])){
        $output .= '
            <td></td>
            </tr>
        ';
    }
    else if(isRequested($row["user_id"],$_SESSION["user_id"]))
    {
        $output .= '
            <td class="users" style="background-color:green;color:white" onclick="
            acceptfriend('.$row["user_id"].')
            "> Accept Friend</td>
            </tr>
            ';
    }
    else if(isRequested($_SESSION["user_id"],$row["user_id"]))
    {
        $output .= '
            <td class="users" style="background-color:blue;color:white" onclick="
            acceptfriend('.$row["user_id"].')
            "> Pending</td>
            </tr>
            ';
    }
    else
    {
        $output .= '
            <td class="users" style="background-color:red;color:white" onclick="
            addfriend('.$row["user_id"].')
            "> Add Friend</td>
            </tr>
            ';
    }
    $a+=1;
}
$output.='
    
</tbody>
</table>';

echo $output;

?>