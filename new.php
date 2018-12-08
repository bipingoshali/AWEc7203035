<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
    <link href="assets/css/main-theme-css.css" rel="stylesheet" type="text/css">
    <link href="assets/css/simplePagination.css" rel="stylesheet" type="text/css">
    <script src="assets/js/jquery.min.js" type="text/javascript"></script>
    <script src="assets/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="assets/js/jquery.simplePagination.js" type="text/javascript"></script>
</head>
<body>
<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <a class="navbar-brand" href="index.php">Welcome</a>
        </div>
    </div>
</nav>

<div class="container">
    <div class="row main-body">
        <div class="col-md-3 col-sm-3">
            <div class="list-group list-group-css">
                <a href="index.php" class="list-group-item"><span
                            class="glyphicon glyphicon-pencil text-primary"></span> Home</a>
            </div>
            <?php
            if (!isset($_SESSION['user_id'])) {
                echo '
                      <div class="list-group list-group-css">
                          <a href="login.php" class="list-group-item"><span class="glyphicon glyphicon-log-in text-primary"></span> Log in</a>
                      </div>
                      <div class="list-group list-group-css">
                          <a href="new-account.php" class="list-group-item"><span class="glyphicon glyphicon-user text-primary"></span> Create new account</a>
                      </div>
                      ';
            } else {
                if ($_SESSION['user_id'] == "admin") {
                    echo '
                        <div class="list-group list-group-css">
                            <a href="admin.php" class="list-group-item"><span class="glyphicon glyphicon-book text-primary"></span> Books</a>
                        </div>
                        <div class="list-group list-group-css">
                            <a href="user.php" class="list-group-item"><span class="glyphicon glyphicon-user text-primary"></span> User</a>
                        </div>
                        <div class="list-group list-group-css">
                            <a href="logout.php" class="list-group-item"><span class="glyphicon glyphicon-log-out text-primary"></span> Log Out</a>
                        </div>
                    ';
                } else {
                    echo '
                        <div class="list-group list-group-css">
                            <a href="about-us.php" class="list-group-item"><span class="glyphicon glyphicon-object-align-bottom text-primary"></span> About Us</a>
                        </div>
                        <div class="list-group list-group-css">
                            <a href="#demo" class="list-group-item" data-toggle="collapse"><span class="glyphicon glyphicon-user text-primary"></span>My Account</a>
                            <div id="demo" class="collapse">
                                <a href="my-account.php" class="list-group-item"> Edit Profile</a>
                                <a href="change_password.php" class="list-group-item"> Change Password</a>
                            </div>
                        </div>
                        <div class="list-group list-group-css">
                            <a href="logout.php" class="list-group-item"><span class="glyphicon glyphicon-log-out text-primary"></span> Log Out</a>
                        </div>
                    ';
                }
            }
            ?>
        </div> <!-- /.list-group list-group-css -->
        <div class="col-sm-9 col-md-9">

<!--            //start-->

            <div class="well">
                <h1>About Us</h1>
            </div>

<!--            //end-->

        </div> <!-- /.col-sm-9 col-md-9 -->
    </div> <!-- /.row main-body -->
    <hr>
    <p>Copyright © 2018 - All Rights Reserved.</p>
</div> <!-- /.container -->
</body>
</html>