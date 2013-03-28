<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<?php

if(isset($_POST["submit"])) {
	$name      = $_POST["cf_name"];
	$lastname  = $_POST["lastname"];
	$birthday  = $_POST["birthday"];
	$email     = $_POST["email"];
	$sex       = $_POST["sex"];
	$telephone = $_POST["telephone"];
	$password  = $_POST["password"];
	
	if($name !== "" and $lastname !== "" and $email !== "" and $birthday !== "" and $telephone !== "" and $password !== "") {
		# User Class
		include "class/user.php";
		include "class/functions/string.php";

		$User = new User();
		$data = $User->add($name, $lastname, $email, $birthday, $sex, $telephone, $password);
		
		echo '<input type="text" id="success_msg" name="cf_success_msg" value="Gracias por registrarte, recibirás un email" />';
	} else {
		echo '<input type="text" id="error_msg" name="cf_error_msg" value="Por favor, rellene todos los campos correctamente" />';
	}
	
} else {	
	get_header();
?>

<form id="contactform" class="three-column-form" method="post" action="">
	<input type="hidden" id="receiver" name="cf_receiver" value="info[at]bdtheme.com" />
	<input type="hidden" id="email_signature" name="cf_email_signature" value="Appointment Booking" />
	
	<div class="message"></div>
		
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
		<label for="telephone">Tel&eacute;fono*:</label>
		<input id="telephone" name="telephone" class="required" type="text" />
	</p>
	
	<p class="one-third last">
		<label for="password">Password*:</label>
		<input id="password" name="password" class="required" type="password" />
	</p>
	
	<p class="one-third" id="success_msg">
		<label for="email">Sexo*:</label>
		<select name="sex" id="sex" class="required">
			<option value="0">Masculino</option>
			<option value="1">Femenino</option>
		</select>
	</p>
	
	<p class="one-third">
		<input type="submit" name="submit" value="Registrar" />
		<span class="spinner"><span>Enviando ...</span></span>
	</p>
</form>

<script src="http://code.jquery.com/jquery-1.9.1.js"></script
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#birthday").datepicker();
	});
</script>

<?php 
	get_footer(); 
}
?>
