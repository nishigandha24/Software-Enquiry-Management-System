<?php
session_start();
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en"> 
<?php
include( "header.php");
include( "navbar_admin.php");
?>
<div class="main-panel">   
    <div class="content-wrapper">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">User Statistic Table</h4>
                    <p class="card-description">
                        User Data
                    </p>
                    <?php
                    $conn = new mysqli('localhost','root','','admin') or die("ERROR:" . mysqli_connect_error());
                    $sql = "SELECT * FROM userlogin";
                    $data = mysqli_query($conn, $sql);
                    $total = mysqli_num_rows($data);
                    ?>
                    <form name="myform" action="#" method="post">
                        <div class="table-responsive">
                            <table class="table table-striped" id="mytable">
                                <thead class="table-dark">
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Profile</th>
                                        <th>User Name</th>
                                        <th>Password</th>
                                        <th>Status </th>
                                        <th>Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if ($total != 0) {
                                        while ($result = mysqli_fetch_assoc($data)) {
                                            $id = $result['id'];
                                            ?>
                                            <tr>
                                                <td id="id"><?php echo $result['id']; ?></td>
                                                <td id="name"><?php echo $result['name']; ?></td>
                                                <td id="profile"><?php echo $result['profile']; ?></td>
                                                <td id="username"><?php echo $result['username']; ?></td> 
                                                <td id="password"><?php echo $result['password']    ; ?></td>
                                                <td>
                                                    <?php
                                                    if ($result["status"] == 1) 
                                                    {
                                                        ?>
                                                        <label class="label label-success">Enabled</label>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <label class="label label-danger">Disabled</label>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($result['status'] == 1)
                                                    { 
                                                        ?>
                                                        <button type="button" class="btn btn-primary btn-xs" id="status" value="<?php echo $result["id"]; ?>" href="#" ><label>Disable</label></button>

                                                        <?php 
                                                    } 
                                                    else
                                                    { 
                                                        ?>
                                                        <button type="button" class="btn btn-primary btn-xs" id="status" value="<?php echo $result["id"]; ?>" href="#" ><label>Enable</label></button>
                                                        <?php
                                                    }
                                                    ?>
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
                    </form>
                </div>
                <?php include_once( "footer.php"); ?>
                <script>
                    $(document).ready(function () {

                        $('body').on('click', '#status', function () {
                            var id = $(this).val();
                            $.ajax({
                                method: "POST",
                                url: "user.php",
                                data: "id=" + id,
                                success: function (result) {

                                },
                                error: function (err) {
                                    alert(err);
                                }
                            });
                        });
                    });
                </script>

                <script>
                    $(document).ajaxStop(function()
                    {
                        window.location.reload();
                    });
                </script>

            </body>
            </html>


