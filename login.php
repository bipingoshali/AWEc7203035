<?php
require "includes/header.php";
?>

<?php
require "includes/side-nav.php";
?>

<?php
require "includes/functions/session.php";
$session = new session();
$session->normalPageSession();
?>

    <div class="well">
        <?php
        require "includes/classes/user.php";
        $user = new user();
        if(isset($_POST['login_btn'])){
            $user->setEmail($_POST['email']);
            $user->setPassword($_POST['password']);
            $user->userLogin();
        }
        ?>
        <h2>Log in</h2>

        <!--login form-->
        <form method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="email" placeholder="Email" class="form-control" name="email" value='<?php echo isset($_POST['email']) ? $_POST['email'] : $_POST['email']=""; ?>'>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" placeholder="Password" class="form-control" name="password">
            </div>
            <div class="form-group">
                <button class="btn btn-success" name="login_btn" type="submit"><span class="glyphicon glyphicon-log-in"></span>    Log in</button>
            </div>
        </form>
    </div> <!-- /.well -->


<?php
require "includes/footer.php";
?>