<?php
require "includes/header.php";
?>

<?php
require "includes/side-nav.php";
?>

<?php
require "includes/functions/session.php";
$session = new session();
$session->userPageSession();
?>

    <div class="well">
        <h1>About Us</h1>
    </div>

<?php
require "includes/footer.php";
?>