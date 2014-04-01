<?php
	//Use it as a standard function
	function mysql_prep($value)
	{
		$magic_quote_active = get_magic_quotes_gpc();
		$new_enough_php = function_exists("mysql_real_escape_string");
		if($new_enough_php)
		{
			if($magic_quote_active)
			{
				$value = stripslashes($value);
			}
			$value = mysql_real_escape_string($value);
		}
		else
		{
			if(!$magic_quote_active)
			{
				$value=addslashes($value);
			}
		}
		return $value;
	}

	//function to redirect to a page
	function redirect_to($location)
	{
		if($location)
		{
			header("Location: {$location}");
			exit;
		}
	}

	function get_name_from_username($username)
	{
		$query = mysql_query("SELECT * FROM users WHERE nickname = '$username'");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$firstname = $row['firstname'];
				$lastname = $row['lastname'];
			}
		}
		return $firstname." ".$lastname;
	}

	function get_email_from_username($username)
	{
		$query = mysql_query("SELECT * FROM users WHERE nickname = '$username'");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$email=$row['email'];
			}				
		}
		return $email;
	}


	function get_location_from_username($username)
	{
		$query = mysql_query("SELECT * FROM users WHERE nickname = '$username'");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$location = $row['location'];
			}
		}
		return $location;
	}

	function get_sex_from_username($username)
	{
		$query = mysql_query("SELECT * FROM users WHERE nickname = '$username'");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$sex = $row['gender'];
				if($sex == 0)
				{
					$gender = "Male";
				}
				else
				{
					$gender = "Female";
				}
			}
		}
		return $gender;
	}

	function get_id_from_username($username)
	{
		$query = mysql_query("SELECT * FROM users WHERE nickname = '$username'");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$id = $row['id'];
			}
		}
		return $id;
	}

	// This file is place to store all basic functions
	function confirm_query($result_set)
	{
		if(!$result_set)
		{
			die("Database query failed ".mysql_error());
		}
	}

	function get_all_subjects()
	{
		$query="SELECT * FROM subjects";
		$subject_set = mysql_query($query);
		confirm_query($subject_set);
		return $subject_set;
	}

	function get_pic_from_username($username)
	{
		$query = mysql_query("SELECT * FROM users WHERE nickname = '$username'");
		$numrows = mysql_num_rows($query);
			//echo $numrows;
		if($numrows!=0)
		{
			//code to login
			while($row = mysql_fetch_assoc($query))
			{
				$pic = $row['pic'];
			}
		}
		return $pic;
	}

	function get_pages_for_subject($subject_id)
	{
		$query="SELECT * FROM pages WHERE subject_id={$subject_id}";
		$page_set = mysql_query($query);
		confirm_query($page_set);
		return $page_set;
	}


	//This function will take a subject id and return that subject.
	function get_subject_by_id($subject_id) 
	{
			global $connection;
		$query = "SELECT * ";
		$query .= "FROM subjects ";
		$query .= "WHERE id=" . $subject_id ." ";
		$query .= "LIMIT 1";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		// if no rows are returned, fetch array will return false
		if ($subject = mysql_fetch_array($result_set))
		{
			return $subject;
		} 
		else 
		{
			return NULL;
		}
	}

	function get_page_by_id($page_id)
	{
		global $connection;
		$query = "SELECT * "; 
		$query .= "FROM pages ";
		$query .= "WHERE id=" . $page_id . " ";
		$query .= "LIMIT 1";
		$result_set = mysql_query($query, $connection);
		confirm_query($result_set);
		// if no rows are returned, fetch array will return false
		if ($page = mysql_fetch_array($result_set))
		{
			return $page;
		} 
		else 
		{
			return NULL;
		}
	}
	

	function navigation($sel_subject,$sel_page)
	{
		global $output;	
		$output ="<ul class=\"subjects\">";
						
							//performing database query
							
							$subject_set=get_all_subjects();
							//using returned data
							while ($subject=mysql_fetch_array($subject_set)) 
							{
								# code...
								//echo "hello world";
								$output .= "<li";
								if($subject["id"] == $sel_subject['id'])
								{
									//echo "hello world";
									$output .= "div = \"selected\"";
								}
								$output .= "><a href=\"edit_subject.php?subj=" .urlencode($subject["id"]) ."\">{$subject["menu_name"]}</a></li>";
								$page_set = get_pages_for_subject($subject["id"]);
								//using returned data
								$output .= "<ul class=\"pages\">";
								while ($page=mysql_fetch_array($page_set)) {
									# code...
									$output .= "<li";
									if($page["id"]==$sel_page['id'])
									{
										$output .= "div = \"selected\"";
									}
									$output .= "><a href=\"content.php?page=".urlencode($page["id"])."\">{$page["menu_name"]}</a></li>";
								}
								$output .= "</ul>";
							}
						
					$output .= "</ul>";
					return $output;
	}

	function find_selected_page()
	{
		global $sel_page;
		global $sel_subject;
		if(isset($_GET['subj']))
		{	
			$sel_subject = get_subject_by_id($_GET['subj']);
			$sel_page = NULL;
		}
		elseif (isset($_GET['page'])) {
			# code...
			$sel_page = get_page_by_id($_GET['page']);
			//echo $sel_page['id']; //for bug detection
			$sel_subject = NULL;
		}
		else
		{
			$sel_page =NULL;
			$sel_subject =NULL;
		}
	}

	function display_errors($errors)
	{
		if(!empty($errors))
		{
			echo "<p class=\"errors\">";
			echo "please review the following errors <br />";
			foreach ($errors as $error) {
				# code...
				echo "-" . $error . "<br />";
			}
			echo "</p>";
		}
	}

	function get_msg()
	{
		global $connection;
		$query = "SELECT sender , message FROM random_table ORDER BY id DESC";
		$run = mysql_query($query,$connection);
		$messages = array();

		while($message = mysql_fetch_assoc($run)){
			$messages[] = array('sender'=>$message['sender'],
							'message'=>$message['message']);
		}
		return $messages;
	}
//sending the message sent by user
	function send_msg($sender, $message){
		if(!empty(sender) && !empty($message)){
			$sender = mysql_real_escape_string($sender);
			$message = mysql_real_escape_string($message);
			$query = "INSERT INTO random_table (sender, message)
						VALUES
						('{$sender}', '{$message}')";
			if($run = mysql_query($query)){
				return true;
			} else {
				return false;
			}
		}
		else{
			return false;
		}

}
?>