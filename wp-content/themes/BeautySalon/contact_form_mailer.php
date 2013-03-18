<?php

// If the form is submitted
if(isset($_POST['submit'])) {

  // Include WordPress Core Functions
  $wp_include = '../wp-load.php';
  while(!@include_once($wp_include)) { $wp_include = '../'.$wp_include; }
  
  
  //
  // Field Validation
  //

	// Check to make sure that the name field is not empty
	if(trim($_POST['cf_name']) == '') {
		$has_error = true;
	}
	else {
		$name = trim($_POST['cf_name']);
	}

	// Check to make sure that the subject field is not empty
	if(trim($_POST['cf_subject']) == '') {
		$has_error = true;
	} 
	else {
		$subject = trim($_POST['cf_subject']);
	}

	// Check to make sure sure that a valid email address is submitted
	if(trim($_POST['email']) == '')  {
		$has_error = true;
	} 
	elseif(!preg_match("/^[A-Z0-9._%-]+@[A-Z0-9._%-]+\.[A-Z]{2,4}$/i", trim($_POST['email']))) {
		$has_error = true;
	}
	else {
		$email = trim($_POST['email']);
	}

	// Check to make sure comments were entered
	if(trim($_POST['cf_message']) == '') {
		$has_error = true;
	} 
	else {
		if(function_exists('stripslashes')) {
			$message = stripslashes(trim($_POST['cf_message']));
		}
		else {
			$message = trim($_POST['cf_message']);
		}
	}
	
  
  //
  // Send E-Mail
  //

	// Send the email if there is no error
	if(!isset($has_error)) {
    // Get recheiver
    $receiver = ($_POST['cf_receiver']) ? $_POST['cf_receiver'] : get_option('admin_email');
    $receiver = str_replace('[at]', '@', $receiver);
    
    // Headers
		$headers = "From: $name <$email>\n";
  	$headers.= "Content-Type: text/plain; charset=\"UTF-8\"\n";
  	
  	// Message
  	if($_POST['cf_email_signature'] && $_POST['cf_email_signature'] != 'none') {
  		$message.= "\n\n---\n".$_POST['cf_email_signature'];
  	}
    
    // Send E-Mail
		$mail_sent = wp_mail($receiver, $subject, $message, $headers);
		if($mail_sent)
		  echo "<p class='info-box success'>".$_POST['cf_success_msg']."</p>";
		else
		  echo "<p class='info-box error'>The message couldn't be sent because an internal error occured.</p>";
	} 
	else {
		echo "<p class='info-box error'>".$_POST['cf_error_msg']."</p>";
	}
}

?>