<html>
	<head>
		<title>Login Page</title>
		<style>
			body{width:610px;}
		</style>
	</head>
	<body>
		<form name="frmLogin" method="post" action="">
			<table border="0" align="center">
				<h2 align="center">Login Page</h2>
				<tr>
					<td>Username or Email ID</td>
					<td><input type="text" name="user"></input></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password"></input></td>
				</tr>
				<tr></tr><tr></tr><tr></tr>
			</table>
			<div>
				<center>
					<a href="forgot.php">Forgot Password</a> <input type="submit" name="submit" value="Login"/>
					<p>If you are a new user <a href="registration.php"><b>CLICK HERE</b></a> to <b>Register</b></p>
				</center>
			</div>
		</form>
	</body>
</html>
<?php
	include ('connect.php');
	session_start();
	
	if(isset($_POST['submit']))
	{
		$username=$_POST['user'];
		$passWord=md5($_POST['password']);
		$_SESSION['username'] = $username;
		$sql="SELECT * FROM sample WHERE username='$username' and password='$passWord'";
		$result=mysqli_query($con, $sql);
		// Mysqli_num_row is counting table row
		$count=mysqli_num_rows($result);
		// If result matched $username and $password, table row must be 1 row
		if($count==1)
		{
			header("location:login_success.php");
		}
		else 
		{
			echo "Invalid Username or Password";
		}
	}
?>