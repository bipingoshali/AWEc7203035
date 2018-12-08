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
        $alert = new alert();
            //captcha php code
            $condition=0;
            if(isset($_POST['register_submit_btn'])){
                if($_POST['name']=="" || $_POST['email']=="" || $_POST['address_line_1']=="" || $_POST['address_line_2']=="" || $_POST['gender']=="" || $_POST['date_of_birth']=="" || $_POST['password']=="" || $_POST['confirm_password']=="" || $_POST['recaptcha']==""){
                    $alert->alert_danger('Please fill up all the fields');
                }else{
                    if ($_POST['recaptcha']=='modern-day') {
                        $condition=1;
                    }elseif ($_POST['recaptcha']=='trieste') {
                        $condition=2;
                    }elseif ($_POST['recaptcha']==='morning') {
                        $condition=3;
                    }elseif ($_POST['recaptcha']=='overlooks') {
                        $condition=4;
                    }elseif ($_POST['recaptcha']=='abharge') {
                        $condition=5;
                    }elseif ($_POST['recaptcha']=='benefits') {
                        $condition=6;
                    }
                    if($condition==$_SESSION['recaptchaSession']) {
                        $user->setUserName($_POST['name']);
                        $user->setEmail($_POST['email']);
                        $user->setAddressLine1($_POST['address_line_1']);
                        $user->setAddressLine2($_POST['address_line_2']);
                        $user->setGender($_POST['gender']);
                        $user->setDateOfBirth($_POST['date_of_birth']);
                        $user->setPassword($_POST['password']);
                        $user->setConfirmPassword($_POST['confirm_password']);

                        if($user->register_user()){
                            $alert->alert_success('Congratulation! You can <a href="login.php">login here</a>');
                            $_POST['name']="";
                            $_POST['email']="";
                            $_POST['address_line_1']="";
                            $_POST['address_line_2']="";
                        }
                    }
                    else{
                        $alert->alert_danger('Captcha does not match. Please Try Again!');
                    }
                }
            }
//            code finish

        ?>
        <h3>Create new account</h3>
        <!--register form-->
        <form method="post">
            <div class="row">

                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" value='<?php echo isset($_POST['name']) ? $_POST['name'] : $_POST['name']=""; ?>' placeholder="Name" class="form-control" tabindex="1" name="name">
                    </div>
                    <div class="form-group">
                        <label>Address Line 1</label>
                        <input type="text" value='<?php echo isset($_POST['address_line_1']) ? $_POST['address_line_1'] : $_POST['address_line_1']=""; ?>' placeholder="Address Line 1" class="form-control" tabindex="3" name="address_line_1">
                    </div>
                    <div class="form-group">
                        <label>Select Gender</label>
                        <select class="form-control" tabindex="5" name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" placeholder="Password" class="form-control" tabindex="7" name="password" id="password">
                    </div>
                    <?php $image=rand(1,6); $_SESSION['recaptchaSession']=$image;echo '<img src="assets/images/'.$image.'.jpg" height="30" alt="captcha" />'; ?>
                    <div class="form-group">
                        <label>Captcha</label>
                        <input type="text" placeholder="captcha" class="form-control" tabindex="9" name="recaptcha">
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" placeholder="Email" class="form-control" tabindex="2" value='<?php echo isset($_POST['email']) ? $_POST['email'] : $_POST['email']=""; ?>' name="email" id="email">
                        <span id="email_message"></span>
                    </div>
                    <div class="form-group">
                        <label>Address Line 2</label>
                        <input type="text" placeholder="Address Line 2" class="form-control" tabindex="4" value='<?php echo isset($_POST['address_line_2']) ? $_POST['address_line_2'] : $_POST['address_line_2']=""; ?>' name="address_line_2">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" tabindex="6" name="date_of_birth">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" placeholder="Confirm Password" class="form-control" tabindex="8" name="confirm_password" id="confirm_password">
                        <span id="password_message"></span>
                    </div>
                </div>

            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit" name="register_submit_btn" tabindex="10" id="register_submit_btn"><span class="glyphicon glyphicon-send"></span>    Submit</button>
            </div>
        </form>
        <small><strong>Note : </strong>Password must contain minimum eight characters,
            at least one uppercase letter,
            one lowercase letter,
            one number and one special character.</small><br>
    </div> <!-- /.well -->

<script>
    $(document).ready(function () {
        $('#email').keyup(function () {
            var email = $(this).val();
            $.post("email_availability.php",{email:email},function (data) {
               if(data.status==true){
                   $('#email_message').attr('class','label label-success');
                   $("#register_submit_btn").removeAttr("disabled");
               }else{
                   $('#email_message').attr('class','label label-danger');
                   $("#register_submit_btn").attr("disabled","disabled");
               }
                $('#email_message').html(data.message);
            },'json');
        });

        $("#password").keyup(function(){
            if(/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/.test($(this).val()) && $(this).val().trim()!==""){
                $(this).css("border-color", "green");
                $("#register_submit_btn").removeAttr("disabled");
            } else {
                $(this).css("border-color", "red");
                $("#register_submit_btn").attr("disabled","disabled");
            }
        });

        $("#confirm_password").keyup(function(){
            var password = $("#password").val();
            var confirm_password = $(this).val();
            if(password===confirm_password){
                $(this).css("border-color", "green");
                $("#register_submit_btn").removeAttr("disabled");
                $('#password_message').html("");
            }else{
                $(this).css("border-color", "red");
                $('#password_message').attr('class','label label-danger');
                $("#register_submit_btn").attr("disabled","disabled");
                $('#password_message').html("Password does not match.");
            }
        });
    });
</script>

<?php
require "includes/footer.php";
?>
