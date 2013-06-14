<?php get_header(); ?>


<?php
// Concentration
include "class/appointment.php";
include "class/functions/string.php";

$Appointment = new Appointment();
$records     = $Appointment->all();
?>

<form id="contactform" class="three-column-form" method="post" action="http://107.22.236.217/lux-spa/wp-content/themes/bd_beauty/contact_form_mailer.php">
	<input type="hidden" id="receiver" name="cf_receiver" value="info[at]bdtheme.com" />
	<input type="hidden" id="email_signature" name="cf_email_signature" value="Appointment Booking" />
	<input type="hidden" id="success_msg" name="cf_success_msg" value="Thank you for your email we will fixed appointment by phone call" />
	<input type="hidden" id="error_msg" name="cf_error_msg" value="Please fill in all fields correctly" />

	<p class="one-third">
		<label for="subject">Message Subject*:</label>
		<input id="subject" name="cf_subject" class="required" type="text" />
	</p>

	<p class="one-third">
		<label for="name">Nombre*:</label>
		<input id="name" name="cf_name" class="required" type="text" />
	</p>

	<p class="one-third last">
		<label for="email">E-Mail*:</label>
		<input id="email" name="email" class="required" type="text" />
	</p>

	<p>
		<label for="email">Mensage*:</label>
		<textarea id="message" name="cf_message" class="required" cols="40" rows="8" placeholder="Your message here*"></textarea>
	</p>
	
	<div class="message"></div>

	<p>
		<input type="submit" name="submit" value="Send Message" />
		<span class="spinner"><span>Please wait...</span></span>
	</p>
</form>
      
<?php get_footer(); ?>
