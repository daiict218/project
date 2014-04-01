<?php include("includes/connection.php"); ?>
<?php require("includes/functions.php"); ?>
<?php include("includes/header.php"); ?>
<div id="header"><h1>START CHATTING</h1></div>

<?php
$sender = null;
$message = null;
?>

<div id="input">
<div id="feedback"></div>
<form action="#" method="post" id="form_input">
<div id="chatbox"><label id="name">Enter name:<input size="16" type="text" name="sender" id="sender"/></label></div>
<div id="chatbox"><input style="height:50px" size="50" onFocus="this.value=''" value="Enter your message" 
	type="text" name="message" id="message"><input type="submit" name="send" id="send" value="send message"/></div>
<br />

</form>
</div>

<div id="display"> <!-- <textarea style="overflow:auto" rows="25" cols="120" readonly>

</textarea> --></div>
<a href="delete_msgs.php" style="color: white ">disconnect</a>

<!--javascript -->
<script type="text/javascript" src="scripts/js/jquery.js"></script>
<script type="text/javascript" src="scripts/js/auto_chat.js"></script>
<script type="text/javascript" src="scripts/js/send.js"></script>

<?php include("includes/footer.php"); ?>
<?php
	if(isset($connection)){
		mysql_close($connection);
	}
?>