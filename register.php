
<?php
include_once "Database.php";
session_start();
if (isset($_POST['submit']))
 {
 	$username=$_POST['fname'];
 	$email=$_POST['email'];
 	$password=$_POST['password'];
	$username1=$_POST['lname'];
	$username2=$_POST['name'];
	


	$insert_record=mysqli_query($conn,"INSERT INTO admin(`name`,`FIRST_name`,`email`,`password`,`LAST_name`)VALUES('".$username2."','".$username."','".$email."','".$password."','".$username1."')");
	if(!$insert_record){
		echo "not inserted";
	}
	else
	{
		
	 echo "<script>window.location = 'login.php';</script>";
	}

}
?>