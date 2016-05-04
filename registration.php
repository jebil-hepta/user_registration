<?php
	include('connect.php');
	if(count($_POST)>0) {
		/* Form Required Field Validation */
		foreach($_POST as $key=>$value) 
		{
			if(empty($_POST[$key])) 
			{
				$message = ucwords($key) . " field is required";
				break;
			}
		}
		/* Password Matching Validation */
		if($_POST['password'] != $_POST['repassword'])
		{ 
			$message = 'Passwords should be same<br>'; 
		}
		/* Email Validation */
		if(!isset($message)) 
		{
			if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) 
			{
				$message = "Invalid UserEmail";
			}
		}
		/* Validation to check if gender is selected */
		if(!isset($message)) 
		{
			if(!isset($_POST["gender"])) 
			{
				$message = " Gender field is required";
			}
		}
		/* Validation to check if Terms and Conditions are accepted */
		if(!isset($message)) 
		{
			if(!isset($_POST["terms"])) 
			{
				$message = "Accept Terms and conditions before submit";
			}
		}			
	}
?>
<html>
	<head>
		<title>PHP User Registration Form</title>		
		<style>
			body{width:610px;}
		</style>
		<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js">
		</script>
		<script type="text/javascript">//for displaying upload picture in the same page
			function readURL(input) 
			{
            	if (input.files && input.files[0]) 
            	{
                	var reader = new FileReader();
                	reader.onload = function (e) 
                	{
                    	$('#blah')
                        .attr('src', e.target.result)
                        .width(150)
                        .height(150);
                	};
                	reader.readAsDataURL(input.files[0]);
            	}
        	}
		</script>
		<script src='https://www.google.com/recaptcha/api.js'>//for Google Recaptcha
		</script>
	</head>
	<body>
		<form name="frmRegistration" method="post" action="register.php" enctype="multipart/form-data";>
			<table border="0" align="center">
				<div class="message"><?php if(isset($message)) echo $message; ?></div>
				<center><h3>User Registration Form</h3></center>
				<tr>
					<td>User ID</td>
					<td><input type="text" name="user_id" id="user_id" value="">
					</td>
				</tr>
				<tr>
					<td>Username</td>
					<td><input type="text" name="username" id="username" value="<?php if(isset($_POST['username'])) echo $_POST['username']; ?>"></td>
				</tr>
				<tr>
					<td>Email ID</td>
					<td><input type="text" name="email" id="email" value="<?php if(isset($_POST['email'])) echo $_POST['email']; ?>"></td>
				</tr>
				<tr>
					<td>Password</td>
					<td><input type="password" name="password" id="password" value=""></td>
				</tr>
				<tr>
					<td>Confirm Password</td>
					<td><input type="password" name="repassword" id="repassword" value="">
					</td>
				</tr>
				<tr>
					<td>Address</td>
					<td>
						<textarea rows="4" cols="30" name="address" id-"address" value=""></textarea></td>
				</tr>
				<tr>
					<td>Country</td>
					<td>
						<?php
                    		//for retriving data from DB and show it in drop down box
                        	$query="SELECT * FROM country";
                        	$result = mysqli_query ($con, "$query");
                        	echo "<select name=country>";
                            while($r=mysqli_fetch_array($result))
                            {
                            	echo "<option value='$r[countryid]'> $r[cname] </option>";
                            }
                            echo "</select>";
                		?>
					</td>
				</tr>
				<tr>
					<td>State</td>
					<td>
						<?php
                    		
                    		//for retriving data from DB and show it in drop down box
                        	$query="SELECT * FROM state";
                        	$result = mysqli_query ($con, "$query");
                        	echo "<select name=state>";
                            while($r=mysqli_fetch_array($result))
                            {
                            	echo "<option value='$r[state_id]'> $r[state_name] </option>";
                            }
                            echo "</select>";
                		?>
					</td>
				</tr>
				<tr>
					<td>City</td>
					<td>
						<?php
                    		//for retriving data from DB and show it in drop down box
                        	$query="SELECT * FROM city";
                        	$result = mysqli_query ($con, "$query");
                        	echo "<select name=city>";
                            while($r=mysqli_fetch_array($result))
                            {
                            	echo "<option value='$r[city_id]'> $r[city_name] </option>";
                            }
                            echo "</select>";
                		?>
					</td>
				</tr>
				<tr>
					<td>Hobbies</td>
					<td>
						<?php
							$query = "SELECT * FROM hobbies";
							$result = mysqli_query($con, "$query");
							while ($r=mysqli_fetch_array($result))
							{
								$hobbyid=$r["hobby_id"];
								$hobbyname=$r["hobby_name"];?>
								<label><input type='checkbox' name='check_list[]' value='<?php echo $hobbyid; ?>'><?php echo $hobbyname;?></label>
								<?php

							}
						?></td>
				</tr>
				<tr>
					<td>Gender</td>
					<td>
						<label><input type="radio" name="gender" value="Male" <?php if(isset($_POST['gender']) && $_POST['gender']=="Male") { ?>checked<?php  } ?>> Male</label>
						<label><input type="radio" name="gender" value="Female" <?php if(isset($_POST['gender']) && $_POST['gender']=="Female") { ?>checked<?php  } ?>> Female</label>
					</td>
				</tr>
				<tr>
					<td>Date of Birth</td>
					<td>
						<input type="date" name="date" value="">
					</td>
				</tr>
				<tr>
					<td>Upload Profile Picture</td>
					<td>
						<input type='file' name="profile" onchange="readURL(this);" accept="image/gif, image/jpeg, image/png"/>
    					<img id="blah" src="#" alt="your image" />
					</td>
				</tr>
				<tr>
					<td>Preferred Location</td>
					<td>
						<?php
                    		//for retriving data from DB and show it in multi select combo box
                        	$query="SELECT * FROM city";
                        	$result = mysqli_query ($con, "$query");
                        	echo "<select name=location[] multiple size=2>";
                            while($r=mysqli_fetch_array($result))
                            {
                            	$locationname=$r["city_name"];
                            	$locationid=$r["city_id"];?>
                            	echo "<option value='<?php echo $locationid; ?>'> <?php echo $locationname;?> </option>";
                         <?php   }
                            echo "</select>";
                		?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<div class="g-recaptcha" data-sitekey="6LeOcR4TAAAAAB8Cu_Xrfp_ONUtJebKhq0zywrq0"><!-- for Google recaptcha--></div>
					</td>
				</tr>
				<tr>
					<td></td>
					<td><input type="checkbox" name="terms"> I accept Terms and Conditions
					</td>
				</tr>
			</table>
			<div>
				<center>
					<input type="submit" name="submit" value="Register"/>
				</center>
			</div>
		</form>
	</body>
</html>