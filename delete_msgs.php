<?php include("includes/connection.php"); ?>
<?php require("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>

<?php
global $connection;
$query = "DELETE FROM random_table";
$retval = mysql_query( $query, $connection );
if(! $retval )
{
  die('Could not delete data: ' . mysql_error());
}
?>
<p>You are now disconnected</p>
<?php
$getip = $_SERVER['REMOTE_ADDR'];
echo "<p>IP Address: $getip</p>";
?>
<a href="random.php" style="color:white">connect again</a>

<?php include("includes/footer.php"); ?>
<?php
	if(isset($connection)){
		mysql_close($connection);
	}
?>