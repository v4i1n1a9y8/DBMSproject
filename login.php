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

  if(isset($_POST["register"]))
  {
    $stmt=$conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute([$_POST["username"]]);
    $count = $stmt->fetchAll(PDO::FETCH_ASSOC);
    if(count($count)==0){
        addUser($_POST["username"],$_POST["password"]);
        $message = "<label>Registered successfully</label>";
    }
    else{
    $message = "<label>Username already exists</label>";
    }

  }

?>
<html>
  <head>
  
  <?php include("modules/head.php")?>
  
  </head>
  <body>

<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                <a class="navbar-brand" href="#">ChatNow</a>
            </div>
</nav>
<div class="container">Welcome to ChatNow!</div>

<div class="container">

 <form method="post">
  <p ><?php echo $message; ?></p>
  <div class="form-group">
    <label for="username">Username:</label>
       <input type="text" class="form-control" name="username" required />
  </div>
  <div class="form-group">
    <label for="pwd">Password:</label>
      <input type="password" class="form-control" name="password" required />
  </div>
  <input type="submit" class="btn btn-default" name="login" value="Login" />
  <input type="submit" class="btn btn-default" name="register" value="Register" />
</form> 

</div>
  </body>
</html>