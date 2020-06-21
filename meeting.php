<?php
session_start();
error_reporting(0);
$conn = new mysqli("localhost", "root", "", "admin") or die("ERROR:" . mysqli_connect_error());
$count=0;
if(!empty($_POST['submit'])) {
  $title = (isset($_POST['title']) ? $_POST['title'] : '');
  $date = (isset($_POST['date']) ? $_POST['date'] : '');
  $time = (isset($_POST['time']) ? $_POST['time'] : '');
  $details = (isset($_POST['details']) ? $_POST['details'] : '');
  $chk=$_POST['check_list'];
  if(!empty($_POST['check_list'])) {    
    foreach($_POST['check_list'] as $value){
     $chkd=$chkd." ".$value;
   }
 }
 
 if ($title != "" && $date != "" && $time != ""  && $details != "" && $chk != "") { 
  $sql = "INSERT INTO meeting (title,date,time,details,user) VALUES('$title','$date','$time','$details','$chkd')";
  mysqli_query($conn, $sql);
  ?>
  <script>
    alert("Meeting details send successfully ");
  </script>
  <?php
}
else{
 ?>
 <script>
  alert("All fields are required");
</script>
<?php
}
}
$sql2="SELECT * FROM meeting WHERE status = 0";
$result=mysqli_query($conn, $sql2);
$count=mysqli_num_rows($result);

$query = "select * from register";
$data = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($data);
$fn = $row['fname'];
$ln = $row['lname'];
$name = $fn .' '. $ln;
$des = $row['des'];
$img = $row['img'];
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
            <h1 class="card-title">Meeting Details</h1>
            <form class="form-sample" method="post" action=''>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Title</label>
                  <div class="col-sm-9">
                    <input type="text" name="title" class="form-control" placeholder="Purpose Of Meeting"/>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="date" class="col-sm-3 col-form-label"> Date </label>
                  <div class="col-sm-9">
                    <input type="date" name="date" class="form-control"  placeholder="">
                  </div>  
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label for="time" class="col-sm-3 col-form-label">Time </label>
                  <div class="col-sm-9">
                    <input type="time" name="time" class="form-control"  placeholder="">
                  </div>  
                </div>
              </div>

              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label">Description</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" rows="4" name="details"></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label class="col-sm-3 col-form-label"> Assign To</label>
                  <div class="col">

                    <?php
                    include("connection.php");
                    mysqli_select_db($conn, "admin");
                    $sql = mysqli_query($conn, "SELECT username,name From userlogin");
                    $row1 = mysqli_num_rows($sql);
                    ?>
                    <?php
                    while ($row = mysqli_fetch_array($sql)){
                      ?>

                      <div>
                        <div class="form-check">
                          <label class="form-check-label">
                            <input type="checkbox" class="form-check-input" name="check_list[]"  value="<?php echo $row['username']; ?>">
                            <?php
                            echo $row['name'];
                            ?>
                          </label>
                        </div>
                      </div>    
                      <?php
                    } ?>
                  </div>
                </div>
              </div>

              <input type="submit" class="btn btn-primary mr-2" value="Send" name="submit">
              <button class="btn btn-light">Cancel</button>
            </form>


            <?php include_once( "footer.php"); ?>
          </body>
          </html>

