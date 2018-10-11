<?php //LOGIN
  include("database/dbconnect.php");

  session_start();

  $message = '';

  if(isset($_SESSION['user_id']))
  {
  header('location:index.php');
  }

  if(isset($_POST["login"]))
  {
  $query = "
  SELECT * FROM users WHERE username = ?
  ";
  $statement = $conn->prepare($query);
  $statement->execute([$_POST["username"]]);
    $count = $statement->rowCount();
    if($count > 0)
  {
    $result = $statement->fetchAll();
      foreach($result as $row)
      {
        if(password_verify($_POST["password"], $row["password"]))
        {
          $_SESSION['user_id'] = $row['user_id'];
          $_SESSION['username'] = $row['username'];
          header("location:index.php");
        }
        else
        {
        $message = "<label>Wrong Password</label>";
        }
      }
  }
  else
  {
    $message = "<label>Wrong Username</label>";
  }
  }
?>
<html>
  <head></head>
  <body>
  <form method="post">
      <p ><?php echo $message; ?></p>
      <div >
       <label>Enter Username</label>
       <input type="text" name="username" required />
      </div>
      <div>
       <label>Enter Password</label>
       <input type="password" name="password" required />
      </div>
      <div>
       <input type="submit" name="login" value="Login" />
      </div>
    </form>
  </body>
</html>