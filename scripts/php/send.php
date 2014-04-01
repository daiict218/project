<?php
	require('../../includes/connection.php');
	require('../../includes/functions.php');

	if(isset($_GET['sender']) && !empty($_GET['sender'])){
		$sender = $_GET['sender'];

		if(isset($_GET['message'])&& !empty($_GET['message'])){
			$message = $_GET['message'] ;

			if(send_msg($sender, $message)){
			;?>
			<label style="color: white;">
				<?php echo 'Message sent' ; ?>
			</label>
			<?php
		} else {
			;?>
			<label style="color: white;">
				<?php echo 'Message wasn\'t sent' ; ?>
			</label>
			<?php
			}
		} else {
			;?>
			<label style="color: white;">
				<?php echo 'No message was entered.' ; ?>
			</label>
			<?php
		}

		} else {
		;?>
			<label style="color: white;">
				<?php echo 'No Name was entered.' ; ?>
			</label>
			<?php
		}

?>
<?php
	if(isset($connection)){
		mysql_close($connection);
	}
?>