<?php
// User
include "class/user.php";
include "class/functions/string.php";

$User = new User();
$therapists = $User->getTherapists();

if(isset($_POST["submit"])) {
	$name      = $_POST["cf_name"];
	$lastname  = $_POST["lastname"];
	$birthday  = $_POST["birthday"];
	$email     = $_POST["email"];
	$sex       = $_POST["sex"];
	$telephone = $_POST["telephone"];
	
	if($name !== "" and $lastname !== "" and $email !== "" and $birthday !== "" and $telephone !== "") {
		

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
		<label for="email">E-Mail*:</label>
		<input id="email" name="email" class="required" type="text" />
	</p>
	
	
	<p class="one-third">
		<label for="password">Password*:</label>
		<input id="password" name="password" class="required" type="password" />
	</p>
		
	
	<p class="one-third last">
		<label for="date">Fecha de la cita*:</label>
		<input id="date" name="date" class="required" type="text" />
	</p>
	
	<p class="one-third">
		<label for="tratamiento">Tratamiento*:</label>
		<select name="tratamiento" id="tratamiento" class="required">
			<option value="1">tratamiento 1</option>
			<option value="2">tratamiento 2</option>
		</select>
	</p>
	
	<p class="one-third">
		<label for="terapeuta">Terapeuta*:</label>
		<select name="terapeuta" id="terapeuta" class="required">
			<?php foreach($therapists as $therapist) { ?>
				<option value="<?php echo $therapist["id"];?>"><?php echo $therapist["name"];?></option>
			<?php } ?>
		</select>
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
