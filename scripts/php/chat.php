<?php
	//include("../../includes/header.php");
	require('../../includes/connection.php');
	require('../../includes/functions.php');

	$messages = get_msg();
	foreach ($messages as $message) {
		echo $message['sender'] . ": " . $message['message']. "<br />";
	} 

//include("../../includes/footer.php");
?>
<?php
	if(isset($connection)){
		mysql_close($connection);
	}
?>