<?php
$db = $_SESSION["uname"];
$conn = new mysqli('localhost', "root", "", $db) or die("ERROR:" . mysqli_connect_error());

$query = "select * from register";
$data = mysqli_query($conn, $query);
$row = mysqli_fetch_assoc($data);
$fn = $row['fname'];
$ln = $row['lname'];
$name = $fn .' '. $ln;
$des = $row['des'];
$img = $row['img']; 
?>
<?php
mysqli_select_db($conn,"admin");
$count=0;
$sql2="SELECT * FROM meeting WHERE status = 0";
$result=mysqli_query($conn, $sql2);
$count=mysqli_num_rows($result);
?>
<style>
  .button {
    background-color: white; /* Green */
    border: none;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
    margin: 4px 2px;
    cursor: pointer;

    .button4 {
      background-color: white;
      color: black;
    }
  }
</style>
<div class="container-scroller">
  <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
      <a class="navbar-brand brand-logo" href="user_panel.php"><img src="images/logo.svg" alt="logo"/></a>
      <a class="navbar-brand brand-logo-mini" href="user_panel.php"><img src="images/logo-mini.svg" alt="logo"/></a>
    </div>
    <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
      <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
        <span class="icon-menu"></span>
      </button>
      <ul class="navbar-nav mr-lg-2">
        <li class="nav-item nav-search d-none d-lg-block">
          <div class="input-group">
            <div class="input-group-prepend">
              <span class="input-group-text" >
                <h4><b>  <?php  echo "welcome $name"; ?></b></h4> 
              </span>
            </div>
          </div>
        </li>
      </ul>
      <ul class="navbar-nav navbar-nav-right">
        <li class="nav-item dropdown d-lg-flex d-none">
          <button type="button" class="btn btn-info font-weight-bold">+ Create New</button>
        </li>
        <li class="nav-item dropdown d-flex">
          <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown">
            <li class="nav-item dropdown d-flex" >
             <div style="position:relative">
              <a class="nav-link count-indicator dropdown-toggle d-flex justify-content-center align-items-center" id="messageDropdown" href="#" data-toggle="dropdown" >
                <button id="notification-icon" name="button" onclick="myFunction()" class="dropbtn"  ><span id="notification-count"><?php if($count>0) { echo $count; } ?></span><i class="icon-air-play mx-0"></i></button>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown" >
                 <p class="mb-0 font-weight-normal float-left dropdown-header">Messages</p>
               </a>
               <?php
               $conn = new mysqli('localhost','root','','admin') or die("ERROR:" . mysqli_connect_error());
               $sql="select * from meeting";	
               $result=mysqli_query($conn, $sql);
               while($r= mysqli_fetch_array($result)){
                $str=$r['user'];
                $id=$r['id'];
                if(strpos($str,$db) !== false) {
                 ?>
                 <form method="post" action="message.php">
                   <button class="button button4" name="id" value="<?php echo $id; ?>">
                     <div id="notification-header">
                       <a class="dropdown-item preview-item" name="id" value="<?php echo $id; ?>" onclick="window.location.href='message.php'">
                        <div class="preview-thumbnail">
                          <?php
                          $conn = new mysqli('localhost','root','','admin') or die("ERROR:" . mysqli_connect_error());
                          $query = "select * from register";
                          $data = mysqli_query($conn, $query);
                          $row = mysqli_fetch_assoc($data);
                          $im = $row['img'];
                          echo '<img src="data:img/jpeg;base64,'.base64_encode( $im ).'" height="40" width="40" align="top"/>';
                          ?>
                        </div>
                        <div class="preview-item-content flex-grow">
                          <h6 class="preview-subject ellipsis font-weight-normal"> <?php echo "admin admin"; ?></h6>
                          <p class="font-weight-light small-text text-muted mb-0">
                           <?php echo $r['title']?>
                         </p>
                       </div>
                     </a>
                   </div>
                 </button>
               </form>
               <?php 
             }
           }
           ?> 
           <?php if(isset($message)) { ?> <div class="error"><?php echo $message; ?></div> <?php } ?>

           <?php if(isset($success)) { ?> <div class="success"><?php echo $success;?></div> <?php } ?>
         </div>
       </div>
     </li>
     <li class="nav-item dropdown d-flex mr-4 ">
      <a class="nav-link count-indicator dropdown-toggle d-flex align-items-center justify-content-center" id="notificationDropdown" href="#" data-toggle="dropdown">
        <i class="icon-cog"></i>
      </a>
      <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
        <p class="mb-0 font-weight-normal float-left dropdown-header">Settings</p>
        <a class="dropdown-item preview-item" href="edit_profile.php">               
          <i class="icon-head"></i> Profile
        </a>
        <a class="dropdown-item preview-item" href="logout.php">
          <i class="icon-inbox"></i> Logout
        </a>
      </div>
    </li>
    <li class="nav-item dropdown mr-4 d-lg-flex d-none">
      <a class="nav-link count-indicatord-flex align-item s-center justify-content-center" href="#">
        <i class="icon-grid "></i>
      </a>
    </li>
  </ul>
  <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
    <span class="icon-menu"></span>
  </button>
</div>
</nav>
<!-- partial -->
<div class="container-fluid page-body-wrapper">
  <!-- partial:partials/_sidebar.html -->
  <nav class="sidebar sidebar-offcanvas" id="sidebar">
    <div class="user-profile">
      <div class="user-image">
        <?php echo '<img src="data:img/jpeg;base64,'.base64_encode( $img ).'" height="40" width="40" align="center"/>';?>
      </div>                               
      <div class="user-name">
        <?php echo $name; ?>     
      </div>
      <div class="user-designation">
        <?php echo $des; ?>               
      </div>
    </div>
    <ul class="nav">
      <li class="nav-item">
        <a class="nav-link" href="user_panel.php">
          <i class="icon-box menu-icon"></i>
          <span class="menu-title">Dashboard</span>
        </a>
      </li>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="enquiry.php">
        <i class="icon-file menu-icon"></i>
        <span class="menu-title">Enquiry </span>
      </a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="assign.php">
        <i class="icon-pie-graph menu-icon"></i>
        <span class="menu-title">Assign List</span>
      </a>
    </li>   
    <li class="nav-item">
      <a class="nav-link" href="meeting.php">
        <i class="icon-pie-graph menu-icon"></i>
        <span class="menu-title">Meeting Details</span>
      </a>
    </li>
  </ul>
</nav>
<script type="text/javascript">

	function myFunction() {
		$.ajax({
			url: "notify.php",
			type: "POST",
			processData:false,
			success: function(data){
				$("#notification-count").remove();					
				$("#notification-latest").show();$("#notification-latest").html(data);
			},
			error: function(){}           
		});
  }

  $(document).ready(function() {
    $('body').click(function(e){
     if ( e.target.id !== 'notification-icon'){
      $("#notification-latest").hide();
    }
  });
  });

</script>