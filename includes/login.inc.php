<?php

session_start();

	if(isset($_POST['submit'])){
		include 'dbh.inc.php' ;
		$uid = mysqli_real_escape_string($conn, $_POST['uid']);
		$pwd = mysqli_real_escape_string($conn, $_POST['pwd']);

			$sql = "SELECT * FROM users WHERE username='$uid' OR email_id='$uid' ";
			$result= mysqli_query($conn, $sql);
			$resultCheck = mysqli_num_rows($result);
			if($resultCheck < 1){
				header("Location: ../signin.php?signin=error1");
				exit();
			}
			else{
				if($row = mysqli_fetch_assoc($result)){
					
					if ($pwd == $row['user_pwd']) {
						//log in the user here
						$_SESSION['u_id']= $row['user_id'];
						$_SESSION['u_name']= $row['full_name'];
						$_SESSION['u_email']= $row['email_id'];
						$_SESSION['u_uid']= $row['username'];
						header("Location: ../spot.html?signin=success");
						exit();

					}
					else{
						header("Location: ../signin.php?signin=IncorrectPassword");
						exit();
					}
				}
			}
		}
else{
	header("Location: ../signin.php?signin=error");
	exit();
}
?>




