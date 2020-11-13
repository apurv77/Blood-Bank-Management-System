<?php
include_once 'connection.php';
$name=$_POST["name"];
$address=$_POST["address"];
$area=$_POST["area"];
$phone=$_POST["phone_no"];
$email=$_POST["email"];

$sql="insert into branch (b_name,address,area,phone,email) values ('$name','$address','$area','$phone','$email')";
if($conn->query($sql))
{
	echo '<center style="margin-top:200px;"><h1>New branch added successfully</h1></center>';
				echo '<center><a href="index_admin.html";><input type="button" value="Go to Home" style="background-color: #f44336;box-shadow: 0 1px 4px black;border: none;height:35px;"></a></center>';

}
?>