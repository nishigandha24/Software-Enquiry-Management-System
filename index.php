<?php
session_start();
error_reporting(0);
$conn = new mysqli("localhost", "root", "", "admin") or die("ERROR:" . mysqli_connect_error());

if (isset($_POST['submit'])) {
    $uname = (isset($_POST['uname']) ? $_POST['uname'] : '');
    $pass = (isset($_POST['pass']) ? $_POST['pass'] : '');
    if ($uname != "" && $pass != "") {
        $sql = "select * from userlogin where username = '$uname' and password = '$pass' and status = '1' ";
        $data = mysqli_query($conn, $sql);
        $total = mysqli_num_rows($data);

        if ($uname == "admin" && $pass == "password") {
            $_SESSION["uname"] = $uname;
            header("Location:admin_panel.php");
        } else if ($total == TRUE) {
            $_SESSION["uname"] = $uname;
            $db = $_SESSION["uname"];
            $conn = new mysqli("localhost", "root", "", $db) or die("ERROR:" . mysqli_connect_error());
            header("Location:user_panel.php");
        } else {
            ?>
            <script>
                alert("Username or Password is not correct!!!");
            </script>
            <?php
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="images/raju.png" />
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>

    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100 p-t-85 p-b-20">
                <form class="login100-form validate-form" method="post" >
                    <span class="login100-form-title p-b-30">
                        Welcome
                    </span>
                    <span class="login100-form-avatar">
                        <img src="images/face1.jpg" alt="AVATAR">	
                    </span>

                    <div class="wrap-input100 validate-input m-t-45 m-b-35" data-validate = "Enter username">
                        <input class="input100" type="text" name="uname">
                        <span class="focus-input100" data-placeholder="Username"></span>
                    </div>

                    <div class="wrap-input100 validate-input m-b-50" data-validate="Enter password">
                        <input class="input100" type="password" name="pass">
                        <span class="focus-input100" data-placeholder="Password"></span>
                    </div>

                    <div class="container-login100-form-btn">
                        <input type="submit" name="submit" class="login100-form-btn">
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <script src="js/main.js"></script>

</body>
</html>