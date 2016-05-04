<html>
	<head>
		<title>User Page</title>
	</head>
	<body>
		Welcome
<?php
	include ('connect.php');
	session_start();
	$user = $_SESSION['username'];
	echo "$user";?>
	<b><a href="login.php"> SIGN OUT</a></b><?php
	$query = mysqli_query($con, "SELECT * FROM sample WHERE username='$user'");
  ?>     	
  	<table border="2" align="center" style="width:300px;
    background-color:#f3f3f3;
    position:fixed;
    margin-left:-150px; /* half of width */
    margin-top:-150px;  /* half of height */
    top:30%;
    left:30%;" >
      <thead>
        <tr>
          <th>User_id</th>
          <th>User Name</th>
          <th>Email ID</th>
          <th>Address</th>
          <th>Gender</th>
          <th>DOB</th>
          <th>Profile Picture</th>
          <th>Country</th>
          <th>State</th>
          <th>City</th>
          <th>Preferred Location</th>
          <th colspan="4">Hobbies</th>
        </tr>
      	</thead>
      	<tbody>
        <?php
          $row = mysqli_fetch_row($query);
          $id=$row[0];
          $name=$row[1];
          $mail=$row[2];
          $add=$row[4];
          $country= $row[5];
          $state = $row[6];
          $city = $row[7];
          $hobby = $row[8];
          $hob_id=explode(',',$hobby);
          $gen=$row[9];
          $birth=$row[10];
          $path=$row[11];
          $preferred=$row[12];
          echo
           "<tr>
            	<td>{$row[0]}</td>
              	<td>{$row[1]}</td>
              	<td>{$row[2]}</td>
              	<td>{$row[4]}</td>
              	<td>{$row[9]}</td>
              	<td>{$row[10]}</td>";
              ?><td> <?php echo '<img width="100" height="100" src= "'.$path.'"/>'; ?> </td> <?php
          		$result = mysqli_query($con, "SELECT * FROM country WHERE countryid='$country'");
          		$row = mysqli_fetch_row($result);
          		{
          			$countryname = $row[1];
          			echo "<td>{$row[1]}</td>
            		";
          		}
            	$result = mysqli_query($con, "SELECT * FROM state WHERE state_id='$state'");
          		$row = mysqli_fetch_row($result);
          		{
          			$statename = $row[1];
          			echo "<td>{$row[1]}</td>
            		";
          		}
          		$result = mysqli_query($con, "SELECT * FROM city WHERE city_id='$city'");
          		$row = mysqli_fetch_row($result);
          		{
          			$cityname = $row[1];
          			echo "<td>{$row[1]}</td>
            		";
          		}
          		$result = mysqli_query($con, "SELECT * FROM city WHERE city_id='$preferred'");
          		$row = mysqli_fetch_row($result);
          		{
          			$preferred = $row[1];
          			echo "<td>{$row[1]}</td>
            		";
          		}
          		$size = sizeof($hob_id);
    			for($i=0;$i<$size;$i++) 
    			{
          			$result = mysqli_query($con, "SELECT * FROM hobbies WHERE hobby_id='$hob_id[$i]'");
          			$row = mysqli_fetch_row($result);          
          			$hoby = $row[1];
          			echo "<td>{$row[1]}</td>
          			";
          		}
        		?>
        	<tr>
        		<td colspan="12" align="center"><b><a href="edit.php">EDIT</a></b></td>
        	</tr>
      	</tbody>
    </table>
	</body>
</html>