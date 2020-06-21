<?php
session_start();
error_reporting(0);
$db = $_SESSION["uname"];
$id = $_GET['id'];
$conn = new mysqli("localhost", "root", "", "admin") or die("ERROR:" . mysqli_connect_error());
$query = mysqli_query($conn, "SELECT * From enqall where enqid='$id'");
$r = mysqli_fetch_array($query);
$eid=$r['enqid'];
$name = $r['name'];
$mobile = $r['mobile'];
$address = $r['address'];
$enquiry = $r['enquiry'];
$status = $r['status1'];
$enquirydate = $r['enquirydate'];
$nextfollowup = $r['nextfollowup'];
$medium = $r['medium'];
$enquirydate = date('d/m/Y', strtotime($enquirydate));
$nextfollowup = date('d/m/Y', strtotime($nextfollowup))
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
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Information</h4>
                        <form id="form1" class="form-sample" method="post" action="">
                            <p class="card-description">
                                After client action
                            </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Enquiry Details</label>
                                        <div class="col-sm-6">
                                            <textarea class="form-control" rows="8"  name="details"
                                            readonly><?php
                                            echo "Name: " . $name . PHP_EOL;
                                            echo "Mobile: " . $mobile . PHP_EOL;
                                            echo "Address: " . $address . PHP_EOL;
                                            echo "Enquiry: " . $enquiry . PHP_EOL;
                                            echo "Status: " . $status . PHP_EOL;
                                            echo "Enquiry Date: " . $enquirydate . PHP_EOL;
                                            echo "FNext Followup: " . $nextfollowup . PHP_EOL;
                                            echo "Enquiry Medium: " . $medium;
                                            ?>
                                        </textarea>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Remark</label>
                                    <div class="col-sm-6">
                                        <textarea class="form-control" rows="4" name="remark"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Status</label>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="onoff" onclick="show2();"  value="1" checked="">
                                                Active
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="radio" class="form-check-input" name="onoff" onclick="show1();" value="0">
                                                Inactive
                                            </label>
                                        </div>
                                    </div>   
                                </div>
                            </div>
                        </div>
                        <div id="div1" class="row">
                            <div class="col-md-12">
                                <div id="div1" class="hide form-group row">
                                    <label class="col-sm-3 form-check-label">Assign to:</label>
                                    <div class="col-sm-6">
                                        <select class="form-control" id="mylist" name="assign">
                                            <option value="" disabled selected>Select someone..</option>
                                            <?php
                                            $sql = mysqli_query($conn, "SELECT name From userlogin");
                                            $row = mysqli_num_rows($sql);
                                            while ($row = mysqli_fetch_array($sql)) {
                                                echo "<option value='" . $row['name'] . "'>" . $row['name'] . "</option>";
                                            }
                                            ?> 
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary mr-2" value="<?php echo $id; ?>" onclick="window.location.href='assign.php'" name="submit">Submit</button>
                        <button class="btn btn-light">Cancel</button>
                    </form>

                    <?php
                    if ($_POST['submit']) {
                        $remark = (isset($_POST['remark']) ? $_POST['remark'] : '');
                        $onoff = (isset($_POST['onoff']) ? $_POST['onoff'] : '');
                        $assi = $_POST['assign'];
                        $ei=$_POST['submit'];

                        $sq = mysqli_query($conn, "SELECT name From userlogin where username='$db'");
                        $r = mysqli_num_rows($sq);
                        $row = mysqli_fetch_array($sq);
                        $af= $row['name'] ;
                        if($remark !="" && $onoff !=""){
                            $qry="update enqall set assignto='$assi',assignfrom='$af',remark='$remark',status2='$onoff' where enqid='$ei'";

                            $re= mysqli_query($conn, $qry);
                            if($re){
                              ?> 
                              <script>
                                alert("Data Updated Successfully!!");
                            </script>
                            <?php

                        }
                        else {
                            ?>
                            <script>
                                alert("Data Not Updated Successfully!!");
                            </script>
                            <?php
                        }
                    }  
                    else {
                        ?>
                        <script>
                            alert("All fields are required");
                        </script>
                        <?php
                    }
                }
                ?>

                <?php include_once( "footer.php"); ?>

                <script>
                    function show1() {
                        document.getElementById('div1').style.display = 'none';
                    }
                    function show2() {
                        document.getElementById('div1').style.display = 'block';
                    }
                </script>
            </body>
            </html>



