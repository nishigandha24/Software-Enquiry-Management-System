<?php
error_reporting(0);
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<?php
include( "header.php");
if ($_SESSION["uname"] == "admin") {
    include( "navbar_admin.php");
} else {
    include( "navbar_user.php");
}

$db = $_SESSION["uname"];
$conn = new mysqli('localhost', "root", "", $db) or die("ERROR:" . mysqli_connect_error());

$query = "select * from register";
$data = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($data);
$fn = $row['fname'];
$ln = $row['lname'];
$des = $row['des'];
$gender = $row['gender'];
$uname = $row['username'];
$pass = $row['password'];
$cpass = $row['password'];
$email = $row['email'];
$phone = $row['mobile'];
$add = $row['address'];
$img = $row['img'];
?>

<div class="main-panel">   
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Profile</h4>
                        <form class="form-sample" method="post" action="" enctype="multipart/form-data">
                            <p class="card-description">
                                Personal info
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="fname" value="<?php echo $fn; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="lname" value="<?php echo $ln; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Designation</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="des" value="<?php echo $des; ?>" placeholder="Enter Designation "/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label" >Gender</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="gender">
                                                <?php
                                                if ($gender == 'Male') {
                                                    ?>
                                                    <option selected="">Male</option>
                                                    <option>Female</option>
                                                    <?php
                                                } else {
                                                    ?>
                                                    <option>Male</option>
                                                    <option selected="">Female</option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">User Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="uname" value="<?php echo $uname; ?>" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" id="pass" class="form-control" name="pass" value="<?php echo $pass; ?>" />
                                            <span toggle="#pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Confirm Password</label>
                                        <div class="col-sm-9">
                                            <input type="password" id="cpass" name="cpass" value="<?php echo $cpass; ?>" class="form-control" />
                                            <span toggle="#cpass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Email</label>
                                        <div class="col-sm-9">
                                            <input type="email" class="form-control" name="email" value="<?php echo $email; ?>" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Contact Number</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" name="mobile" value="<?php echo $phone; ?>"  maxlength="10"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Address</label>
                                        <div class="col-sm-9">
                                            <textarea rows = "4" cols = "50" name="address" class="form-control" ><?php echo $add; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Your Image</label>
                                        <div class="col-sm-9">
                                            <input type='file' name="image" id="image" accept="image/*" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="submit" id="submit" class="btn btn-primary mr-2" value="submit" onclick="valid()" name="submit">
                            <button class="btn btn-light">Cancel</button>
                        </form>
                        <?php
                        if (isset($_POST['submit'])) {
                            $fname = (isset($_POST['fname']) ? $_POST['fname'] : '');
                            $lname = (isset($_POST['lname']) ? $_POST['lname'] : '');
                            $des = (isset($_POST['des']) ? $_POST['des'] : '');
                            $gender = (isset($_POST['gender']) ? $_POST['gender'] : '');
                            $uname = (isset($_POST['uname']) ? $_POST['uname'] : '');
                            $pass = (isset($_POST['pass']) ? $_POST['pass'] : '');
                            $email = (isset($_POST['email']) ? $_POST['email'] : '');
                            $phone = (isset($_POST['mobile']) ? $_POST['mobile'] : '');
                            $add = (isset($_POST['address']) ? $_POST['address'] : '');
                            $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

                            if ($fname != "" && $lname != "" && $des != "" && $gender != "" && $uname != "" && $pass != "" && $email != "" && $phone != "" && $add != "" && $file != "") {
                                if (mysqli_query($conn, "update register set fname='$fname',lname='$lname',des='$des',gender='$gender',img='$file',username='$uname',password='$pass',email='$email',mobile='$phone',address='$add' where username='$db';")) {

                                    $conn1 = new mysqli('localhost', "root", "", $db) or die("ERROR:" . mysqli_connect_error());

                                    if (mysqli_query($conn1, "update userlogin set name='$fname',profile='$des',username='$uname',password='$pass' where username='$db';")) {
                                        ?>
                                        <script>
                                            alert("Data Updated Successfully!!!!");
                                        </script>
                                        <?php
                                    } 
                                }
                                else {
                                    ?>
                                    <script>
                                        alert("Data Not Updated Successfully!!!!");
                                    </script>
                                    <?php
                                }
                            } else {
                                ?>
                                <script>
                                    alert("All fields are required!!!!");
                                </script>
                                <?php
                            }
                        }
                        ?>
                        <?php include_once( "footer.php"); ?>
                        <script type="text/javascript">
                            function valid() {
                                var pass1 = document.getElementById("pass").value;
                                var pass2 = document.getElementById("cpass").value;
                                if (pass1 !== pass2)
                                {
                                    alert("Password Not Matched");
                                    return false;
                                }
                                return true;
                            }
                        </script>

                        <script type="text/javascript">
                            $(".toggle-password").click(function () {
                                $(this).toggleClass("fa-eye fa-eye-slash");
                                var input = $($(this).attr("toggle"));
                                if (input.attr("type") == "password") {
                                    input.attr("type", "text");
                                } else {
                                    input.attr("type", "password");
                                }
                            });
                        </script>

                        <script type="text/javascript">
                            function check() {
                                var mob = document.getElementById('mobile');
                                if (mobile.value.length == 10) {
                                    return true;
                                } else {
                                    alert('Please put 10  digit mobile number');
                                    return  false;
                                }
                            }</script>

                            <script>
                                $(document).ready(function () {
                                    $('#submit').click(function () {
                                        var image_name = $('#image').val();
                                        if (image_name == '')
                                        {
                                            alert("Please Select Image");
                                            return false;
                                        } else
                                        {
                                            var extension = $('#image').val().split('.').pop().toLowerCase();
                                            if (jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1)
                                            {
                                                $('#image').val('');
                                                return false;
                                            }
                                        }
                                    });
                                });
                            </script> 

                        </body>
                        </html>