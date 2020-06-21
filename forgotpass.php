<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags --> 
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Regal Admin</title>
  <!-- base:css -->
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/base/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <link rel="stylesheet" href="vendors/flag-icon-css/css/flag-icon.min.css"/>
  <link rel="stylesheet" href="vendors/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="vendors/jquery-bar-rating/fontawesome-stars-o.css">
  <link rel="stylesheet" href="vendors/jquery-bar-rating/fontawesome-stars.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo" href="index.html"><img src="images/logo.svg" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="index.html"><img src="images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        
        
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        
        
        
      </nav>
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-12 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h1 class="card-title">Change Password</h1>
                  <form class="form-sample" method="post" action=''>
                    
                    
                    <div class="col-md-7">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">User Name</label>
                        <div class="col-sm-9">
                          <input type="text" name="txuser" class="form-control" placeholder="Enter User name "/>
                        </div>
                      </div>
                    </div>
                    
                    <div class="col-md-7">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Password</label>
                        <div class="col-sm-9">
                          <input type="password" name="newPassword" class="form-control" placeholder="Enter Password"/>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group row">
                        <label class="col-sm-3 col-form-label">Confirm Password</label>
                        <div class="col-sm-9">
                          <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm Password"/>
                        </div>
                      </div>
                    </div>
                    
                    
                    <input type="submit" class="btn btn-primary mr-2" value="Save" name="submit">
                    <button class="btn btn-light">Cancel</button>
                  </form>
                  
                  <?php
                  if (isset($_POST['submit'])){
                    $name=(isset($_POST['txuser']) ? $_POST['txuser'] : '');
                    $newpass=(isset($_POST['newPassword']) ? $_POST['newPassword'] : '');
                    $cnpass=(isset($_POST['confirmPassword']) ? $_POST['confirmPassword'] : '');
                    if ($name != "" && $newpass != "" && $cnpass != ""){
                      if ($newpass == $cnpass) {
                        include("connection.php");
                        
                        mysqli_select_db($conn, $name);
                        $query = "update register set pass='$newpass' where user='$name'";
                        $data=mysqli_query($conn,$query);
                        mysqli_select_db($conn, "admin");
                        $query1 = "update userlogin set pass='$newpass' where user='$name'";
                        $data1=mysqli_query($conn,$query1);
                        
                        
                        if($data && $data1){?>
                         
                          <script>
                            alert('Password Updated'); 
                            window.location="index.phpo";
                          </script>
                        <?php } else { ?>
                          <script>window.location="index.php";</script>
                          <?php
                        }
                        
                      }
                    }
                    else {
                      ?>
                      <script>
                        alert('Something Wrong'); 
                        window.location="forgotpass.php";
                      </script>
                      <?php
                      
                    }
                    
                  }
                  ?>
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
      <!-- page-body-wrapper ends -->
    </div>
    <!-- main-panel ends -->
  </div>
  <!-- page-body-wrapper ends -->

  <!-- container-scroller -->

  <!-- base:js -->
  <script src="vendors/base/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <!-- endinject -->
  <!-- plugin js for this page -->
  <script src="vendors/chart.js/Chart.min.js"></script>
  <script src="vendors/jquery-bar-rating/jquery.barrating.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- Custom js for this page-->
  <script src="js/dashboard.js"></script>
  <!-- End custom js for this page-->
</body>

</html>




