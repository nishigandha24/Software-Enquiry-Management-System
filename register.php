<?php
session_start();
error_reporting(0);
$conn = new mysqli("localhost", "root", "") or die("ERROR:" . mysqli_connect_error());
?>
<!DOCTYPE html>
<html lang="en">
<?php
include( "header.php");
include( "navbar_admin.php");
?>

<div class="main-panel">        
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Registration</h4>
                        <form class="form-sample" method="post" action="" enctype="multipart/form-data">
                            <p class="card-description">
                                Personal info
                            </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">First Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="fname" placeholder="Enter First Name" required=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Last Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="lname" placeholder="Enter Last Name " required=""/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Designation</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="des" placeholder="Enter Designation " required=""/>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Gender</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="gender">
                                               <option value="" disabled selected>Select Gender</option>
                                               <option>Male</option>
                                               <option>Female</option>
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
                                        <input type="text" class="form-control" name="uname" placeholder="Enter User name "required=""/>
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" id="pass" class="form-control" name="pass" placeholder="Enter Password" required=""/>
                                        <span toggle="#pass" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Confirm Password</label>
                                    <div class="col-sm-9">
                                        <input type="password" id="cpass" name="cpass" class="form-control" placeholder="Confirm Password" onfocusout="valid()" required=""/>
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
                                        <input type="email" class="form-control" name="email" placeholder="Enter Email" required=""/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Contact Number</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" name="mobile" placeholder="Enter Contact" maxlength="10" onfocusout="check()" required=""/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Address</label>
                                    <div class="col-sm-9">
                                        <textarea rows = "4" cols = "50" name="address" placeholder="Enter Address" class="form-control" required="" ></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Your Logo</label>
                                    <div class="col-sm-9">
                                        <input type='file' name="image" id="image" accept="image/*" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" id="submit" class="btn btn-primary mr-2" value="submit" name="submit">
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
                        $mobile = (isset($_POST['mobile']) ? $_POST['mobile'] : '');
                        $address = (isset($_POST['address']) ? $_POST['address'] : '');
                        $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"]));

                        if ($fname != "" && $lname != "" && $des != "" && $gender != "" && $uname != "" && $pass != "" && $email != "" && $mobile != "" && $address != "") {
                          $q = "create database if not exists $uname";
                          $res = mysqli_query($conn, $q);
                          $conn = new mysqli("localhost", "root", "", $uname) or die("ERROR:" . mysqli_connect_error());

                                    //create table register
                          $sql = "create table if not exists register(fname varchar(50),"
                          . "lname varchar(50),"
                          . "des varchar(50),"
                          . "gender varchar(20),"
                          . "username varchar(20),"
                          . "password varchar(20),"
                          . "email varchar(50),"
                          . "mobile bigint(10),"
                          . "address text,"
                          . "img longblob)";

                          if ($conn->query($sql) === TRUE) {

                          }

                                    //   create table enquiry
                          $sql1 = "create table if not exists enquiry(id int(50) auto_increment primary key,"
                          . "name varchar(50),"
                          . "mobile bigint(10),"
                          . "address text,"
                          . "enquiryfor varchar(20),"
                          . "status varchar(20),"
                          . "enquirydate date,"
                          . "nextfollowup date,"
                          . "assignto varchar(50),"
                          . "medium varchar(20))";


                          if ($conn->query($sql1) === TRUE) {

                          }


                          if ($uname == "admin" && $pass == "password") {
                                        //create table userlogin
                            $sql3 = "create table if not exists userlogin (id int(50) auto_increment primary key,"
                            . "name varchar(50),"
                            . "profile varchar(50),"
                            . "username varchar(20),"
                            . "password varchar(20),"
                            . "status int(1) default '1' )";

                            if ($conn->query($sql3) === TRUE) {

                            }

                                        //   create table enqall
                            $sql4 = "create table if not exists enqall(enqid int(50) auto_increment primary key,"
                            . "name varchar(50),"
                            . "mobile bigint(10),"
                            . "address text,"
                            . "enquiry varchar(20),"
                            . "status1 varchar(20),"
                            . "enquirydate date,"
                            . "nextfollowup date,"
                            . "assignfrom varchar(50),"
                            . "assignto varchar(50),"
                            . "medium varchar(20),"
                            . "remark text,"
                            . "status2 varchar(10))";

                            if ($conn->query($sql4) === TRUE) {

                            }

                                //create table meeting
                            $sql5 = "create table if not exists meeting (id int(50) auto_increment primary key,"
                            . "title varchar(30),"
                            . "date date,"
                            . "time time,"
                            . "details text,"
                            . "user text )";

                            if ($conn->query($sql5) === TRUE) {

                            }

                        }

                                    //insert into database
                        $query1 = "insert into register (fname,lname,des,gender,username,password,email,mobile,address,img) values ('$fname','$lname','$des','$gender','$uname','$pass','$email','$mobile','$address','$file')";
                        $data1 = mysqli_query($conn, $query1);

                        if ($data1) {
                            $conn = new mysqli("localhost", "root", "", "admin") or die("ERROR:" . mysqli_connect_error());
                            $name = $fname . " " . $lname;
                            $query2 = "INSERT INTO userlogin (id,name,profile,username,password,status) VALUES ('','$name','$des','$uname','$pass','1')";
                            $data2 = mysqli_query($conn, $query2);
                            if ($data2) {
                                ?> 
                                <script>
                                    alert("User Registered Successfully!!");
                                </script>
                                <?php
                            }
                        } else {
                            ?>
                            <script>
                                alert("User Not Registered Successfully!!");
                            </script>
                            <?php
                        }
                    }
                }
                ?>  
                <?php include_once( "footer.php"); ?>
                <script>
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