<?php
error_reporting(0);
session_start();
include ("conncetion.php");
$db = $_SESSION["uname"];
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

mysqli_select_db($conn, "admin");
$sql = mysqli_query($conn, "SELECT name from userlogin where username='$db'");
$r = mysqli_fetch_array($sql);
$at = $r['name'];
$query = "select * from enqall where assignto='$at'";
$data = mysqli_query($conn, $query);
?>
<div class="main-panel">        
    <div class="content-wrapper">
        <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Assign List</h4>
                        <div class="table-responsive" >          
                            <table class="table table-striped">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Sr No</th>
                                        <th>Assigned From</th>
                                        <th>Task</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $i = 1;
                                    while ($result = mysqli_fetch_array($data)) {
                                        ?>
                                        <tr>
                                            <td> <?php echo $i ?> </td>
                                            <td> <?php echo $result['assignfrom'] ?> </td>
                                            <td> <?php echo $result['remark'] ?> </td>
                                            <td><?php echo "<a href='action.php?id=$result[enqid]'>Action</a>"; ?></td>
                                            <?php
                                            $i++;
                                            ?>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <?php include_once( "footer.php"); ?>
                    </body>
                    </html>