<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	session_start();
	if(isset($_POST['username']) && isset($_POST['password']))
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		if($username && $password)
		{
			$query = mysql_query("SELECT * FROM users WHERE nickname = '$username'");

			$numrows = mysql_num_rows($query);
			//echo $numrows;
			$x=0;
			if($numrows!=0)
			{
				//code to login
				while($row = mysql_fetch_assoc($query))
				{
					$dbusername = $row['nickname'];
					$dbpassword = $row['password'];
					if($dbusername == $username && md5($password) == $dbpassword)
					{
						$x=1;
						echo "You're in. This page will be used as chatrooms <a href='member.php'>this link will be used for user's home page</a>";
						$y = 0;
						$_SESSION['username'] = $username;
						break;
					}
					else
					{
						$x = 0;
					}
				}
				if($x==0)
				{
					echo "Wrong password";
				}
			}
			else
			{
				die("That user does not exist");
			}

		}
		else
		{	
			die("Please enter a username and password");
		}
	}
?>