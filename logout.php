<?php
	
	session_start();

	echo "<a href=\"login_form.php\">log out</a>";
	session_destroy();
?>