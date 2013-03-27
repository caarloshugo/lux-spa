<?php

if(isset($_POST["submit"])) {
	echo '<input type="text" id="success_msg" name="cf_success_msg" value="Thank you for your email we will fixed appointment by phone call" />';
}

else {	
	get_header();

	// Concentration
	include "class/appointment.php";
	include "class/functions/string.php";

	$Appointment = new Appointment();
	$records     = $Appointment->all();
?>

<form id="contactform" class="three-column-form" method="post" action="">
	<input type="hidden" id="receiver" name="cf_receiver" value="info[at]bdtheme.com" />
	<input type="hidden" id="email_signature" name="cf_email_signature" value="Appointment Booking" />
	<input type="hidden" id="error_msg" name="cf_error_msg" value="Please fill in all fields correctly" />

	<p class="one-third">
		<label for="name">Nombre(s)*:</label>
		<input id="name" name="cf_name" class="required" type="text" />
	</p>

	<p class="one-third">
		<label for="lastname">Apellidos*:</label>
		<input id="lastname" name="lastname" class="required" type="text" />
	</p>
	
	<p class="one-third last">
		<label for="birthday">Fecha de cumplea&ntilde;os*:</label>
		<input id="birthday" name="birthday" class="required" type="text" />
	</p>

	<p class="one-third">
		<label for="email">E-Mail*:</label>
		<input id="email" name="email" class="required" type="text" />
	</p>
	
	<p class="one-third">
		<label for="email">Sexo*:</label>
		<select name="sex" id="sex" class="required">
			<option value="0">Masculino</option>
			<option value="1">Femenino</option>
		</select>
	</p>
	
	<p class="one-third last">
		<label for="telephone">Tel&eacute;fono*:</label>
		<input id="telephone" name="telephone" class="required" type="text" />
	</p>
	
	<div class="message"></div>

	<p>
		<input type="submit" name="submit" value="Registrar" />
		<span class="spinner"><span>Enviando ...</span></span>
	</p>
</form>
      
<?php 
	get_footer(); 
}
?>
