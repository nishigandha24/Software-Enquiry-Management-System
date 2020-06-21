<?php
session_start();
error_reporting(0);
$db = $_SESSION["uname"];
$conn = new mysqli('localhost','root','','admin') or die("ERROR:" . mysqli_connect_error());
$sql="UPDATE meeting SET status=1 WHERE status=0";	
$result=mysqli_query($conn, $sql);

$sql="select * from meeting ORDER BY id";
$result=mysqli_query($conn, $sql);

$response='';
while($row=mysqli_fetch_array($result)) {
	$response = $response . "<div class='notification-item'>" .
	"<div class='notification-subject'>". $row["title"] . "</div>" . 
	//"<div class='notification-comment'>" . $row["comment"]  . "</div>" .
	"</div>";  
}
if(!empty($response)) {
	print $response;
}


?>
