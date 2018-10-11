<?php //REDIRECT TO LOGIN PAGE
    include('database/dbconnect.php');

    session_start();

    if(!isset($_SESSION['user_id']))
    {
    header('location:login.php');
    }
?>

<html>
    <head>
        <title>
            Home
        </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script> 
        <style>
        table {
            border-collapse: collapse;
            }
        table,td {
            border: 2px solid black;
        }
        td,th {
            padding:10px;
        }
        </style>
    </head>
    <body>
        lol
        <p align="right">Hi - <?php echo $_SESSION['username']; ?> - <a href="logout.php">Logout</a></p>
    
    
        <div id="user_details"></div>
    </body>
</html>

<script>  //AJAX 
    $(document).ready(function(){

    fetch_user();

    function fetch_user()
    {
    $.ajax({
    url:"database/fetch_user.php",
    method:"POST",
    success:function(data){
        $('#user_details').html(data);
    }
    })
    }
    
    });  
</script>