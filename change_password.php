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

    <?php
    require "includes/functions/sanitise.php";
    require "includes/classes/user.php";
    $user = new user();
    $sanitise = new sanitise();
    $alert = new alert();
    if(isset($_POST['change_password_btn'])){
        if($_POST['old_password']=="" or $_POST['new_password']=="" or $_POST['confirm_password']==""){
            $alert->alert_danger('Please fill up all the fields.');
        }else{
            $user->setPassword($sanitise->test_input($_POST['old_password']));
            $user->setNewPassword($sanitise->test_input($_POST['new_password']));
            $user->changePassword($_SESSION['user_id']);
        }

    }
    ?>

    <h1>My Account</h1>
    <h3>Change Password</h3>
    <hr>

    <form method="post">
        <div class="form-group">
            <label>Old Password</label>
            <input type="password" class="form-control" placeholder="Old Password" name="old_password" tabindex="1">
        </div>
        <div class="form-group">
            <label>New Password</label>
            <input type="password" class="form-control" placeholder="New Password" name="new_password" tabindex="2" id="new_password">
        </div>
        <div class="form-group">
            <label>Confirm Password</label>
            <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" tabindex="3" id="confirm_password">
            <span id="password_message"></span>
        </div>
        <div class="form-group">
        <?php
        if($_SESSION['register_type']=='normal'){
            echo '<button class="btn btn-success" type="submit" name="change_password_btn" id="change_password_btn"><span class="glyphicon glyphicon-send"></span>    Change</button>';
        }else{
            echo '<span class="label label-danger">Your account is registered with your gmail account. You cannot change password here!</span><br>';
            echo '<button style="margin-top:10px;" class="btn btn-success" disabled="disabled" type="submit" name="change_password_btn" id="change_password_btn"><span class="glyphicon glyphicon-send"></span>    Change</button>';
        }
        ?>

        </div>
    </form>

    <small><strong>Note : </strong>Password must contain minimum eight characters,
        at least one uppercase letter,
        one lowercase letter,
        one number and one special character.</small><br>

</div> <!-- /.well -->

<script type="text/javascript">
    $(document).ready(function () {

        $("#new_password").keyup(function(){
            if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test($(this).val()) && $(this).val().trim()!==""){
                $(this).css("border-color", "green");
                $("#change_password_btn").removeAttr("disabled");
            } else {
                $(this).css("border-color", "red");
                $("#change_password_btn").attr("disabled","disabled");
            }
        });

        $("#confirm_password").keyup(function(){
            var password = $("#new_password").val();
            var confirm_password = $(this).val();
            if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test($(this).val()) && $(this).val().trim()!==""){
                if(password===confirm_password){
                    $(this).css("border-color", "green");
                    $("#change_password_btn").removeAttr("disabled");
                    $('#password_message').html("");
                }else{
                    $(this).css("border-color", "red");
                    $('#password_message').attr('class','label label-danger');
                    $("#change_password_btn").attr("disabled","disabled");
                    $('#password_message').html("Password does not match.");
                }
            }else{
                $(this).css("border-color", "red");
                $("#change_password_btn").attr("disabled","disabled");
            }
        });
    });
</script>


<?php
require "includes/footer.php";
?>

