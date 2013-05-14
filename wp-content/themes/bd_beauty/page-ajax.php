<?php

// User
include "class/user.php";
include "class/functions/string.php";

$User = new User();

$specialties = $User->getSpecialties();

if(isset($_GET["id_t"])) {
	$data = $User->getTherapistsBySpecialty($_GET["id_t"]);
	
	echo json_decode($data)
} else {

}
