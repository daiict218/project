<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	session_start();
	if(isset($_SESSION['username']))
	{
		if($_SESSION['username'])
		{
			$username = $_SESSION['username'];
			$id = get_id_from_username($username);
			echo "Welcome ".  $_SESSION['username']."! <br />";
			echo "This page will show every information of the user which he/she entered(including profile pic)<br />";
			$id = get_id_from_username($username);
			$pic = get_pic_from_username($username);
			//echo $pic;
			//echo is_null($x);
			$sex = get_sex_from_username($username);
			echo $sex;
			if(empty($pic))
			{
				if($sex == "Male")
				{
					echo "<p>No Profile pic</p><img src=\"included\m.jpg\" height=\"300\" width=\"300\"><br />";
				}
				if($sex == "Female")
				{
					echo "<p>No Profile pic</p><img src=\"included\m1.jpg\" height=\"300\" width=\"300\"><br />";					
				}
			}
			else
			{
				echo "<p>Profile pic</p><img src=get.php?id=$id height=\"300\" width=\"300\"><br />";
			}
			echo "<a href=\"image.php\">upload/change profile pic</a>";
			echo "<p>Name : " .get_name_from_username($username). "</p>";
			echo "<p>Nickname : " .$username. "</p>";
			echo "<p>Sex : " .get_sex_from_username($username). "</p>";
			echo "<p>Location : " .get_location_from_username($username). "</p>";
			echo "Email : " .get_email_from_username($username) ."";			
			echo "<a href=\"logout.php\">Log out</a> <br />";
		}
	}
	else
		die("You must be logged in");
?>