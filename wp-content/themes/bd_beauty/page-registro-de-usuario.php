<?php

if(isset($_POST["submit"])) {
	$name      = $_POST["cf_name"];
	$lastname  = $_POST["lastname"];
	$birthday  = $_POST["birthday"];
	$email     = $_POST["email"];
	$sex       = $_POST["sex"];
	$telephone = $_POST["telephone"];
	
	if($name !== "" and $lastname !== "" and $email !== "" and $birthday !== "" and $telephone !== "") {
		// User
		include "class/user.php";
		include "class/functions/string.php";

		$User = new User();
		$data = $User->add($name, $lastname, $email, $birthday, $sex, $telephone);
		
		echo '<input type="text" id="success_msg" name="cf_success_msg" value="Thank you for your email we will fixed appointment by phone call" />';
	} else {
		echo '<input type="text" id="error_msg" name="cf_error_msg" value="Please fill in all fields correctly" />';
	}
	
} else {	
	get_header();
?>

<form id="contactform" class="three-column-form" method="post" action="">
	<input type="hidden" id="receiver" name="cf_receiver" value="info[at]bdtheme.com" />
	<input type="hidden" id="email_signature" name="cf_email_signature" value="Appointment Booking" />

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
