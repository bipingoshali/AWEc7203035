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

<?php
require "includes/classes/user.php";
$user = new user();
$fetchUserDetails = array(array(
    "user_name"=>"",
    "date_of_birth"=>"",
    "email"=>"",
    "address_line_1"=>"",
    "address_line_2"=>"",
    "gender"=>""
));
$fetchUserDetails = $user->selectUserById($_SESSION['user_id']);
?>

    <div class="well">

        <?php
        require "includes/functions/sanitise.php";
        $sanitise = new sanitise();
        if(isset($_POST['edit_submit_btn'])){
            $user->setUserName($sanitise->test_input($_POST['name']));
            $user->setAddressLine1($sanitise->test_input($_POST['address_line_1']));
            $user->setAddressLine2($sanitise->test_input($_POST['address_line_2']));
            $user->setGender($sanitise->test_input($_POST['gender']));
            $user->setDateOfBirth($sanitise->test_input($_POST['date_of_birth']));

            $user->editUserDetails($_SESSION['user_id']);
            $fetchUserDetails = $user->selectUserById($_SESSION['user_id']);
        }
        ?>

        <h1>My Account</h1>
        <h3>Edit Profile</h3>
        <?php
        if($_SESSION['register_type']=='gmail'){
            echo '<h5><span class="label label-warning">Please fill up your details</span></h5>';
        }
        ?>

        <hr>
        <form method="post">
            <div class="row">

                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" placeholder="Name" class="form-control" tabindex="1" name="name" value="<?php echo $fetchUserDetails[0]['user_name']?>">
                    </div>
                    <div class="form-group">
                        <label>Address Line 1</label>
                        <input type="text" placeholder="Address Line 1" class="form-control" tabindex="3" name="address_line_1" value="<?php echo $fetchUserDetails[0]['address_line_1']?>">
                    </div>
                    <div class="form-group">
                        <label>Select Gender</label>
                        <select class="form-control" tabindex="5" name="gender">
                            <option value="<?php echo $fetchUserDetails[0]['gender']?>"><?php echo $fetchUserDetails[0]['gender']?></option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>

                <div class="col-sm-6 col-md-6">
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" placeholder="Email" class="form-control" tabindex="2" name="email" value="<?php echo $fetchUserDetails[0]['email']?>" readonly="readonly">
                    </div>
                    <div class="form-group">
                        <label>Address Line 2</label>
                        <input type="text" placeholder="Address Line 2" class="form-control" tabindex="4" name="address_line_2" value="<?php echo $fetchUserDetails[0]['address_line_2']?>">
                    </div>
                    <div class="form-group">
                        <label>Date of Birth</label>
                        <input type="date" class="form-control" tabindex="6" name="date_of_birth" value="<?php echo $fetchUserDetails[0]['date_of_birth']?>">
                    </div>
                </div>

            </div>
            <div class="form-group">
                <button class="btn btn-success" type="submit" name="edit_submit_btn"><span class="glyphicon glyphicon-send"></span>    Edit</button>
            </div>
        </form>


    </div> <!-- /.well -->

<?php
require "includes/footer.php";
?>