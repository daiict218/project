<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<html>
<head>
	<title>upload an image</title>
</head>
<body>
	<form action="image.php" method="POST" enctype="multipart/form-data">
		File : <input type="file" name="image">
		<input type="submit" value="Upload">
	</form>
	<?php
		//did not understand this code but somehow it solved problem for me for uploading an image
		$allowedExts = array("gif", "jpeg", "jpg", "png");
		if(isset($_FILES["file"]["name"]) && isset($_FILES["file"]["type"]) && $_FILES["file"]['size'])
		{	
			$y=1;
			$temp = explode(".", $_FILES["file"]["name"]);
			$extension = end($temp);
			if ((($_FILES["file"]["type"] == "image/gif")
			|| ($_FILES["file"]["type"] == "image/jpeg")
			|| ($_FILES["file"]["type"] == "image/jpg")
			|| ($_FILES["file"]["type"] == "image/pjpeg")
			|| ($_FILES["file"]["type"] == "image/x-png")
			|| ($_FILES["file"]["type"] == "image/png"))
			&& ($_FILES["file"]["size"] < 20000)
			&& in_array($extension, $allowedExts))
			  {
			  if ($_FILES["file"]["error"] > 0)
			  {
			    echo "Error: " . $_FILES["file"]["error"] . "<br>";
			  }
			  else
			  {
			    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
			    echo "Type: " . $_FILES["file"]["type"] . "<br>";
			    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " kB<br>";
			    echo "Stored in: " . $_FILES["file"]["tmp_name"];
			  }
			}
			else
			  {
			  echo "Invalid file";
			  }
		}
	?>
	<?php
		session_start();
		$username = $_SESSION['username'];
		
		//get_id_from_username is a function inside the functions.php
		$id = get_id_from_username($username);
		//echo $id;
		//connect to a database
		//file properties

		if(isset($_FILES['image']['tmp_name']))
		{
			$file = $_FILES['image']['tmp_name'];
		}
		if(!isset($file))
		{
			echo "please select an image";
		}
		else
		{
			$image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
			$image_name = addslashes($_FILES['image']['name']);
			$image_size = getimagesize($_FILES['image']['tmp_name']);	
			if($image_size==FALSE)
			{
				echo "that's not an image";
			}
			else
			{
				if(!$insert = mysql_query("UPDATE users SET pic='$image' WHERE id=$id"))
				{
					echo "Problem uploading image";
				}
				else
				{
					//NOTE : the image is somehow is not printing on the page.. Don't change the whole code.. error either is in
					//next line or in get.php because image is getting stored in database so no error uptill this line...
					echo "image uploaded.<p>Profile pic</p><img src=get.php?id=$id height=\"300\" width=\"300\"><br />";
					redirect_to("member.php");	
				}
			}
		}

	?>
</body>
</html>