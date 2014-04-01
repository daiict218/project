<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<html>
	<head>
			<link rel="stylesheet" type="text/css" href="stylesheets/public.css" />
	</head>
</html>
<?php
	echo "<h1>Register</h1>";
	if(isset($_POST['submit']))
	{
		$submit = mysql_prep(strip_tags($_POST['submit'])); //strip tags is used to delete all the html and php tags from the data
		$firstname = mysql_prep(strip_tags($_POST['firstname']));
		$lastname = mysql_prep(strip_tags($_POST['lastname']));
		$nickname = mysql_prep(strip_tags($_POST['nickname']));
		$password = mysql_prep(strip_tags($_POST['password']));	//md5 is used to encrypt a string to some random value
		$repeatpassword = mysql_prep(strip_tags($_POST['repeatpassword']));	//md5 value for two similar string is same
		$age = mysql_prep(strip_tags($_POST['age']));
		if(isset($_POST['gender']))
			$gender = mysql_prep(strip_tags($_POST['gender']));
		$email = mysql_prep(strip_tags($_POST['email']));
		$location = mysql_prep(strip_tags($_POST['location']));	
		$date = mysql_prep(date("Y-m-d"));
		if(isset($gender))
		{
			$gender = mysql_prep(strip_tags($_POST['gender']));
		}
		$location = mysql_prep(strip_tags($_POST['location']));	
		if($submit)
		{
			//check for existance
			if($firstname && $lastname && $nickname && $password && $repeatpassword && $age && $location)
			{
			
				if($password == $repeatpassword)
				{
					//if come here again add code for length check and all
					//adding password check at initial stage :p
					if(strlen($password) > 25 || strlen($password) < 6)
					{
						echo "password must be between 6 and 25 characters";
					}

					else
					{
						//registering the user
						$password = md5($password);
						$repeatpassword = md5($repeatpassword);
						echo "Success";

						//open database
						mysql_connect(DB_SERVER,DB_USER,DB_PASS);
						mysql_select_db(DB_NAME);

						$query = mysql_query("INSERT INTO users 
							VALUES ('','$firstname','$lastname','$nickname','$password',$age,'$gender','$email','$location','$date','')"
							);
						die("You have been registered.. <a href=\"login_form.php\">Return to login page</a>");
					}

				}
				else
				{
					echo "your password do not match";
				}
				//saving the database

			}
			else
			{
				echo "please fill in the details";
			}
		}
	}
?>


<html>
	<head>
		<!-- <link rel="stylesheet" type="text/css" href="stylesheets/public.css" /> -->
	</head>
	<form action="signup.php" method="POST">
		First Name :<input type="text" name="firstname"> <br />
		Last Name :<input type="text" name="lastname"> <br />	
		Nick Name :<input type="text" name="nickname"> <br />
		Password :<input type="password" name="password">	<br />	
		Confirm Password : <input type="password" name="repeatpassword">	<br />
		Age :<input type="number" name="age"> <br />
		Gender :<input type="radio" name="gender" value="0"/> 
			Male
			&nbsp;
			<input type="radio" name="gender" value="1"/>
			Female	
		<br />
		Email :<input type="text" name="email"> <br />
		Location :<input type="text" name="location"> <br />
		<input type="submit" name="submit" value="register">
	</form>
</html>