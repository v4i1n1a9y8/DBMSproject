<?php //REDIRECT TO LOGIN PAGE
    include('database/dbconnect.php');

    session_start();

    if(!isset($_SESSION['user_id']))
    {
    header('location:login.php');
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>
            Home
        </title>

        <?php include("modules/head.php")?>
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
    <?php include("modules/navigation.php")?>

<div class="container-fluid">



    <div class="container">

        



        
        <div class="row">
                <div class="col-sm-8">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#local">Local</a></li>
                            <li><a data-toggle="tab" href="#global">Global</a></li>
                            <li><a data-toggle="tab" href="#messages" id="message-tab">Messages</a></li>
                        </ul>
                        </div>
                        
                        <div class="panel-body">

                            <div class="tab-content">
                                <?php include "panels/local.php"?>
                                <?php include "panels/global.php"?>
                                <?php include "panels/messages.php"?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-2 ">
                    <div class="panel panel-info">
                    <div class="panel-heading">Users</div>
                    <?php include "panels/userlist.php"?>
                    </div>
                </div>
            </div>
    </div>
</div>

    </body>
</html>




