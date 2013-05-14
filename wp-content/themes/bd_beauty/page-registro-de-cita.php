<?php

// User
include "class/user.php";
include "class/functions/string.php";

$User = new User();
$therapists  = $User->getTherapists();
$specialties = $User->getSpecialties();
	
if(isset($_POST["submit"])) {
	$terapeuta   = $_POST["terapeuta"];
	$tratamiento = $_POST["tratamiento"];
	$date        = $_POST["date"];
	$email       = $_POST["email"];
	$password    = $_POST["password"];
	
	if($terapeuta !== "0" and $tratamiento !== "0" and $date !== "" and $email !== "" and $password !== "") {
		
		
		$User = new User();
		$data = $User->login($email, $password);
		
		die(var_dump($data));
	}
	
	echo "no";
	
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
		<label for="date">Fecha de la cita* (dd/mm/yy):</label>
		<input id="date" name="date" class="required" type="text" />
	</p>
	
	<p class="one-third">
		<label for="tratamiento">Tratamiento*:</label>
		<select name="tratamiento" id="tratamiento" class="required">
			<option value="0">Seleccione un tratamiento</option>
			<?php foreach($specialties as $specialty) { ?>
				<option value="<?php echo $specialty["id"];?>">
					<?php echo ucfirst($specialty["name"]);?>
				</option>
			<?php } ?>
		</select>
	</p>
	
	<p class="one-third">
		<label for="terapeuta">Terapeuta*:</label>
		<select name="terapeuta" id="terapeuta" class="required">
			<option value="0">Seleccione un terapeuta</option>
		</select>
	</p>
	
	<div class="message"></div>

	<p>
		<input type="submit" name="submit" value="Registrar" />
		<span class="spinner"><span>Enviando ...</span></span>
	</p>
</form>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#tratamiento").change(function() {
			var str = $("#tratamiento option:selected").val();
			
			if(str=='0') {
				
			} else {
				$.ajax({
				url: "?page_id=1301&id_t=" + str,
					context: document.body
				}).done(function(data) {
					var data = $.parseJSON(data);
					
					var html = '<option value="0">Seleccione un terapeuta</option>';
					
					for(var record in data) {
						html = html + '<option value="' + String(data[record].id) + '">' + String(data[record].name) + '</option>';
					}

					$("#terapeuta").html(html);
				});
			}
		});
	});
</script>
   
<?php 
	get_footer(); 
}
?>
