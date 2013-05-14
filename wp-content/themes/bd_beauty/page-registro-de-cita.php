<?php

// User
include "class/user.php";
include "class/functions/string.php";

$User = new User();
$specialties   = $User->getSpecialties();
$template_path = get_template_directory_uri();

if(isset($_POST["submit"])) {
	$terapeuta   = $_POST["terapeuta"];
	$tratamiento = $_POST["tratamiento"];
	$date        = $_POST["date"];
	$email       = $_POST["email"];
	$password    = $_POST["password"];
	
	if($terapeuta !== "0" and $tratamiento !== "0" and $date !== "" and $email !== "" and $password !== "") {		
		
		$data = $User->login($email, $password);
		
		if($data) {
			/* Falta hacer el select de horas */
			
			$data = $User->setAppointment($data[0]["id"], $terapeuta, $tratamiento, 1, $date);
			
		} else {
			$msg = '<span class="error_msg" name="cf_error_msg">Email y/o constraseña incorrectos</span>';
		}
	} else {
		$msg = '<span class="error_msg" name="cf_error_msg">Por favor, rellene todos los campos correctamente</span>';
	}
}

get_header();

?>

<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
<form id="contactform" class="three-column-form" method="post" action="">
	
	<?php if(isset($msg)) { ?>
		<p style="width:100%;">
			<?php echo $msg;?>
		</p>
	<?php } ?>
	
	<input type="hidden" id="receiver" name="cf_receiver" value="info[at]bdtheme.com" />
	<input type="hidden" id="email_signature" name="cf_email_signature" value="Appointment Booking" />

	<p class="one-third">
		<label for="email">E-Mail*:</label>
		<input id="email" name="email" class="required" type="text" <?php echo (isset($email)) ? 'value="'.$email.'"' : '';?>/>
	</p>
	
	
	<p class="one-third">
		<label for="password">Password*:</label>
		<input id="password" name="password" class="required" type="password" />
	</p>
		
	
	<p class="one-third last">
		<label for="date">Fecha de la cita* (dd/mm/yy):</label>
		<input id="date" name="date" class="required" type="text" <?php echo (isset($date)) ? 'value="'.$date.'"' : '';?>/>
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
		
		<img id="loading" src="<?php echo $template_path;?>/images/loader.gif">
	</p>

	<p>
		<input type="submit" name="submit" value="Registrar" />
		<span class="spinner"><span>Enviando ...</span></span>
	</p>
</form>
<script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$("#loading").hide();
		
		$("#tratamiento").change(function() {
			var str = $("#tratamiento option:selected").val();
			
			if(str=='0') {
				
			} else {
				$.ajax({
				url: "?page_id=1301&id_t=" + str,
					context: document.body,
					beforeSend: function (xhr) {
						$("#loading").show();
					}
				}).done(function(data) {
					$("#loading").hide();
					
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

<script src="http://code.jquery.com/jquery-1.9.1.js"></script>
<script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
		$( "#date" ).datepicker({
		  changeMonth: true,
		  changeYear: true
		});
	});
</script>
  
<?php 
	get_footer(); 
?>
