<?php
error_reporting(0);
session_start();
$db = $_SESSION["uname"];
$conn = new mysqli("localhost", "root", "", $db) or die("ERROR:" . mysqli_connect_error());
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
?>
<div class="main-panel">        
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Enquiry Form</h4>
                        <form class="forms-sample" action="" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="name" class="col-sm-3 col-form-label">Name</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="name" placeholder="Name">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="mobile" class="col-sm-3 col-form-label">Mobile</label>
                                        <div class="col-sm-9">
                                            <input type="number" class="form-control" name="mobile" placeholder="Mobile number">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="address" class="col-sm-3 col-form-label">Address</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" cols="50" rows="3" name="address" placeholder="address"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="enquiryforwhat" class="col-sm-3 col-form-label"> Enquiry For</label>
                                        <div class="col-sm-9">
                                            <select class="form-control" name="enquiryfor" placeholder="select following">
                                                <option value="Website"> Website </option>
                                                <option value="Software">Software</option>
                                                <option value="web Application">Web Application</option>
                                                <option value="other">Other</option>>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"> Enquiry Medium </label>
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="medium"  value="WEB">
                                                    WEB
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="medium" value="CALL">
                                                    Call
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="medium"  value="REFERANCE" >
                                                    Reference
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="medium"  value="VISIT" >
                                                    Site Visit
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="enquirydate" class="col-sm-3 col-form-label"> Follow up </label>
                                        <div class="col-sm-9">
                                            <input type="date" name="enquirydate" class="form-control"  placeholder="">
                                        </div>                                                  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label for="nextfollowup" class="col-sm-3 col-form-label"> Next Follow up </label>
                                        <div class="col-sm-9">
                                            <input type="date" name="nextfollowup" class="form-control"  placeholder="">
                                        </div>  
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"> Assign To</label>
                                        <div class="col-sm-9">
                                            <select name="assignto" class="form-control">
                                                <option value="" selected disabled>Select someone..</option>
                                                <?php
                                                $conn = new mysqli("localhost","root","","admin") or die("ERROR:" . mysqli_connect_error());

                                                $sql = mysqli_query($conn, "SELECT name from userlogin where status = '1' ");
                                                while ($result = mysqli_fetch_array($sql)) {
                                                    echo "<option value='" . $result['name'] . "'>" . $result['name'] . "</option>";
                                                }
                                                ?>                                        
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label"> Status</label>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="status"  value="HOT" >
                                                    HOT
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="radio" class="form-check-input" name="status" value="COLD">
                                                    COLD
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <input type="submit" name="submit" class="btn btn-primary mr-2">
                            <button class="btn btn-light">Cancel</button>
                        </form>
                        <?php
                        $q1 = "SELECT name from userlogin where username = '$db' ";
                        $query1 = mysqli_query($conn, $q1);
                        $data1 = mysqli_fetch_array($query1); 
                        $name1 = $data1["name"];


                        if (isset($_POST['submit'])) {
                            $name = (isset($_POST['name']) ? $_POST['name'] : '');
                            $mobile = (isset($_POST['mobile']) ? $_POST['mobile'] : '');
                            $address = (isset($_POST['address']) ? $_POST['address'] : '');
                            $enquiryfor = (isset($_POST['enquiryfor']) ? $_POST['enquiryfor'] : '');
                            $status = (isset($_POST['status']) ? $_POST['status'] : '');
                            $enquirydate = (isset($_POST['enquirydate']) ? $_POST['enquirydate'] : '');
                            $nextfollowup = (isset($_POST['nextfollowup']) ? $_POST['nextfollowup'] : '');
                            $assignto = (isset($_POST['assignto']) ? $_POST['assignto'] : '');
                            $medium = (isset($_POST['medium']) ? $_POST['medium'] : '');

                            if ($name != "" && $mobile != "" && $address != "" && $enquiryfor != "" && $status != "" && $enquirydate != "" && $nextfollowup != "" && $assignto != "" && $medium != "") {
                                $sql = "insert into enquiry (id,name,mobile,address,enquiryfor,status,enquirydate,nextfollowup,assignto,medium) values ('','$name','$mobile','$address','$enquiryfor','$status','$enquirydate','$nextfollowup','$assignto','$medium')"; 

                                $conn = new mysqli("localhost", "root", "", $db) or die("ERROR:" . mysqli_connect_error());

                                if ($conn->query($sql) === TRUE) {

                                 $sql1 = "insert into enqall (enqid,name,mobile,address,enquiry,status1,enquirydate,nextfollowup,assignfrom,assignto,medium,remark,status2) values ('','$name','$mobile','$address','$enquiryfor','$status','$enquirydate','$nextfollowup','$name1','$assignto','$medium',' ',' ')";

                                 $conn = new mysqli("localhost", "root", "", "admin") or die("ERROR:" . mysqli_connect_error());

                                 if ($conn->query($sql1) === TRUE) {
                                    ?> 
                                    <script>
                                        alert("Enquiry Added Successfully!!!");
                                    </script>
                                    <?php
                                } 
                            }
                            else
                            {
                                ?>
                                <script>
                                    alert("Enquiry Not Authorised!!!");
                                </script>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <script>
                                alert("Enter all fields!!!");
                            </script>
                            <?php
                        }
                    }
                    ?>   

                    <?php include_once( "footer.php"); ?>
                </body>
                </html>