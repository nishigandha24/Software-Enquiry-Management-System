<?php
error_reporting(0);
session_start();

if ($_SESSION["uname"] == TRUE) {
    
} else {
    header("Location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<?php
include( "header.php");
include( "navbar_admin.php");

$db = $_SESSION["uname"];
$conn = new mysqli("localhost", "root", "", "admin") or die("ERROR:" . mysqli_connect_error());
$data = mysqli_query($conn, "SELECT * FROM userlogin;");
$total = mysqli_num_rows($data);
?>
<div class="main-panel">   
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Top Sellers</h4>
                        <div class="table-responsive mt-3">
                            <table class="table table-striped">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Profile</th>
                                        <th>Total Enquiry</th>
                                        <th>completed Enquiry</th>
                                        <th>Pending Enquiry </th>
                                        <th>AssignedTo Enquiry</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($total > 0) {
                                        while ($result = mysqli_fetch_assoc($data)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $result['id']; ?></td>
                                                <td><?php echo $result['name']; ?></td>
                                                <td><?php echo $result['profile']; ?></td>
                                                <?php
                                                $name = $result['name'];
                                                $data1 = mysqli_query($conn, "SELECT * FROM enqall where assignto = '$name' ;");
                                                $total1 = mysqli_num_rows($data1);
                                                ?>
                                                <td><div class="row">
                                                    <div class="col-sm-10">
                                                        <div class="progress">
                                                            <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total1; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-2">
                                                        <?php echo $total1; ?>
                                                    </div>
                                                </div>
                                            </td>        
                                            <?php
                                            $conn2 = new mysqli("localhost", "root", "", $username) or die("ERROR:" . mysqli_connect_error());
                                            $data2 = mysqli_query($conn2, "SELECT * FROM enquiry;");
                                            $total2 = mysqli_num_rows($data2);
                                            ?> 
                                            <td><div class="row">
                                                <div class="col-sm-10">
                                                    <div class="progress">
                                                        <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total2; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <?php echo $total2; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <?php
                                        $data3 = mysqli_query($conn, "SELECT * FROM enqall where assignto = '$name' ;");
                                        $total3 = mysqli_num_rows($data3);
                                        ?>
                                        <td><div class="row">
                                            <div class="col-sm-10">
                                                <div class="progress">
                                                    <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total3 * 100; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>      
                                                </div>
                                                <div class="col-sm-2">
                                                    <?php echo $total3; ?>
                                                </div>
                                            </div>
                                        </td>
                                        <?php
                                        $data4 = mysqli_query($conn, "SELECT * FROM enqall where assignfrom = '$name' ;");
                                        $total4 = mysqli_num_rows($data4);
                                        ?>
                                        <td><div class="row">
                                            <div class="col-sm-10">
                                                <div class="progress">
                                                    <div class="progress-bar bg-info" role="progressbar" style="width: <?php echo $total4 * 100; ?>%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <?php echo $total4; ?>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <script>
                                alert("No Records Found!!!");
                            </script>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <?php
            include_once( "footer.php");
            ?>  
        </body>
        </html>