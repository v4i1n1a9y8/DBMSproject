<nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                <a class="navbar-brand" href="#">WebSiteName</a>
                </div>
                <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="#">Page 1</a></li>
                <li><a href="#">Page 2</a></li>
                <li><a href="#">Page 3</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                <li>Hi - <?php echo $_SESSION['username']; ?> - <a href="logout.php"><span class="glyphicon glyphicon-log-out"></span>Logout</a></li>
                </ul>
            </div>
</nav>