<?php

if (isset($_POST['submit'])) {
	include_once 'dbh.inc.php';
	$name= mysqli_real_escape_string($conn, $_POST['name']);
	$email= mysqli_real_escape_string($conn, $_POST['email']);
	$remark=mysqli_real_escape_string($conn,$_POST['remarks']);

	//Error handlers
	//Check for empty fields
	if (empty($name) || empty($email) || empty($remark)) {
		header("Location: ../onecolumn.html?contact=empty");
		exit();
	}
	else{
		//check if input character are valid
		if (!preg_match("/^[a-zA-Z]*$/", $name)){
			header("Location: ../onecolumn.html?contact=invalid");
			exit();
			}
		else{
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				header("Location: ../onecolumn.html?contact=InvalidEmail");
				exit();			
			}
			else{
				$sql = "INSERT INTO Contact (contactName,contactEmail,contactRemarks) VALUES ('$name','$email','$	remark');";
				mysqli_query($conn,$sql);
				header("Location: ../spot.html?contact=success");
			}




			
			}
		}

}
else{
	header("Location: ../onecolumn.html");
	exit();
}