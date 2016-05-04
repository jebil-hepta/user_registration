<?php
include('connect.php');
session_start();
if(isset($_POST['update']))
{
	$user = $_SESSION['username'];
	echo "welcome";
	echo "$user";
	$user_id=$_POST['user_id'];
 	$email_id=$_POST['email'];
	$address=$_POST['address'];
 	$gender=$_POST['gender'];
 	$dob=$_POST['date'];
 	$name=$_FILES['profile']['name'];
   	$type=$_FILES['profile']['type'];
   	$path = 'image/upload/image/';
    $location = $path . $_FILES['profile']['name'];
    $country=$_POST['country'];
    $state=$_POST['state'];
    $city=$_POST['city'];
    $up=move_uploaded_file($_FILES['profile']['tmp_name'], $location);
	$query = "UPDATE sample SET user_id='$user_id', email='$email_id', address='$address', country_id='$country', state_id='$state', city_id='$city', gender='$gender', dob='$dob', url='$location' WHERE username='$user' "; 
		if(mysqli_query($con, $query))
		{
			echo "Records were updated successfully.";
		}
		else 
		{
			echo "ERROR: Could not able to execute $query. " . mysqli_error($con);
		}
}
mysqli_close($con);
?>