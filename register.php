<?php
include('connect.php');
if(isset($_POST['submit']))
{
	if(!empty($_POST['check_list'])) 
	{
		$user_id=$_POST['user_id'];
		$username=$_POST['username'];
		$email=$_POST['email'];
		$password=md5($_POST['password']);
		$address=$_POST['address'];
		$country_id=$_POST['country'];	//Storing selected country name in variable		
		$state_id=$_POST['state'];
		$city_id=$_POST['city'];
		$checkList = implode(',', $_POST['check_list']);
		$gender=$_POST['gender'];
		$dob=$_POST['date'];
		$name=$_FILES['profile']['name'];
   		$type=$_FILES['profile']['type'];
   		if($type=='image/jpeg' || $type=='image/png' || $type=='image/gif' || $type=='image/pjpeg')
   		{
      			$path = 'image/upload/image/';
            $location = $path . $_FILES['profile']['name'];
            $up=move_uploaded_file($_FILES['profile']['tmp_name'], $location);
      			$locationList = implode(',', $_POST['location']);//for getting preferred location value
				$query = mysqli_query($con, "INSERT INTO sample (user_id, username, email, password, address, country_id, state_id, city_id, hobby, gender, dob, url, loc)VALUES ('$user_id', '$username', '$email', '$password', '$address', '$country_id', '$state_id', '$city_id', '$checkList', '$gender', '$dob', '$location', '$locationList')");
				//echo '<img width="250" height="250" src= "'.$location.'"/>';
				
        }
        else
        {
          echo 'Invalid file type';
        }

	}
	else
	{
		echo "<b>Please Select Atleast One Option.</b>";
	}							
    header('Location: activation.php');
}
mysqli_close($con);
?>