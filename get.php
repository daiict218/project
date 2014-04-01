<?php require_once("includes/connection.php"); ?>
<?php require_once("includes/functions.php"); ?>
<?php
	session_start();
	$id = addslashes($_REQUEST['id']);
	$image =  mysql_query("SELECT * FROM users WHERE id = $id");
	$image = mysql_fetch_assoc($image);
	$image = $image['pic'];
	header("Content-type:image/jpeg");
	echo $image;
?>