<?php
session_start();
error_reporting(0);
include ("conncetion.php");
$db = $_SESSION["uname"];
mysqli_select_db($conn, $db);
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
  <?php
  $eid=$_POST['id'];

  include("connection.php");
  mysqli_select_db($conn, "admin");
  $sql="select * from meeting where id='$eid'";
  $res= mysqli_query($conn, $sql);
  $r= mysqli_fetch_array($res);
  $title=$r['title'];
  $date=$r['date'];
  $time=$r['time'];
  $details=$r['details'];
  ?>
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
                    <textarea readonly="true" class="form-control" rows="1"><?php echo $title; ?></textarea>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group row">
                  <label for="date" class="col-sm-3 col-form-label"> Date </label>
                  <div class="col-sm-9">
                   <textarea readonly="true" class="form-control" rows="1"><?php echo date('d/m/Y', strtotime($date)); ?></textarea>
                 </div>  
               </div>
             </div>

             <div class="col-md-6">
              <div class="form-group row">
                <label for="time" class="col-sm-3 col-form-label">Time </label>
                <div class="col-sm-9">
                  <textarea readonly="true" class="form-control" rows="1"><?php echo date('h:i:s A', strtotime($time)); ?></textarea>
               </div>  
             </div>
           </div>



           <div class="col-md-6">
            <div class="form-group row">
              <label class="col-sm-3 col-form-label">Description</label>
              <div class="col-sm-9">
               <textarea readonly="true" class="form-control" rows="4"><?php echo $details; ?></textarea>
             </div>
           </div>
         </div>


       </div>
     </div>
   </div>

   <!-- content-wrapper ends -->
   <!-- partial:../../partials/_footer.html-->

   <!-- partial -->
 </div>
 <!-- main-panel ends -->
</div>
<?php include_once( "footer.php"); ?>
</body>

</html>









