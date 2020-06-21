<?php
error_reporting(0);
session_start();
if ($_SESSION["uname"] == TRUE) {
    
} else {
    header("Location:index.php");
}

$db = $_SESSION["uname"];
$conn = new mysqli("localhost", "root", "", $db) or die("ERROR:" . mysqli_connect_error());
?>

<!DOCTYPE html>
<html lang="en">
<?php
include( "header.php");
include( "navbar_user.php");
?>
<div class="main-panel">   
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Profile</h4>
                        <?php
                        include_once( "footer.php");
                        ?>  
                    </body>
                    </html>