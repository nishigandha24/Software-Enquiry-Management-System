<?php
$conn = new mysqli('localhost','root','','admin') or die("ERROR:" . mysqli_connect_error());
if(isset($_POST['id']))  
{
	$sql = "SELECT status FROM userlogin where id = '".$_POST['id']."'";
	$data = mysqli_query($conn, $sql);
	$result = mysqli_fetch_assoc($data);
	if($_POST['id'] != '' && $result['status'] == 1)  
	{
		$sql1 = "UPDATE userlogin set status='0' WHERE id = '".$_POST['id']."'";
		$result1 = mysqli_query($conn,$sql1);  
	}
	else
	{
		$sql1 = "UPDATE userlogin set status='1' WHERE id = '".$_POST['id']."'";
		$result1 = mysqli_query($conn,$sql1);  
	}
}
