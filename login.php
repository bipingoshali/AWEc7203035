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
<!--                <a href="--><?//= 'https://accounts.google.com/o/oauth2/v2/auth?scope=' . urlencode('https://www.googleapis.com/auth/userinfo.profile https://www.googleapis.com/auth/userinfo.email https://www.googleapis.com/auth/plus.me') . '&redirect_uri=' . urlencode(CLIENT_REDIRECT_URL) . '&response_type=code&client_id=' . CLIENT_ID . '&access_type=online' ?><!--">Login with Google</a>-->
            </div>
        </form>
    </div> <!-- /.well -->


<?php
require "includes/footer.php";
?>