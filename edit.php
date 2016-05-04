<html>
<head>
	<title>Update User Info</title>
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
                        .width(100)
                        .height(100);
                  };
                  reader.readAsDataURL(input.files[0]);
              }
          }
    </script>
</head>
<body>
<form name="frmupdate" method="post" action="update.php" enctype="multipart/form-data";>
<?php
	include ('connect.php');
	session_start();
	$user = $_SESSION['username'];
	echo "$user";
 
	$query = mysqli_query($con, "SELECT * FROM sample WHERE username='$user'");
  $row = mysqli_fetch_row($query);
  $id=$row[0];
  $name=$row[1];
  $mail=$row[2];
  $add=$row[4];
  $country_selected= $row[5];
  $state_selected = $row[6];
  $city_selected = $row[7];
  $hobby = $row[8];
  $gen=$row[9];
  $birth=$row[10];
  $path=$row[11];
  $preferred=$row[12];
  $_SESSION['username'] = $name;
?>
<table border="2" align="center" style="width:300px;
  background-color:#f3f3f3;
  position:fixed;
  margin-left:-330px; /* half of width */
  margin-top:-150px;  /* half of height */
  top:30%;
  left:30%;" >
  <tr>
    <td>User Id</td><td>User Name</td><td>Email Id</td><td>Address</td><td>Hobbies</td><td>Country</td><td>State</td><td>City</td><td>Preferred Location</td><td>Gender</td><td>Date of Birth</td><td>Profile Picture</td>
  </tr>
    <tr>
    	<td><?php echo '<input type = "text" name = "user_id" value = '.$id.'>';?></td>
     	<td><?php echo '<input type = "text" name = "user_name" readonly value = '.$name.'>';?></td>
     	<td><?php echo '<input type = "text" name = "email" value = '.$mail.'>';?></td>
     	<td><?php echo '<input type = "text" name = "address" value = '.$add.'>';?></td>
      <td>
        <?php
          $query = "SELECT * FROM hobbies";
          $flag=false;
          $result = mysqli_query($con, "$query");
          while ($r=mysqli_fetch_array($result)) 
          {
            $hobbyid = $r["hobby_id"];
            $hobbyname = $r["hobby_name"];
            $hob_id=explode(',',$hobby);
            $size = sizeof($hob_id);
            for($i=0;$i<$size;$i++) 
            { 
              if($hob_id[$i]==$hobbyid) 
              {
                $flag=true;
              } 
            }
            if($flag==true) 
            {
              ?>
              <input  type='checkbox' name='check_list[]' value="<?php echo $r['hobby_id']; ?>" checked  > <?php echo $r['hobby_name']; ?> <br>
              <?php
              $flag=false;
            } 
            else 
            { 
              ?>
              <input  type='checkbox' name='check_list[]' value="<?php echo $r['hobby_id']; ?>"> <?php echo $r['hobby_name']; ?> <br>
              <?php
            }
          }
        ?>
      </td>
    <td>
      <?php
            //for retriving data from DB and show it in drop down box
        $query="SELECT * FROM country";
        $result = mysqli_query ($con, "$query");
        echo "<select name=country>";
        while($r=mysqli_fetch_array($result))
        {
          if($country_selected==$r[countryid])
          {
            echo "<option selected value='$r[countryid]'> $r[cname] </option>";
          }
          else
          {
            echo "<option value='$r[countryid]'> $r[cname] </option>";
          }
        }
        echo "</select>";
      ?>
    </td>
    <td>
      <?php
            //for retriving data from DB and show it in drop down box
        $query="SELECT * FROM state";
        $result = mysqli_query ($con, "$query");
        echo "<select name=state>";
        while($r=mysqli_fetch_array($result))
        {
          if($state_selected==$r[state_id])
          {
            echo "<option selected value='$r[state_id]'> $r[state_name] </option>";
          }
          else
          {
            echo "<option value='$r[state_id]'> $r[state_name] </option>";
          }
        }
        echo "</select>";
      ?>
    </td>
    <td>
      <?php
        //for retriving data from DB and show it in drop down box
        $query="SELECT * FROM city";
        $result = mysqli_query ($con, "$query");
        echo "<select name=city>";
        while($r=mysqli_fetch_array($result))
        {
          if($city_selected==$r[city_id])
          {
            echo "<option selected value='$r[city_id]'> $r[city_name] </option>";
          }
          else
          {
            echo "<option value='$r[city_id]'> $r[city_name] </option>";
          }
        }
        echo "</select>";
      ?>
    </td>
    <td>
      <?php
        //for retriving data from DB and show it in multi select combo box
        $query="SELECT * FROM city";
        $result = mysqli_query ($con, "$query");
        echo "<select name=location[] multiple size=2>";
        while($r=mysqli_fetch_array($result))
        {
          $locationname=$r["city_name"];
          $locationid=$r["city_id"];
      ?>
          echo "<option value='<?php echo $locationid; ?>'> <?php echo $locationname;?> </option>";
<?php   }
        echo "</select>";
?>
    </td>
    <td>
      <label><input type="radio" name="gender" value="Male" <?php echo ($gen == 'Male') ? 'checked' : ''; ?> /> Male</label>
			<label><input type="radio" name="gender" value="Female" <?php echo ($gen == 'Female') ? 'checked' : ''; ?> /> Female
    </td>
    <td><?php echo '<input type = "date" name=date value = '.$birth.'>';?></td>
    <td><?php echo '<img width="150" height="150" src= "'.$path.'"/>';?>
      <input type="file" name="profile" onchange="readURL(this);" accept="image/gif, image/jpeg, image/png"/>
        <img id="blah" src="#" alt="your image" />
    </td>
  </tr>
</table><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
<div>
  <center>
		<input type="submit" name="update" value="Update My Profile"/>
	</center>
</div>
</form>
</body>
</html>